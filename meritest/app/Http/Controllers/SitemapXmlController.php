<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapXmlController extends Controller
{
    //
    public function index() {
        return response()->view('index')->header('Content-Type', 'text/xml');
      }

}
