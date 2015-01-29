<?php
/**
 * User: Dmitriy Moisseyenko
 * Date: 12.08.14
 * Time: 10:12
 */

namespace DeliciousDishes;


class VKRequest
{

    const VERSION = "5.24";
    const BASE_URL = "https://api.vk.com/method/";
    const ACCESS_TOKEN_URL = "https://oauth.vk.com/access_token";

    private $url;
    private $params;
    private $method;
    private $session;
    private $vkMethod;

    function __construct(VKSession $session, $vkMethod, $params = array(), $method = "GET", $url = null)
    {
        $this->session = $session;
        $this->method = $method;
        $this->params = $params;
        $this->url = $url;
        $this->vkMethod = $vkMethod;
    }


    public function execute()
    {
        if ($this->url == null) {
            $this->url = self::BASE_URL . $this->vkMethod;
            $this->params["access_token"] = $this->session->getAccessToken();
            $this->params["v"] = static::VERSION;
        }
        if ($this->method == "GET") {
            self::addGetParams();
        }
        $sender = new VKRequestSender();
        $result = $sender->send($this->url);
        $obj = json_decode($result);
        if (!isset($obj->error)) {
            return new VKResponse($this, $obj);
        }
        throw new VKApiError($result);

    }

    private function addGetParams()
    {
        if (sizeof($this->params) > 0) {
            $this->url .= "?";
            foreach ($this->params as $key => $value) {
                if (is_array($value) && sizeof($value) > 0) {
                    $this->url .= "{$key}=" . implode(",", $value) . "&";
                } else {
                    $this->url .= "{$key}={$value}&";
                }

            }
            $this->url = substr($this->url, 0, strlen($this->url) - 1);
        }
    }

    public static function newSession($clientId, $clientSecret)
    {
        return new VKSession("{$clientId}|{$clientSecret}");
    }

} 