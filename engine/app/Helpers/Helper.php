<?php

class Helper
{   
    public static function calcReservationPrices($from , $to,$price,$duration){
        $dates = strtotime($to) - strtotime($from);
        $diffInHours = round($dates / (60 * 60));
        $priceForHour = round($price / ($duration * 24) , 2);
        return round( ( $diffInHours * $priceForHour ) ,2);
    }

    public static function calcCarReservationDaysPrice($days,$prices){
        $prices = self::arrangePrices($prices);
        $selectedPrice = 0;
        foreach($prices as $priceArr){
            if((int)$priceArr->duration >= $days){
                $selectedPrice = (int) $priceArr->price;
            }
        }

        if(!$selectedPrice && count($prices)){
            $priceArr = array_reverse($prices)[0];
            $selectedPrice = round($days / (int) $priceArr->duration , 2) * (int) $priceArr->price;
            return $selectedPrice;
        }

        return round($selectedPrice * $days);
    }

    public static function arrangePrices($array){
        usort($array, function($a, $b) {
            return $a->duration - $b->duration;
        });
        return $array;
    }

    public static function updateConfigFile($fileName,$key,$data){
        config([ $fileName.'.'.$key => $data]);
        $fp = fopen(base_path() .'/config/'.$fileName.'.php' , 'w');
        fwrite($fp, "<?php \n    return " . var_export(config($fileName), true) . ';');
        return fclose($fp);
    }

    public static function getClassesInNamespace($dir)
    {
        if (is_dir($dir)) {
            $cmd = 'grep --no-filename -E "^\S*class +.+( *{)?$" ' . $dir . '/* | cut -d" " -f2';
            exec($cmd, $output);
            return $output;
        }
        return false;
    }

    public static function RedirectWithPostForm(array $data,$url) {
        $fullData = $data;
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <script type="text/javascript">
                    function closethisasap() {
                        document.forms["redirectpost"].submit();
                    }
                </script>
            </head>
            <body onload="closethisasap();">
                <form name="redirectpost" method="post" action="<?PHP echo $url; ?>">
                    <?php
                    if (!is_null($fullData)) {
                        foreach ($fullData as $k => $v) {
                            if(is_object($v) || is_array($v)){
                                echo "<input type='hidden' name='".$k."' value='".json_encode((array)$v)."' >";
                            }else{
                                echo "<input type='hidden' name='".$k."' value='".$v."' >";
                            }
                        }
                    }
                   ?>
               </form>
            </body>
        </html>
        <?php
        exit;
    }
  
    static function formatDate($date, $formate = "Y-m-d h:i:s A", $unix = false){
        $date = str_replace("," , '' , $date);
        $FinalDate = $unix != false ? gmdate($formate, $date) : date($formate, strtotime($date));
        return $FinalDate != '1970-01-01 12:00:00' ? $FinalDate : null;
    }

    static function formatDateForDisplay($date, $withTime = false){
        if($date == null || $date == "0000-00-00 00:00:00" || $date == "0000-00-00"){
            return '';
        }

        return $withTime != false ? date("m/d/Y h:i:s A", strtotime($date)) : date("m/d/Y", strtotime($date));
    }

    static function formatDateCustom($date, $format = "Y-m-d H:i:s", $custom = false) {
        if($date == null || $date == "0000-00-00 00:00:00" || $date == "0000-00-00" || $date == ""){
            return '';
        }

        $date = str_replace("," , '' , $date);

        $FinalDate = date($format, strtotime($date));

        if ($format == '24') {
            $FinalDate = date('Y-m-d', strtotime($date)) . ' 24:00:00';
        }

        if ($custom != false) {
            $FinalDate = date($format, strtotime($custom, strtotime($date)));
        }

        return $FinalDate != '1970-01-01 12:00:00' ? $FinalDate : null;
    }

    static function getFolderSize($path){
        $file_size = 0;
        if(file_exists($path)){
            foreach( \File::allFiles($path) as $file)
            {
                $file_size += $file->getSize();
            }
            $file_size = $file_size/(1024 * 1024);
            $file_size = number_format($file_size,2);
        }
        return $file_size;
    }

    static function fixPaginate($url, $key) {
        if(strpos($key , $url) == false){
            $url = preg_replace('/(.*)(?)' . $key . '=[^&]+?(?)[0-9]{0,4}(.*)|[^&]+&(&)(.*)/i', '$1$2$3$4$5$6$7$8$9$10$11$12$13$14$15$16$17$18$19$20', $url . '&');
            $url = substr($url, 0, -1);
            return $url ;
        }else{
            return $url;
        }
    }

    Static function generatePagination($source){
        $uri = \Request::getUri();
        $count = count($source);
        $total = $source->total();
        $lastPage = $source->lastPage();
        $currentPage = $source->currentPage();

        $data = new \stdClass();
        $data->count = $count;
        $data->total_count = $total;
        $data->current_page = $currentPage;
        $data->last_page = $lastPage;
        $next = $currentPage + 1;
        $prev = $currentPage - 1;

        $newUrl = self::fixPaginate($uri, "page");

        if(preg_match('/(&)/' , $newUrl) != 0 || strpos($newUrl , '?') != false ){
            $separator = '&';
        }else{
            $separator = '?';
        }

        if($currentPage !=  $lastPage ){
            $link = str_replace('&&' , '&' , $newUrl . $separator. "page=". $next);
            $link = str_replace('?&' , '?' , $link);
            $data->next = $link;
            if($currentPage == 1){
                $data->prev = "";
            }else{
                $link = str_replace('&&' , '&' , $newUrl . $separator. "page=". $prev);
                $link = str_replace('?&' , '?' , $link);
                $data->prev = $link ;
            }
        }else{
            $data->next = "";
            if($currentPage == 1){
                $data->prev = "";
            }else{
                $link = str_replace('&&' , '&' , $newUrl . $separator. "page=". $prev);
                $link = str_replace('?&' , '?' , $link);
                $data->prev = $link ;
            }
        }

        return $data;
    }

    static function checkRules($rule){
        if(IS_ADMIN){
            return true;
        }
        $explodeRule = explode(',', $rule);
        $containsSearch = count(array_intersect($explodeRule, (array) PERMISSIONS)) > 0;
        if($containsSearch == true){
            return true;
        }
        return false;
    }

    static function globalDelete($dataObj,$deleteRow=false) {
        if ($dataObj == null) {
            return response()->json(\TraitsFunc::ErrorMessage(trans('main.notExist')));
        }

        if(!$deleteRow){
            $dataObj->deleted_by = USER_ID;
            $dataObj->deleted_at = date('Y-m-d H:i:s');
            $dataObj->save();
        }else{
            $dataObj->delete();
        }
        
        $data['status'] = \TraitsFunc::SuccessResponse(trans('main.deleteSuccess'));
        return response()->json($data);
    }

    static function getAllPerms(){
        $controllers = config('permissions');
        $modules = config('modules.modules');
        foreach ($modules as $key => $module) {
            $modulePerms = config(lcfirst($module).'.permissions') ? array_unique(config(lcfirst($module).'.permissions')) : [];
            $controllers = array_merge($controllers,$modulePerms);
        }
        return $controllers;
    }
    
    static function getPermissions(){
        $data = [];
        $perms = self::getAllPerms() ;
        foreach ($perms as $key => $perm) {
            if($perm != 'general'){
                $controller = explode('@', $key)[0];
                $data[$controller][$perm] = [
                    'perm_name' => $perm,
                    'perm_title' => trans('permission.'.$perm),
                ];
            }
        }
        return $data;
    }
}
