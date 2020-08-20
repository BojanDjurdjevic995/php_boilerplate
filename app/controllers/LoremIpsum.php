<?php


namespace App\Controllers;


class LoremIpsum
{
    const API_URL = 'http://loripsum.net/api/';
    protected static $url = '';
    protected static $capabilities = [
        'short',
        'medium',
        'long',
        'verylong',
        'decorate',
        'link',
        'ul',
        'ol',
        'dl',
        'bq',
        'code',
        'headers',
        'allcaps',
        'prude'
    ];

    public static function html()
    {
        self::$url = str_replace('plaintext/', '', self::$url);
        return (new static());
    }

    public static function text()
    {
        self::$url .=  'plaintext/';
        return (new static());
    }

    public function generate()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::API_URL . self::$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function __callStatic($method, $arguments)
    {
        if (in_array($method, self::$capabilities))
            self::$url .= $method . '/';
        return (new static());
    }

    public function __call($method, $arguments)
    {
        if (in_array($method, self::$capabilities))
            self::$url .= $method . '/';
        return (new static());
    }
}