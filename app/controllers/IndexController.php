<?php


namespace App\Controllers;

use App\Models\News;
use App\Models\NewsLang;
use Illuminate\Http\Request;

class IndexController
{
    public function index()
    {
        $news = NewsLang::select('id', 'slug', 'title')->get()->random(1);
        return view('index', ['news' => $news[0]]);
    }

    public function form(Request $request)
    {
        if ($request->isMethod('POST'))
            dd($request->request);
        return view('form', ['name' => 'Bojan', 'surname' => 'Djurdjevic']);
    }

    public function about()
    {
        return view('about');
    }

    public function singleNews(NewsLang $news, $slug, Request $request)
    {
        $otherNews = NewsLang::where('id', '<>', $news->id)->paginate(5);
        return view('singleNews', ['news' => $news, 'otherNews' => $otherNews]);
    }

    public function getAllNews(Request $request)
    {
        if ($request->headers->get('_token') == csrf_token())
        {
            $news = News::with('children', 'gallery')->orderBy('created_at', 'DESC')->paginate(3);
            response(['success' => true, 'collection' => $news])->send();
        } else response(['success' => false, 'msg' => 'Invalid CSRF token'], 403)->send();
    }

    public function uploadFIle(Request $request)
    {
        $slika = new Uploader($request, 'file', 1);
        $slika->setMimeType('video/png', 'image/jpg', 'image/jpeg');
        $slika->setFileMaxSize(20);
        $slika->setSavePath(ROOT_PATH . 'slikice/');
        dd($slika->save());
    }
}