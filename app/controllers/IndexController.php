<?php


namespace App\Controllers;

use App\Models\NewsLang;
use Illuminate\Http\Request;

class IndexController
{
    public function index()
    {
        $news = NewsLang::where('lang', 'en')->get();
        return view('index', ['news' => $news]);
    }

    public function form(Request $request)
    {
        $r = request();
        if ($r->isMethod('POST'))
            dd($r->request, $request->request, request()->request);
        return view('form', ['name' => 'Bojan', 'surname' => 'Djurdjevic']);
    }

    public function about()
    {
        return view('about');
    }

    public function singleNews($slug, $id)
    {
        return view('singleNews', ['id' => $id, 'slug' => $slug]);
    }
}