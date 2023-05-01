<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonPagesController extends Controller
{
    public function terms()
    {
        return view('commonPages.terms-of-serivce');
    }

    public function faq()
    {
        return view('commonPages.faq');
    }

    public function privacy()
    {
        return view('commonPages.privacy');
    }

}