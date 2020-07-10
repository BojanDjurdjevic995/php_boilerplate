<?php

namespace App\Traits;

trait TextTrait
{
    public function trim_text($input, $length, $ellipses = true, $strip_html = true) 
    {
        mb_internal_encoding("UTF-8");
        if ($strip_html) 
        {
            $input = strip_tags($input, "<a>");
        }
        if (mb_strlen($input) <= $length) 
        {
            return $input;
        }
        $last_space = mb_strrpos(mb_substr($input, 0, $length), ' ');
        $trimmed_text = mb_substr($input, 0, $last_space);
        if ($ellipses) 
        {
            $trimmed_text .= '...';
        }
    
        return $trimmed_text;
    }
    

}