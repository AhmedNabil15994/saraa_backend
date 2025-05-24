<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;
    protected $fillable = ['name_ar','name_en','parent_id','image','status','created_at','updated_at','deleted_at',];
    protected $appends = ['parent_name','image_url','name'];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'categories';

    public function Parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }
    /*********** Recursive Has Many ********************/
    public function firstChild(){
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function children(){
        return $this->firstChild()->with('children');
    }
    /*********** End Recursive Has Many ********************/

    public function Blogs(){
        return $this->hasMany('\App\Entities\Blog','category_id','id');
    }

    public function getParentNameAttribute(){
        return $this->parent_id != null ? $this->Parent->{'name_'.LANGUAGE_PREF}  : '';
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('categories',$this->id,$this->image,true);
    }

    public function getNameAttribute(){
        return $this->{'name_'.LANGUAGE_PREF};
    }

    public static function getTreeView(){
        return self::with('children')->where([
            ['status',1],
            ['parent_id',null]
        ])->get();
    }
}
