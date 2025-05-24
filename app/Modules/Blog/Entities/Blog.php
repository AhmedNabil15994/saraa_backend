<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {
    use SoftDeletes;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','date','image','category_id','status','views','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'blogs';
    protected $appends = ['image_url','category_name','title','description'];

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('blogs',$this->id,$this->image,true);
    }

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function getDescriptionAttribute(){
        return $this->{'description_'.LANGUAGE_PREF};
    }

    public function increaseViews(){
        return $this->update(['views'=> ($this->views+1) ]);
    }

    public function Category(){
        return $this->belongsTo('App\Entities\Category','category_id','id');
    }

    public function getCategoryNameAttribute(){
        return $this->category_id != null ? $this->Category->{'name_'.LANGUAGE_PREF}  : '';
    }
}
