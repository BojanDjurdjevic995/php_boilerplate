<?php


namespace App\Controllers;

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

    public function edit($news)
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