<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
        View::share('nav', 1);
    }

    public function index(Request $request)
    {
        return redirect()->route('user.index');
        return view('index.index');
    }

}
