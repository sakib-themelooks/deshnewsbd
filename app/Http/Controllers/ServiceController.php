<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceQuery;
use App\Models\HomepageSection;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    use CreateSlug;


    public function service_details($slug){
     
        $data['service_details'] = Service::where('slug', $slug)->with('ServiceType')->first();

        //get this site banner
        $data['sections'] = HomepageSection::where('page_name', $data['service_details']->slug)->where('status', 1)->orderBy('position', 'asc')->get();
        return view('frontend.service.service_details')->with($data);
    }

    // Service list
    public function index()
    {
        $services = Service::with('ServiceType')->orderBy('id', 'asc')->paginate(15);
        return view('backend.service.service-lists')->with(compact('services'));
    }
    public function create()
    {
        $data['serviceTypes'] = ServiceType::orderBy('position', 'asc')->where('status', 1)->get();
        
        return view('backend.service.services')->with($data);
    }
    // Service store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'service' => 'required',
        ]);

        $data = new Service();
        $data->service_id = $request->service;
        $data->title = $request->title;
        $data->slug = $this->createSlug('services', $request->title);
        $data->description = $request->description;
        $data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $data->meta_description = $request->meta_description;
        $data->status = ($request->status ? 1 : 0);
      
        //if feature image set
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_image_name = $this->uniqueImagePath('services', 'image', $image->getClientOriginalName());

            $image->move(public_path('upload/images/service'), $new_image_name);
            $data->image = $new_image_name;
        }

        if ($request->hasFile('meta_image')) {
            $image = $request->file('meta_image');
            $new_image_name = rand(0000, 9999).$image->getClientOriginalName();
            $image->move(public_path('upload/images/service'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

        $store = $data->save();

        if($store){
            Toastr::success('Service added successfully.');
        }else{

            Toastr::error('Service cannot added.!');
        }

        return back();
    }

    //Edit Service
    public function edit($slug)
    {
        $data['service'] = Service::where('slug', $slug)->first();
        $data['serviceTypes'] = ServiceType::orderBy('position', 'asc')->where('status', 1)->get();
        
        echo view('backend.service.service-edit')->with($data);
    }
    // Update service
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'title' => 'required',
            'service' => 'required',
        ]);

        $data = Service::find($request->id);
        $data->service_id = $request->service;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->meta_title = ($request->meta_title) ? $request->meta_title : $request->news_title;
        $data->keywords = ($request->keywords) ? implode(',', $request->keywords) : '';
        $data->meta_description = $request->meta_description;
        $data->status = ($request->status ? 1 : 0);

        //if feature image set
        if ($request->hasFile('image')) {

            //delete image from folder
            $image_path = public_path('upload/images/service/'. $data->image);
            if(file_exists($image_path) && $data->image){
                unlink($image_path);
            }

            $image = $request->file('image');
            $new_image_name = $this->uniqueImagePath('services', 'image', $image->getClientOriginalName());
            $image->move(public_path('upload/images/service'), $new_image_name);
            $data->image = $new_image_name;
        }

        if ($request->hasFile('meta_image')) {
            $image = $request->file('meta_image');
            $new_image_name = rand(0000, 9999).$image->getClientOriginalName();
            $image->move(public_path('upload/images/service'), $new_image_name);
            $data->meta_image = $new_image_name;
        }

        $store = $data->save();

        if($store){
            Toastr::success('Service update successfully.');
        }else{

            Toastr::error('Service cannot update.!');
        }

        return back();
    }

    //Delete service
    public function delete($id)
    {
        $service = Service::find($id);

        if($service){
            $image_path = public_path('upload/images/service/'. $service->image);
            if(file_exists($image_path)){
                unlink($image_path);
            }
            $service->delete();
            $output = [
                'status' => true,
                'msg' => 'Service deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Service cannot deleted.'
            ];
        }
        return response()->json($output);
    }


    public function serviceTypeList()
    {
        $serviceTypes = ServiceType::orderBy('position', 'asc')->get();
        return view('backend.service.serviceType-list')->with(compact('serviceTypes'));
    }
    public function serviceTypeCeate()
    {
       
        return view('backend.service.serviceType')->with($data);
    }
    // Service store
    public function serviceTypeStore(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $data = new ServiceType();
        $data->title = $request->title;
        $data->slug = $this->createSlug('service_types', $request->title);
        $data->status = ($request->status ? 1 : 0);

        $store = $data->save();

        if($store){
            Toastr::success('Service type added successfully.');
        }else{

            Toastr::error('Service type cannot added.!');
        }

        return back();
    }

    //Edit Service
    public function serviceTypeEdit($id)
    {
        $data = ServiceType::find($id);
        echo view('backend.service.serviceType-edit')->with(compact('data'));
    }
    // Update service
    public function serviceTypeUpdate(Request $request)
    {
       
        $request->validate([
            'title' => 'required'
        ]);

        $data = ServiceType::find($request->id);
        $data->title = $request->title;
        $data->status = ($request->status ? 1 : 0);

        $store = $data->save();

        if($store){
            Toastr::success('Service type update successfully.');
        }else{

            Toastr::error('Service type cannot update.!');
        }

        return back();
    }

    //Delete service
    public function serviceTypeDelete($id)
    {
        $service = ServiceType::find($id);

        if($service){
           
            $service->delete();
            $output = [
                'status' => true,
                'msg' => 'Service type deleted successfully.'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Service type cannot deleted.'
            ];
        }
        return response()->json($output);
    }

    public function serviceQueryList(){
        $serviceQueries = ServiceQuery::paginate(15);

        return view('backend.service.serviceQueries')->with(compact('serviceQueries'));
    }

    public function serviceQuery(Request $request){
        $services = $request->except(['service_id', 'name', '_token', 'mobile', 'email', 'quantity', 'description' ,'image']);

        $data = new ServiceQuery();
        $data->service_id = $request->service_id;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->quantity = $request->quantity;
        $data->description = $request->description;
        $data->services = json_encode($services);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/images/service'), $new_image_name);

            $data->image = $new_image_name;
        }
        $data->save();
        return back();
    }
}
