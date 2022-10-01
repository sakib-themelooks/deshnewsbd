<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class HomepageSectionItem extends Model
{
     use HasFactory;

    protected $guarded = [];
    public function news(){
        return $this->belongsTo(News::class, 'item_id', 'id');
    }

	public function newsByCategory(){
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        return $this->hasMany(News::class, 'category','item_id')->where('lang', $lang)->where('publish_date', '<=', $date);
    }
    
    public function newsBySubCategory(){
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
        $date = Carbon::parse(now())->format('Y-m-d H:i:s');
        return $this->hasMany(News::class, 'subcategory','item_id')->where('lang', $lang)->where('publish_date', '<=', $date);
    }
    public function englishNewsByCategory(){
        return $this->hasMany(News::class, 'category','item_id')->where('lang', '!=', 'bd');
    }

    public function getCategories(){
        return $this->hasMany(Category::class, 'category_id', 'item_id');
    }   
    
    
    public function subcategory(){
        return $this->belongsTo(Category::class, 'item_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'item_id', 'id');
    }
    public function getAds(){
        return $this->hasMany(Addvertisement::class, 'id', 'item_id');
    }

    public function ads_details(){
        return $this->belongsTo(Addvertisement::class, 'item_id', 'id');
    }
    public function banner(){
        return $this->belongsTo(Banner::class, 'item_id', 'id');
    }
}
