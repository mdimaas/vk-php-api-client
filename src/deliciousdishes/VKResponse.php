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


} 