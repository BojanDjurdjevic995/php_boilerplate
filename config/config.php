<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('Europe/Sarajevo');
session_start();
require_once './vendor/autoload.php';

set_exception_handler('myExceptionHandler');
set_error_handler('myErrorHandler');
function myExceptionHandler($exception)
{
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"">';
    echo '<div class="container" style="align-items: center;justify-content: center;display: flex;">
            <div class="alert alert-danger p-5" style="box-shadow: 0 7px 11px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                <h4>Error ['.$exception->getCode().'] in: <br>'.$exception->getFile().' on line <b>'.$exception->getLine().'</b></h4><br>
                <h4>"'.$exception->getMessage().'"</h4>
            </div>
          </div>';
}
function myErrorHandler($error, $string, $path, $line, $arguments)
{
    if (E_USER_DEPRECATED != $error)
    {
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrapg.min.css">';
        echo '<div class="container" style="align-items: center;justify-content: center;display: flex;">
                    <div class="alert alert-warning p-5" style="box-shadow: 0 7px 11px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                        <h5>'.$string.'</h5>
                    </div>
              </div>';
    }
}