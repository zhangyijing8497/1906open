<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GithubController extends Controller
{
    public function index()
    {
        return view('github.index');
    }


    public function callback()
    {
        echo '<pre>';print_r($_GET);echo '</pre>';
    }
    
}
