<?php

trait TraitsFunc
{	

	public function scopeActive($query){
        return $query->whereRaw('(status=1)');
    }
    
	public function scopeNotDeleted($query){
        return $query->whereRaw('(deleted_at IS NULL)');
    }

	public static function NotFound(){
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->satuts = 0;
        $statusObj['status']->code = 204;
        $statusObj['status']->message = trans('main.notFound');
        return \Response::json((object) $statusObj);
    }

    public static function NotAllowed(){
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->satuts = 0;
        $statusObj['status']->code = 405;
        $statusObj['status']->message = trans('main.method');
        return \Response::json((object) $statusObj);
    }

	public static function ValidationError($validator){
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->satuts = 0;
        $statusObj['status']->code = 400;
        $statusObj['status']->message = $validator->messages()->first();
        return \Response::json((object) $statusObj);
	}

    public static function ErrorMessage($message = '', $code = 400){     
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->satuts = 0;
        $statusObj['status']->code = $code;
        $statusObj['status']->message = $message == '' ? trans('main.error') : $message;
        return \Response::json((object) $statusObj);
    }
    
	public static function SuccessResponse($message = ''){
	    $statusObj = new stdClass();
	    $statusObj->status = 1;
	    $statusObj->code = 200;
        $statusObj->message = $message == '' ? trans('main.success') : $message;
		return (object) $statusObj;
	}

	public static function SuccessMessage($message = ''){     
        $statusObj['status'] = new \stdClass();
        $statusObj['status']->satuts = 200;
        $statusObj['status']->code = 1;
        $statusObj['status']->message = $message == '' ? trans('main.success') : $message;
        return \Response::json((object) $statusObj);
    }

	public static function PublicDDM($dataArr, $withoutLang = false) {
        $list = [];
        foreach($dataArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key]->id = $value->id;
            $list[$key]->title = $withoutLang == true ? $value->title : $value->{'title' . LANGUAGE_PREF};
        }

        $statusObj['data'] = new \stdClass();
        $statusObj['data'] = $list;
        $statusObj['status'] = self::SuccessResponse(trans('main.load'));
		return (object) $statusObj;
    }

	public static function exceptionError($exception){
		$data  = new stdClass();
		$data->status = 0;
		$data->code = 500;
		$data->message = $exception->getMessage();
		$data->line = $exception->getLine();
		$data->file = $exception->getFile();
		$data->exception_code = $exception->getCode();
		$data->exception_code = $exception->getCode();
		return $data;
	}

	private Static function Pagination($object){
		$uri = \Illuminate\Support\Facades\Input::getUri();
		$pageparam = $object->getPageName();
		$currentPage = $object->currentPage() ;
		$lastPage = $object->lastpage() ;
		$data = new \stdClass();
		$data->count = $object->count();
		$data->total_count = $object->total();
		$data->current_page = $object->currentPage();
		$data->last_page = $object->lastpage();
		$next = $currentPage + 1;
		$prev = $lastPage - 1;
		$newUrl = self::paginationFilter($uri, "$pageparam");
		if(preg_match('/(&)/' , $newUrl) != 0 || strpos($newUrl , '?') != false ){
			$separator = '&';
		}else{
			$separator = '?';
		}
		if($currentPage !=  $lastPage ){
			$link = str_replace('&&' , '&' , $newUrl . $separator. "$pageparam=". $next);
			$link = str_replace('?&' , '?' , $link);
			$data->next = $link;
			if($currentPage == 1){
				$data->prev = "";
			}else{
				$link = str_replace('&&' , '&' , $newUrl . $separator. "$pageparam=". $prev);
				$link = str_replace('?&' , '?' , $link);
				$data->prev = $link ;
			}
		}else{
			$data->next = "";
			if($currentPage == 1){
				$data->prev = "";
			}else{
				$link = str_replace('&&' , '&' , $newUrl . $separator. "$pageparam=". $prev);
				$link = str_replace('?&' , '?' , $link);
				$data->prev = $link ;
			}
		}
		return $data;
	}

	private static function paginationFilter($url, $key) {
		if(strpos($key , $url) == false){
			$url = preg_replace('/(.*)(?)' . $key . '=[^&]+?(?)[0-9]{0,4}(.*)|[^&]+&(&)(.*)/i', '$1$2$3$4$5$6$7$8$9$10$11$12$13$14$15$16$17$18$19$20', $url . '&');
			$url = substr($url, 0, -1);
			return $url ;
		}else{
			return $url;
		}
	}


	public static function response($result, $message = 'Successfully')
    {
        $response = [
            'success' => true,
            'data' 		=> $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public static function unauthenticated()
    {
        $response = [
            'message' => 'Unauthenticated',
        ];

        return response()->json($response, 401);
    }

    public static function error($error, $errorMessages = [], $code = 402)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public static function invalidData($error, $errorMessages = [], $code = 422)
    {
        $response = [
            'message' => 'The given data was invalid.',
            'errors' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public static function notFoundResponse($errorMessages = [], $code =404)
    {
        $response = [
            'success' => false,
            'message' => __("apps::api.not_found"),
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }




    public static function responsePagnation($pagantion, $message = 'Successfully')
    {
        return $pagantion->additional(['success' => true, "message"=> $message]);
    }

    public static function responsePagnationWithData($pagantion, $data=[], $message = 'Successfully')
    {
        $addation = array_merge(['success' => true, "message"=> $message], $data);
        return $pagantion->additional($addation);
    }
}
