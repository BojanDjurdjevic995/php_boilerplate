<?php
require_once './config/config.php';
use App\Models\News;
use \App\Models\NewsLang;
use Illuminate\Support\Str;

$news = NewsLang::find(21);

dd($news);
