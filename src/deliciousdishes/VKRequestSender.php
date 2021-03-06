<?php
/**
 * User: Dmitriy Moisseyenko
 * Date: 12.08.14
 * Time: 12:35
 */

namespace DeliciousDishes;


class VKRequestSender
{
    protected $curl;

    private function init()
    {
        $this->curl = curl_init();
    }

    private function setOption($key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }

    private function setOptions($options)
    {
        curl_setopt_array($this->curl, $options);
    }

    private function openConnection($url, $method = "GET", $params = array())
    {
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_RETURNTRANSFER => true, // Follow 301 redirects
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        );
        self::init();
        self::setOptions($options);
    }

    private function closeConnection(){
        curl_close($this->curl);
    }

    private function sendRequest(){
        return curl_exec($this->curl);
    }

    public function send($url, $method = "GET", $params = array())
    {
        self::openConnection($url, $method, $params);
        $result = self::sendRequest();
        self::closeConnection();
        return $result;
    }
} 