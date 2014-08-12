<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dmitriy Moisseyenko
 * Date: 12.08.14
 * Time: 10:08
 */

namespace DeliciousDishes;


class VKLoginHelper
{

    const AUTH_URL = "https://oauth.vk.com/authorize";

    private $redirectUrl;
    private $clientId;
    private $clientSecret;

    function __construct($redirectUrl, $clientId, $clientSecret, $scope = null)
    {
        $this->redirectUrl = $redirectUrl;
        $this->clientId = $clientId;
        $this->scope = $scope;
        $this->clientSecret = $clientSecret;
    }

    public function getCode()
    {
        return (isset($_GET["code"]) ? $_GET["code"] : null);
    }

    public function getSession()
    {
        $params = array(
            "code" => $this->getCode(),
            "client_secret" => $this->clientSecret,
            "client_id" => $this->clientId,
            "redirect_uri" => $this->redirectUrl
        );
        $result = (new VKRequest(null, $params, "GET", self::AUTH_URL))->execute();
        if (isset($result->access_token)) {
            return new VKSession($result->access_token, $result->user_id, $result->expires_in);
        }
        return null;
    }

    public function getLoginUrl()
    {
        return static::AUTH_URL . "client_id={$this->clientId}&redirect_uri={$this->redirectUrl}&response_type=code&v="
        . VKRequest::VERSION . "&scope={$this->scope}";
    }

} 