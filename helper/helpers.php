<?php

    function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    function asset($item = '')
    {
        return BASE_URL . $item;
    }