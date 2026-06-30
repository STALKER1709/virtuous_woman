<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function mentionsLegales()
    {
        return view('legal.mentions-legales');
    }

    public function cgv()
    {
        return view('legal.cgv');
    }

    public function confidentialite()
    {
        return view('legal.confidentialite');
    }

    public function cookies()
    {
        return view('legal.cookies');
    }
}
