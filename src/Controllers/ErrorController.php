<?php

namespace App\Controllers;

class ErrorController
{
    function code404()
    {
        return view('errors.404');
    }

    function code500($message = '')
    {
        return view('errors.500', compact('message'));
    }
}
