<?php

use Illuminate\Http\Request;

class FilesHelper {

    static function getFileSize($url){
        if($url == ""){
            return '';
        }
        $path = str_replace(URL::to('/'), '', $url);
        $path = public_path().$path;

        if(!is_file($path)){
            return '';
        }
        stream_context_set_default( [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        $image = get_headers($url, 1);
        $bytes = @$image["Content-Length"];
        $mb = $bytes/(1024 * 1024);
        return number_format($mb,2) . " MB ";
    }

    static function checkExtensionType($extension,$type=null){
        $images = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','svg+xml'];

        if(in_array($extension, $images)){
            if($type != null){
                return ['photo',$images];
            }
            return 'photo';
        }
        return false;
    }

    static function getImagePath($strAction, $id, $filename,$withDefault=true,$tenantId=null) {
        $default = '';
        if($withDefault){
            $default = asset(config('modules.site_configs.default_upload_img'));
            $default = str_replace('engine.','app.',$default);
        }

        if($filename == '') {
            return $default;
        }

        $path = config('app.BASE_URL').'/';
        // $path = asset('/').'/';
        $checkFile = public_path() . '/uploads';
        $checkFile = str_replace('engine.saraakw.com/public/','app.saraakw.com/',$checkFile);

        switch ($strAction) {
            case "users":
                $fullPath = $path . 'uploads' . '/users/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/users/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "settings":
                $fullPath = $path . 'uploads' . '/settings/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/settings/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "sections":
                $fullPath = $path . 'uploads' . '/sections/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/sections/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "categories":
                $fullPath = $path . 'uploads' . '/categories/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/categories/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "blogs":
                $fullPath = $path . 'uploads' . '/blogs/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/blogs/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "brands":
                $fullPath = $path . 'uploads' . '/brands/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/brands/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "stores":
                $fullPath = $path . 'uploads' . '/stores/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/stores/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "cars":
                $fullPath = $path . 'uploads' . '/cars/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/cars/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
            case "reservations":
                $fullPath = $path . 'uploads' . '/reservations/' . $id . '/' . $filename;
                $checkFile = $checkFile . '/reservations/' . $id . '/' . $filename;
                return is_file($checkFile) ? $fullPath : $default;
                break;
        }

        return $default;
    }

    static function uploadFile($strAction, $fieldInput,$id='', $fileType = '') {

        if ($fieldInput == '') {
            return false;
        }

        if (is_object($fieldInput)) {
            $fileObj = $fieldInput;
        } else {
            if (!Request::hasFile($fieldInput)) {
                return false;
            }
            $fileObj = Request::file($fieldInput);
        }

        if ($fileObj->getSize() >= (int)config('modules.site_configs.limitted_size') * 1024 * 1024) {
            return false;
        }
        $extensionExplode = explode('/', $fileObj->getMimeType()); // getting image extension
        unset($extensionExplode[0]);
        $extensionExplode = array_values($extensionExplode);
        $extension = $extensionExplode[0];


        $fileData = self::checkExtensionType($extension,'getData');
        $fileType = $fileData[0];
        $appliedExtensions = $fileData[1];

        if (!in_array($extension, $appliedExtensions)) {
            return false;
        }

        $file = env('APP_NAME','Saraa');
        $path = public_path() . '/uploads/';

        $rand = rand() . date("Ymd");
        $fileName = $file . '-' . $rand;
        $directory = '';

        if ($strAction == 'users') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'users/' . $id;
        }

        if ($strAction == 'settings') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'settings/' . $id;
        }

        if ($strAction == 'sections') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'sections/' . $id;
        }

        if ($strAction == 'categories') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'categories/' . $id;
        }

        if ($strAction == 'blogs') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'blogs/' . $id;
        }

        if ($strAction == 'brands') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'brands/' . $id;
        }

        if ($strAction == 'stores') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'stores/' . $id;
        }

        if ($strAction == 'cars') {
            $path = public_path() . '/uploads/';
            $directory = $path . 'cars/' . $id;
        }

        if ($strAction == 'reservations') {
            $path = __DIR__. "/../../../public/uploads/";
            $directory = $path . 'reservations/' . $id;
        }

        $fileName_full = $fileName . '.' . $extension;
        if ($directory == '') {
            return false;
        }

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if ($fileObj->move($directory, $fileName_full)){
            return $fileName_full;
        }

        return false;
    }

    static function deleteDirectory($dir) {
        system('rm -r ' . escapeshellarg($dir), $retval);
        return $retval == 0;
    }

}
