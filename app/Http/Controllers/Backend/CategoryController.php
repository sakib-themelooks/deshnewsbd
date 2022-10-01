<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\CreateSlug;
use Illuminate\Http\Request;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Session;
class CategoryController extends Controller
{
    use createSlug;

    public function index()
    {
        $data['get_categories'] = Category::with(['subcategories', 'get_category'])->where('type', 'category')->orderBy('position', 'asc')->get();
        return view('backend.category.category')->with($data);
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();
        $slug = $this->createSlug('categories', $request->title, 'cat_slug_en');
        $category = new Category();
        $category->parent_id = null;
        $category->type = 'category';
        $category->category_bd = $request->title;
        $category->category_en = $request->category_en;
        $category->slug = $slug;
        $category->cat_slug_en = $slug;
       
        $category->created_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
       
        $category->meta_description = $request->meta_description;
        $category->save();

        Toastr::success('Category created.');
        return back();
    }

    public function edit($id)
    {
        $data = Category::find($id);
        echo view('backend.category.edit.category')->with(compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();

        $category = Category::find($request->id);
        $category->category_bd = $request->title;
        $category->slug = $request->slug;
        $category->updated_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';
        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_description = $request->meta_description;
        $update = $category->save();
        if($update){
            Toastr::success('Category update successfull.');
        }else{
            Toastr::success('Sorry category can\'t updated.');
        }

        return back();
    }


    public function delete($id)
    {
        $delete =  Category::find($id)->delete();
        if($delete){
            $output = [
                'status' => true,
                'msg' => 'Category delete successful.'
            ];
        }else{
            $output = [
                'status' => true,
                'msg' => 'Sorry category not deleted.'
            ];

        }
        return response()->json($output);
    }

    /** Category list Display. */
    public function subcategory(Request $request)
    {
        $data['get_category'] = Category::where('type', 'category')->orderBy('position', 'asc')->get();
        $get_data = Category::with('get_category:id,category_bd')
            ->where('type', 'subcategory');
            if($request->title){
                $get_data->where('category_bd', 'LIKE', '%'. $request->title .'%');
            }
            if($request->category && $request->category != 'all'){
                $get_data->where('parent_id', $request->category);
            }
            $perPage = 15;
            if($request->show){
                $perPage = $request->show;
            }
        $data['get_data'] = $get_data->orderBy('position', 'asc')->paginate($perPage);

        return view('backend.category.subcategory')->with($data);
    }

    /** Store a new category. */
    public function subcategory_store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'title' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();
        $slug = $this->createSlug('categories', $request->title, 'cat_slug_en');

        $category = new Category();
        $category->parent_id = ($request->parent_id) ? $request->parent_id : null;
        $category->type = 'subcategory';
        $category->category_bd = $request->title;
        $category->category_en = $request->category_en;
        $category->slug = $slug;
        $category->cat_slug_en = $slug;
        
        $category->created_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
       
        $category->meta_description = $request->meta_description;
        $store = $category->save();

        if($store){
            Toastr::success('Sub Category Create Successfully.');
        }else{
            Toastr::error('Sub Category Cannot Create.!');
        }
        Session::put('autoSelectId', $request->parent_id);
        return back();
    }

    public function subcategory_edit($id)
    {
        $data['get_category'] = Category::where('type', '=' , 'category')->orderBy('position', 'asc')->get();
        $data['data'] = Category::find($id);
        echo view('backend.category.edit.subcategory')->with($data);
    }

    /**  Update the specified resource in storage. */

    public function subcategory_update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'parent_id' => 'required'
        ]);

        $user_id = Auth::guard('admin')->id();

        $category = Category::find($request->id);

        $category->parent_id = ($request->parent_id) ? $request->parent_id : null;
        $category->category_bd = $request->title;
        $category->slug = $request->slug;
        $category->category_en = $request->category_en;
        $category->updated_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';
        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : null;
        $category->meta_description = $request->meta_description;

        $update = $category->save();

       
        if($update){
            Toastr::success('Category update successfully.');
        }else{
            Toastr::error('Category cannot update.!');
        }

        return redirect()->back();
    }

    public function subcategory_delete($id)
    {
        $category = Category::find($id);

        if($category){
           
            $category->delete();
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    /**
     *sub child Category list Display.
     */
    public function subchildcategory(Request $request)
    {
        $data['get_category'] = Category::where('type', 'subcategory')->where('status', 1)->get();

        $get_data = Category::with('get_category:id,category_bd')
            ->where('type', 'childcategory');
        if($request->title){
            $get_data->where('category_bd', 'LIKE', '%'. $request->title .'%');
        }
        if($request->category && $request->category != 'all'){
            $get_data->where('parent_id', $request->category);
        }
        $perPage = 15;
        if($request->show){
            $perPage = $request->show;
        }
        $data['get_data'] = $get_data->orderBy('position', 'asc')->paginate($perPage);

        return view('backend.category.subchildcategory')->with($data);
    }

    /** Store a new category. */

    public function subchildcategory_store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'title' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();
        $slug = $this->createSlug('categories', $request->title, 'cat_slug_en');

        $category = new Category();
        $category->parent_id = ($request->parent_id) ? $request->parent_id : null;
        $category->type = 'childcategory';
        $category->category_bd = $request->title;
        $category->slug = $request->slug;
        $category->category_en = $request->category_en;
        $category->slug = $slug;
        $category->cat_slug_en = $slug;
       
        $category->created_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';

        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
       
        $category->meta_description = $request->meta_description;
        $store = $category->save();

        if($store){
            Toastr::success('Sub Category Create Successfully.');
        }else{
            Toastr::error('Sub Category Cannot Create.!');
        }
        Session::put('autoSelectId', $request->parent_id);
        return back();
    }

    public function subchildcategory_edit($id)
    {
        $data['get_category'] = Category::where('type', 'subcategory')->orderBy('position', 'asc')->get();

        $data['data'] = Category::find($id);
        echo view('backend.category.edit.subchildcategory')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function subchildcategory_update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'parent_id' => 'required',
        ]);
        $user_id = Auth::guard('admin')->id();

        $category = Category::find($request->id);
        $category->parent_id = ($request->parent_id) ? $request->parent_id : null;
        $category->category_bd = $request->title;
        $category->category_en = $request->category_en;
        $category->updated_by = $user_id;
        $category->status = ($request->status) ? '1' : '0';
        $category->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $category->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $category->meta_description = $request->meta_description;
        
        $update = $category->save();
        if($update){
            Toastr::success('Category update successfully.');
        }else{
            Toastr::error('Category cannot update.!');
        }
        return redirect()->back();
    }

    public function subchildcategory_delete($id)
    {
        $category = Category::find($id);

        if($category){
            
            $category->delete();
            $output = [
                'status' => true,
                'msg' => 'Item deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Item cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function select(Request $request){
        //echo $request->q;
        $get_category = Category::select('id', 'category_bd')->get();
        echo json_encode($get_category);
    }
}
