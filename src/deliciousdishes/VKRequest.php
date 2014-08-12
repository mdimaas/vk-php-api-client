<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dmitriy Moisseyenko
 * Date: 12.08.14
 * Time: 10:12
 */

namespace DeliciousDishes;


class VKRequest
{

    const VERSION = "5.24";
    const BASE_URL = "https://api.vk.com/method/";

    private $url;
    private $params;
    private $method;

    function __construct($vkMethod, $params = array(), $method = "GET", $url = null)
    {
        $this->method = $method;
        $this->params = $params;
        $this->url = $url;
    }


    public function execute()
    {
        if ($this->url == null) {
            $this->url = self::BASE_URL;
        }
        if ($this->method == "GET") {
            self::addGetParams();
        }
        $sender = new VKRequestSender();
        $result = $sender->send($this->url);
        $obj = json_decode($result, true);
        return new VKResponse($this, $obj);
    }

    private function addGetParams()
    {

    }

} 