<?php
require_once '../config/config.php';
$r = request();
if (request()->ajax() && $r->csrf_token == csrf_token())
{
    return responseJSON($r->all());
}