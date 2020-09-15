<?php
require_once '../config/config.php';
$r = request();
if (request()->ajax() && $r->csrf_token == csrf_token())
{
    dd($r->all(), explode(',', $r->mustHave));
    return responseJSON($r->all());
}