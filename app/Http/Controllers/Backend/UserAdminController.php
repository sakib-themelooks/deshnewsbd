<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\UserHasPermission;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserAdminController extends Controller
{
    public function userList(Request $request, $status= ''){
        $user  = User::where('role_id', 'user');
        if($status){
            $user->where('status', $status);
        }
        if(!$status && $request->status && $request->status != 'all'){
            $user->where('status', $request->status);
        }
        if($request->name && $request->name != 'all'){
            $keyword = $request->name;
            $user->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('phone', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $users  = $user->orderBy('id', 'desc')->paginate($perPage);

        return view('backend.user.user')->with(compact('users'));
    }

    public function userProfile($username){
        $data['user']  = User::where('username', $username)->first();
        $data['transactions'] = Transaction::with(['user:id,name,username,mobile', 'addedBy'])
            ->where('user_id', $data['user']->id)
            ->whereIn('type', ['wallet', 'withdraw'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('backend.user.profile')->with($data);
    }

    public function userSecretLogin($id)
    {

        $user = User::findOrFail(decrypt($id));

        auth()->guard('web')->login($user, true);

        Toastr::success('User panel login success.');
        return redirect()->route('user.dashboard');

    }

    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            
            DB::table('user_has_permissions')
            ->where('user_id','=',$id)
            ->delete();

            $output = [
                'status' => true,
                'msg' => 'User deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'User cannot deleted.'
            ];
        }
        return response()->json($output);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required','min:6']
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->user_name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->role_id = 'user';
        $user->status = $request->status=='on'?'active':'pending';

        if(isset($request['password']) && $request['password']!="null" && $request['password']!=""){
            $user->password = Hash::make($request['password']);    
        }

        if($request->hasFile('phato')){
            $image = $request->file('phato');
            $image_name = time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $image_name;
        }
        $save = $user->save();

        $data = [];
        for($i=0;$i<sizeof($request['permissions']);$i++){
            $primary_data = [
                'user_id'=>$user->id,
                'permission_id'=>$request['permissions'][$i],
            ];

            array_push($data,$primary_data);
        }

        UserHasPermission::insert($data);

        if($save){
            Toastr::success('User creation successful.');
            return back();
        }else{
            Toastr::error('Sorry user creation failed.');
            return back();
        }
    }

    public function edit($id)
    {
        $user = DB::table('users')
        ->where('users.id','=',$id)
        ->select([
            'users.*',
            DB::raw('null as permissions')
        ])->first();

        $permissions = DB::table('user_has_permissions')->where('user_id','=',$id)->pluck('permission_id')->toArray();
        $user->permissions = $permissions;    
        
        return view('backend.user.edit_profile')->with(compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255']
        ]);

        if(isset($request['password']) && $request['password']!=null){
           $request->validate([
            'password' => ['required','min:6','confirmed'],
            'password_confirmation' => ['required','min:6']
        ]); 
        }

        $user = User::find($request['id']);
        $user->name = $request->name;
        $user->username = $request->user_name;
        $user->mobile = $request->phone;
        $user->email = $request->email;
        $user->role_id = 'user';
        $user->status = $request->status=='on'?'active':'pending';

        if(isset($request['password']) && $request['password']!="null" && $request['password']!=""){
            $user->password = Hash::make($request['password']);    
        }

        if($request->hasFile('phato')){
            $image = $request->file('phato');
            $image_name = time().$image->getClientOriginalName();
            $image_path = public_path('upload/images/users/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $image_name;
        }
        $save = $user->update();

        $data = [];
        for($i=0;$i<sizeof($request['permissions']);$i++){
            $primary_data = [
                'user_id'=>$user->id,
                'permission_id'=>$request['permissions'][$i],
            ];
            array_push($data,$primary_data);
        }

        DB::table('user_has_permissions')->where('user_id')->delete();
        
        UserHasPermission::insert($data);

        if($save){
            Toastr::success('User creation successful.');
            return back();
        }else{
            Toastr::error('Sorry user creation failed.');
            return back();
        }
    }
}
