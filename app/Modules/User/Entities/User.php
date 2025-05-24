<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes,\TraitsFunc;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'role_id',
        'extra_permissions',
        'last_login',
        'email',
        'password',
        'remember_token',
        'image',
        'calling_code',
        'is_verified',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['role_name','image_url',];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function EmployeeStores(){
        return $this->role_id == 4 ? $this->hasMany('App\Entities\EmployeeStore','emp_id','id')  : null;
    }

    public function UserRole(){
        return $this->belongsTo('App\Entities\Role','role_id','id');
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('users',$this->id,$this->image,true);
    }

    public function getRoleNameAttribute(){
        return $this->role_id != null ? $this->UserRole->{'name_'.LANGUAGE_PREF} : '';
    }


    public function setPasswordAttribute($value)
    {
         $this->attributes['password'] = \Hash::make($value);
    }

    public function checkUserPermissions(){
        $endPermissionUser = [];
        $endPermissionRole = [];

        $roleObj = $this->UserRole;
        $rolePermissions = $roleObj != null ? $roleObj->permissions : null;

        $rolePermissionValue = $rolePermissions != null ? unserialize($rolePermissions) : null;
        if($rolePermissionValue != false){
            $endPermissionRole = $rolePermissionValue;
        }

        $endPermissionUser = $this->extra_permissions != null ? unserialize($this->extra_permissions) : [];
        $permissions = (array) array_unique(array_merge($endPermissionUser, $endPermissionRole));

        return $permissions;
    }

    static function userPermission(array $rule){
        return !IS_ADMIN ? count(array_intersect($rule, \Session::has('user_id') ? PERMISSIONS : [])) > 0 : 1;
    }
}
