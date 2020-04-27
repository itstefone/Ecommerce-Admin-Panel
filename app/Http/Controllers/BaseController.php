<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use FlashMessages;


    protected $data = null;


    protected function setPageTitle($title, $subtitle) {
        view()->share(['pageTitle' => $title, 'subTitle' =>$subtitle]);
    }

    

    protected function showErrorPage($errorCode = 404, $message = null) {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }


    protected function responseJson($error = true, $responseCode = 200, $message =[], $data = null) {

        return response()->json(
            [
                'error' => $error,
                'response_code' =>$responseCode,
                'message' => $message,
                'data' => $data
            ]
            );
    }



    protected function responseRedirect($route, $message, $type='info', $error = false, $withOldInputWhenError = false ) {
        $this->setFlashMessage($type, $message);
        $this->showFlashMessage();

        if($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    protected function responseRedirectBack($message, $type='info') {

        $this->setFlashMessage($type, $message);

        $this->showFlashMessage();

        return redirect()->back();
    }
}
