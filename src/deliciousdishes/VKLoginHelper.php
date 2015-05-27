<?php
/**
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
	private $scope;

	/**
	 * @param string $redirectUrl
	 * @param string $clientId - App ID
	 * @param string $clientSecret App secret key
	 * @param array $scope - array with needs permissions (@see https://vk.com/dev/permissions)
	 */
    function __construct($redirectUrl, $clientId, $clientSecret, $scope = array())
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

	/**
	 * Get VK session by authorization code after click login click
	 *
	 * @param null $code
	 * @return VKSession|null
	 * @throws VKApiError return error authorization in VK
	 */
    public function getSession($code = null)
    {
        $params = array(
            "code" => isset($code) ? $code : $this->getCode(),
            "client_secret" => $this->clientSecret,
            "client_id" => $this->clientId,
            "redirect_uri" => $this->redirectUrl,
        );
        $result = (new VKRequest(VKRequest::newSession($this->clientId, $this->clientSecret), null, $params, "GET", VKRequest::ACCESS_TOKEN_URL))->execute()->getResponseData();
        if (isset($result->access_token)) {
            return new VKSession($result->access_token, $result->user_id, $result->expires_in);
        }
        return null;
    }

    public function getLoginUrl()
    {
        $scope = implode(",", $this->scope);
        return static::AUTH_URL . "?client_id={$this->clientId}&redirect_uri={$this->redirectUrl}&response_type=code&v="
        . VKRequest::VERSION . "&scope={$scope}";
    }

} 