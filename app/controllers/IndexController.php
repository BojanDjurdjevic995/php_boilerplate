<?php


namespace App\Controllers;


use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class IndexController
{
    public function index(Request $request)
    {
        $r = request();
        if ($r->isMethod('POST'))
            dd($r);
        return includeFile('baki.php');
    }
}