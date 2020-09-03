<?php

namespace App\Http\Controllers;

trait AjaxResponse
{

    public function success($message = '', $redirect = null)
    {
        return [
            'status'     => 'SUCCESS',
            'statusCode' => 200,
            'message'    => $message,
            'redirect'   => $redirect,
        ];
    }

    public function error($message = '', $redirect = null)
    {
        return [
            'status'     => 'ERROR',
            'statusCode' => 400,
            'message'    => $message,
            'redirect'   => $redirect,
        ];
    }

}
