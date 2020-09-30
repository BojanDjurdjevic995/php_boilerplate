<?php


namespace App\Controllers;

use App\Models\News;
use App\Models\NewsLang;

class IndexController
{
    public function index()
    {
        $news = NewsLang::select('id', 'slug', 'title')->get()->random(1);
        return view('index', ['news' => $news[0]]);
    }

    public function form()
    {
        $r = request();
        if ($r->isMethod('POST'))
            dd($r->request);
        return view('form', ['name' => 'Bojan', 'surname' => 'Djurdjevic']);
    }

    public function about()
    {
        return view('about');
    }

    public function singleNews($id, $slug)
    {
        $news = NewsLang::findOrFail($id, ['title', 'content']);
        $otherNews = NewsLang::where('id', '<>', $id)->paginate(5);
        return view('singleNews', ['news' => $news, 'otherNews' => $otherNews]);
    }

    public function getAllNews()
    {
        $request = request();
        if ($request->headers->get('_token') == csrf_token())
        {
            $news = News::with('children', 'gallery')->orderBy('created_at', 'DESC')->paginate(3);
            response(['success' => true, 'collection' => $news])->send();
        } else {
            response(['success' => false, 'msg' => 'Invalid CSRF token'], 403)->send();
        }
    }
}