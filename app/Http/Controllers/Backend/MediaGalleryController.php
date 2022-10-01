<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use App\Models\News;
use App\Traits\CreateSlug;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MediaGalleryController extends Controller
{
    use CreateSlug;
    public function photo_list(){
        $get_data = MediaGallery::where('type', 1);
        if(!Auth::guard('admin')->check()){
            $user_id = Auth::guard('reporter')->id();
            $get_data->where('user_id', $user_id);
        }
        $get_data =  $get_data->orderBy('id', 'DESC')->paginate(25);
        return view('backend.gallery.photo-gallery')->with(compact('get_data'));
    }

    public function photo_upload(Request $request){
       
        $user_id = Auth::guard('admin')->id();
        if(!Auth::guard('admin')->check()){
            $user_id = Auth::guard('reporter')->id();
        }
        $image_name = null;
        if($request->hasFile('photo')) {
            $images = $request->file('photo');
            foreach ($images as $image) {
            $image_name = $this->uniqueImagePath('media_galleries', 'source_path', $image->getClientOriginalName());
            $image_path = public_path('upload/images/thumb_img/' . $image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 115);
            $image_resize->save($image_path);

            // Add water mark in image
            $img = Image::make($image->getRealPath());
            //facebook size
            $img->resize(600, 315);
            $watermark = Image::make(public_path('upload/images/logo/'.config('siteSetting.watermark')));
            $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
            $watermarkSize = $img->width() / 1; //half of the image size (2 dele half)
            $resizePercentage = 0;//0% less then an actual image (play with this value)
            $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
            // resize watermark width keep height auto
            $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            //insert resized watermark to image center aligned
            $img->insert($watermark, 'bottom-center');
            //overrite image or new name choose
            $img->save(public_path('upload/images/watermark/' . $image_name));

            $image_path = public_path('upload/images/news/' . $image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(1280, 667);
            $image_resize->save($image_path);

            $data = [
                'title' => $request->title,
                'source_path' => $image_name,
                'type' => 1,
                'user_id' => $user_id,
            ];
            $insert = MediaGallery::create($data);
            }
            $output = array(
                'success' => $insert->id,
                'image' => '<input class="dropify" id="input-file-disable-remove" data-show-remove="false" data-default-file="' . asset('upload/images/news/' . $image_name) . '">'
            );
        }else{
            $output = array(
                'success' => false,
            );
        }
        return response()->json($output);
    }

    public function photo_edit($id)
    {
        $data = MediaGallery::find($id);
        echo view('backend.gallery.edit.photo-gallery')->with(compact('data'));
    }

    public function photo_update(Request $request)
    {
        $check = MediaGallery::find($request->id);
        if($check){

            $image_name = null;
            if($request->hasFile('photo')){
                //If photo exits, delete photo from folder
                $source_path = public_path('upload/images/'.$check->source_path);
                if(file_exists($source_path)){
                    unlink($source_path);
                    unlink(public_path('upload/images/thumb_img/'.$check->source_path));
                }

                $image = $request->file('photo');
                 $image_name = $this->uniqueImagePath('media_galleries', 'source_path', $image->getClientOriginalName());

                $image_path = public_path('upload/images/thumb_img/'.$image_name );
                $image_resize = Image::make($image);
                $image_resize->resize(200, 115);
                $image_resize->save($image_path);

                $image_path = public_path('upload/images/news/'.$image_name );
                Image::make($image)->save($image_path);

                $data = [
                    'title' => $request->title,
                    'source_path' => $image_name,
                    'type' => 1,

                ];


            }else{
                $data = [
                    'title' => $request->title,

                ];
            }

            $update = MediaGallery::where('id', $request->id)->update($data);
            if($update){
                Toastr::success('Image update successfully.');
            }else{
                Toastr::success('Sorry image cann\'t updated.');
            }

        }else{
            Toastr::error('Sorry image cann\'t updated.');
        }

        return back();

    }

    public function photo_delete($id)
    {

        $check = MediaGallery::find($id);
        if($check){
            $source_path = public_path('upload/images/news/'.$check->source_path);
            if(file_exists($source_path)){ //If it exits, delete it from folder
                unlink($source_path);
                unlink(public_path('upload/images/thumb_img/'.$check->source_path));
            }
            $delete =  $check->delete();

            $output = [
                'status' => true,
                'msg' => 'Photo deleted successfully.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry photo cann\'t deleted.'
            ];
        }
        return response()->json($output);
    }


    // upload  desciption inner photo CKEditor
    public function photo_uploadCKEditor(Request $request){

        $user_id = Auth::guard('admin')->id();
        if(!Auth::guard('admin')->check()){
            $user_id = Auth::guard('reporter')->id();
        } 
        $image_name = $message = $url = null;
        $function_number = $request->input('CKEditorFuncNum');

        $rules = array(
            'upload'  => 'mimes:jpeg,jpg,png,gif,web|required|max:2024'
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            $message = 'Invalid image selected.';
            return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
        }

        if($request->hasFile('upload')){
            $image = $request->file('upload');
            $image_name = $this->uniqueImagePath('media_galleries', 'source_path', $image->getClientOriginalName());

            $image_path = public_path('upload/images/thumb_img/'.$image_name );
            $image_resize = Image::make($image);
            $image_resize->resize(200, 115);
            $image_resize->save($image_path);

            $image_path = public_path('upload/images/news/'.$image_name );
            Image::make($image)->save($image_path);

        
            $data = [
                'title' => $request->title,
                'source_path' => $image_name,
                'type' => 1,
                'user_id' => $user_id,
            ];
            $insert = MediaGallery::create($data);

        }else{
            $message = 'No image uploaded.';
        }
        $path = url('upload/images/news/'.$image_name);

        return "<script>window.parent.CKEDITOR.tools.callFunction($function_number, \"$path\", $message);</script>";

    }
    public function video_list(){
        $get_data = MediaGallery::where('type', 2);
        if(!Auth::guard('admin')->check()){
            $user_id = Auth::guard('reporter')->id();
            $get_data->where('user_id', $user_id);
        }
        $get_data = $get_data->orderBy('id', 'DESC')->get();
        return view('backend.gallery.video-gallery')->with(compact('get_data'));
    }

    public function video_upload(Request $request){

        $user_id = Auth::user()->id;

        $rules = array(
            'video' => 'required|mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,wmv',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->hasFile('video')){
            $video = $request->file('video');
            $video_path = $this->uniqueImagePath($video->getClientOriginalName());
            $path = public_path('upload/videos/'); // video upload ar time a path seperate dete hoy
            $video->move($path, $video_path);
        }
        $data = [
            'title' => $request->title,
            'source_path' => $video_path,
            'type' => 2,
            'user_id' => $user_id,
        ];
        $insert = MediaGallery::create($data);
        $output = array(
             'success' => '<input type="hidden" name="video" value="'.$insert->id.'">',
             'image'  => '<video width="100%" height="157" controls><source src="'.asset('upload/videos/'.$video_path).'" type="video/mp4"></video>'
            );
       return response()->json($output);
    }

    public function video_edit($id)
    {
        $data = MediaGallery::find($id);
        echo view('backend.gallery.edit.video-edit')->with(compact('data'));
    }

    public function video_update(Request $request)
    {
        $check = MediaGallery::find($request->id);
        if($check){
            $user_id = Auth::user()->id;
            $request->validate([
                'video' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv',
            ]);

            if($request->hasFile('video')){
                //If it exits, delete it from folder
                $source_path = public_path('upload/videos/'.$check->source_path);
                if(file_exists($source_path)){
                    unlink($source_path);
                }
                $video = $request->file('video');
                $video_path = $this->uniqueImagePath($video->getClientOriginalName());
                $path = public_path('upload/videos/'); // video upload ar time a path seperate dete hoy
                $video->move($path, $video_path);

                $data = [
                    'title' => $request->title,
                    'source_path' => $video_path,
                    'user_id' => $user_id,
                ];
            }else{
                $data = [
                    'title' => $request->title,
                    'user_id' => $user_id,
                ];
            }

            $update = MediaGallery::where('id', $request->id)->update($data);
            if($update){
                Toastr::success('video update successful.');
            }else{
                Toastr::success('Sorry video cann\'t updated.');
            }

        }else{
            Toastr::error('Sorry video can\'t update.');
        }

        return back();

    }

    public function video_delete($id)
    {
        $check = MediaGallery::find($id);
        if($check){
            $source_path = public_path('upload/videos/'.$check->source_path);
            if(file_exists($source_path)){ //If it exits, delete it from folder
                unlink($source_path);
            }
            $delete =  $check->delete();

            $output = [
                'status' => true,
                'msg' => 'Video deleted successful.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry Video cann\'t deleted.'
            ];
        }
        return response()->json($output);
    }


}
