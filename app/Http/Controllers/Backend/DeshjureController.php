<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Deshjure;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DeshjureController extends Controller
{
    public function division()
    {
        $data = [];
       
        $data['get_data'] = Deshjure::where('cat_type', 'division')->orderBy('position', 'ASC')->get();
        return view('backend.location.division')->with($data);
    }

    public function division_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
            
        ]);

        $created_by = Auth::guard('admin')->id();
        $slug = preg_replace('/\s+/u', '-', trim(( $request->name_en ? $request->name_en : $request->name_bd )));
        $data = [
            'name_bd' => $request->name_bd,
            'slug' => $this->createSlugBd($slug),
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'cat_type' => 'division',
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function division_edit($id)
    {   
        $data = Deshjure::find($id);
        echo view('backend.edit-form.division')->with(compact('data'));
    }

    public function division_update(Request $request)
    {
        $request->validate([
            'name_bd' => 'required',
            
        ]);
        $created_by = Auth::guard('admin')->id();
      
        $data = [
            'name_bd' => $request->name_bd,
            'parent_id' => $request->parent_id,
            'updated_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Division update successfull.');
        }else{
            Toastr::success('Sorry division can\'t update.');
        }
        return back();
    }

    public function division_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'Division delete successfull.';
        }else{
            echo 'Sorry Division can\'t deleted.';
        }
    }

    public function district()
    {
        $data = [];
        $data['locations'] = Deshjure::where('cat_type', 'division')->orderBy('position', 'ASC')->get();
        $data['get_data'] = Deshjure::where('cat_type', 'district')->orderBy('position', 'ASC')->get();
        return view('backend.location.district')->with($data);
    }

    public function district_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
        ]);

        $created_by = Auth::guard('admin')->id();
      
        $slug = preg_replace('/\s+/u', '-', trim( ( $request->name_en ? $request->name_en : $request->name_bd )));
        $data = [
            'name_bd' => $request->name_bd,
            'slug' => $this->createSlugBd($slug),
            'name_en' => $request->name_en,
           
            'parent_id' => $request->parent_id,
            'cat_type' => 'district',
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function district_edit($id)
    {   
        $data = Deshjure::find($id);
        $locations = Deshjure::where('cat_type', 'division')->orderBy('position', 'ASC')->get();
        
        echo view('backend.edit-form.district')->with(compact('data', 'locations'));
    }

    public function district_update(Request $request)
    {

        $request->validate([
            'name_bd' => 'required',
            'parent_id' => 'required',
        ]);
        $updated_by = Auth::guard('admin')->id();
      
        $slug = preg_replace('/\s+/u', '-', trim(( $request->name_en ? $request->name_en : $request->name_bd )));
        $data = [
            'name_bd' => $request->name_bd,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'updated_by' => $updated_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('District update successfull.');
        }else{
            Toastr::success('Sorry district can\'t update.');
        }
        return back();
    }

    public function district_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'District delete successfull.';
        }else{
            echo 'Sorry district can\'t deleted.';
        }
    }

    public function upzilla()
    {
        $data = [];
        $data['get_data'] = Deshjure::where('cat_type', 'upzilla')->orderBy('name_bd', 'ASC')->get();
        $data['locations'] = Deshjure::where('cat_type', 'district')->orderBy('name_bd', 'ASC')->get();
        
        return view('backend.location.upzilla')->with($data);
    }

    public function upzilla_store(Request $request)
    {

        $request->validate([
             'name_bd' => 'required',
             'parent_id' => 'required',
        ]);

        $created_by = Auth::guard('admin')->id();
      
        $slug = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'slug' => $this->createSlugBd($slug),
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'cat_type' => 'upzilla',
            'created_by' => $created_by,
            'status' => ($request->status) ? '1' : '0',
        ];
        $insert = Deshjure::create($data);
        Session::flash('submitType', $request->submit);
        Toastr::success('Divistion Created Successfully.');
        return back();
    }

    public function upzilla_edit($id)
    {   $locations = Deshjure::where('cat_type', 'district')->get();
        $data = Deshjure::find($id);
        echo view('backend.edit-form.upzilla')->with(compact('data', 'locations'));
    }

    public function upzilla_update(Request $request)
    {
        $request->validate([
            'name_bd' => 'required',
            'parent_id' => 'required',
        ]);
        $updated_by = Auth::guard('admin')->id();
      
        $slug = preg_replace('/\s+/u', '-', trim($request->name_bd));
        $data = [
            'name_bd' => $request->name_bd,
            'name_en' => $request->name_en,
            'parent_id' => $request->parent_id,
            'updated_by' => $updated_by,
            'status' => ($request->status) ? '1' : '0',
        ];

        $update = Deshjure::where('id', $request->id)->update($data);
        if($update){
            Toastr::success('Deshjure update successfull.');
        }else{
            Toastr::success('Sorry Deshjure can\'t update.');
        }
        return back();
    }

    public function upzilla_delete($id)
    {
        $delete =  Deshjure::find($id)->delete();
        if($delete){
            echo 'Deshjure delete successfull.';
        }else{
            echo 'Sorry Deshjure can\'t deleted.';
        }
    }

    public function createSlugBd($slug)
    {
        //$slug = Str::slug($slug);

        $check_slug = Deshjure::select('slug')->where('slug', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('slug', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }


    public function createSlugEn($slug)
    {
        $slug = Str::slug($slug);

        $check_slug = Deshjure::select('slug')->where('slug', 'like', $slug.'%')->get();

        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_slug); $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains('slug', $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }

}
