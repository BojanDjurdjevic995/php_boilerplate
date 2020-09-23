<?php


namespace App\Controllers;


use App\Models\News;
use Illuminate\Http\Request;

class NewsController
{
    public function index()
    {
        echo 'index';
    }

    public function show($news)
    {
        $news = News::whereId($news)->with('children')->first();
        dd($news);
    }

    public function create()
    {
        echo 'create';
    }

    public function store(Request $request)
    {
        dd($request, $_REQUEST);
    }

    public function edit()
    {
        echo 'edit';
    }

    public function update()
    {
        echo 'update';
    }

    public function destroy()
    {
        echo 'destroy';
    }
}