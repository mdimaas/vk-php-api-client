<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dmitriy Moisseyenko
 * Date: 12.08.14
 * Time: 13:29
 */

namespace DeliciousDishes;


class VKResponse {

    protected $request;
    protected $responseData;

    function __construct($request, $responseData)
    {
        $this->request = $request;
        $this->responseData = $responseData;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $responseData
     */
    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * @return mixed
     */
    public function getResponseData()
    {
        return $this->responseData;
    }




} 