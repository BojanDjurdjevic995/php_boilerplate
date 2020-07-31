<?php
require_once '../config/config.php';
if (request()->isAjax() && request()->_token == csrf_token())
{
    $r = request();
    echo json_encode($r->__get());
}