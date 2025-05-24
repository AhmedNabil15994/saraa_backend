<?php namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    use \TraitsFunc;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $appends = ['image_url'];

    static function getPhotoPath($id, $photo) {
        return \FilesHelper::GetImagePath('users', $id, $photo);
    }

    static function getOne($id){
        return self::NotDeleted()
            ->where('id', $id)
            ->first();
    }

    static function checkUserByEmail($email, $notId = false){
        $dataObj = self::NotDeleted()->active()
            ->where('email', $email);

        if ($notId != false) {
            $dataObj->whereNotIn('id', [$notId]);
        }

        return $dataObj->first();
    }

    static function checkUserByPhone($mobile, $notId = false){
        $dataObj = self::NotDeleted()->active()
            ->where('mobile', $mobile);

        if ($notId != false) {
            $notId = (array) $notId;
            $dataObj->whereNotIn('id', $notId);
        }

        return $dataObj->first();
    }

    static function getUser() {
        return self::NotDeleted()
            ->where('id', USER_ID)
            ->first();
    }

    static function getLoginUser($email){
        $userObj = self::NotDeleted()->active()
            ->where('email', $email)
            ->orWhere('mobile', '+'.$email)
            ->first();

        if($userObj == null || $userObj->role_id != 3) {
            return false;
        }
        return $userObj;
    }

    public function getImageUrlAttribute(){
        return $this->getPhotoPath($this->id, $this->image);
    }
}
