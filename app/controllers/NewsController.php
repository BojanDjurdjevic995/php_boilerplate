<?php


namespace App\Controllers;

use App\Models\News;

class NewsController
{
    public function index()
    {
        echo 'index';
    }

    public function show($news)
    {
        dd($news);
    }

    public function create()
    {
        echo 'create';
    }

    public function store()
    {
        dd($_REQUEST);
    }

    public function edit(News $news)
    {
        dd($news);
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