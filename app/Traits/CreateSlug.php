<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CreateSlug {

    public function createSlug($table, $slug, $field='')
    {

        $field = ($field) ? $field : 'slug';
        //remove whitspace
        $slug = strTolower(preg_replace('/[\t\n\r\s]+/', '-', trim($slug)));
        //remove unwanted characters
        $slug = preg_replace("/[?#*<>.@,{}'&\/]+/",'', $slug);
        //remove quotes
        $slug = str_replace(['"',"'"], "", $slug);
        //remove \backslash  
        $slug = str_replace(array('\/', '\\'), array('/', '-'), $slug);
       
        $slug = preg_replace("/[-]+/", "-", trim($slug));

        $check_slug = DB::table($table)->select($field)->where($field, 'like', $slug.'%')->get();
        if (count($check_slug)>0){
            //find slug until find not used.
            for ($i = 1; $i <= 9999; $i++) {
                $newSlug = $slug.'-'.$i;
                if (!$check_slug->contains($field, $newSlug)) {
                    return $newSlug;
                }
            }
        }else{ return $slug; }
    }

     public function uniqueImagePath($table, $field, $imagePath)
    {
        $imagePath = strTolower(preg_replace('/[\t\n\r\s]+/', '-', trim($imagePath)));
        //remove unwanted characters
        $imagePath = (preg_replace("/[?#*<>@,'&\/]+/", "", $imagePath));
        $imagePath = (preg_replace('/["]+/', "", $imagePath));
        $imagePath = preg_replace("/[-]+/", "-", trim($imagePath));
        $check_path = DB::table($table)->select($field)->where($field, 'like', '%'.$imagePath)->get();

        if (count($check_path)>0){
            //find slug until find not used.
            for ($i = 1; $i <= 9999; $i++) {
                $newPath = $i.'-'.$imagePath;
                if (!$check_path->contains($field, $newPath)) {
                    return $newPath;
                }
            }
        }else{ return $imagePath; }
    }

   public function uniquePath($table, $field, $imagePath)
    {
        
        $imagePath = strTolower(preg_replace('/[\t\n\r\s]+/', '-', trim($imagePath)));
        //remove unwanted characters
        $imagePath = (preg_replace("/[?#*<>@,'&\/]+/", "", $imagePath));
        $imagePath = preg_replace("/[-]+/", "-", $imagePath);

        $check_path = DB::table($table)->select($field)->where($field, 'like', '%'.$imagePath)->get();

        if (count($check_path)>0){
            //find slug until find not used.
            for ($i = 1; $i <= count($check_path)+1; $i++) {
                $newPath = $i.'-'.$imagePath;
                if (!$check_path->contains($field, $newPath)) {
                    return $newPath;
                }
            }
        }else{ return $imagePath; }
    }
}
