<?php
/**
 * User: Dmitriy Moisseyenko
 * Date: 14.08.14
 * Time: 19:17
 */

namespace DeliciousDishes;


class VKEntity {

    protected $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function getProperty($key, $arrayIndex = 0){
        return $this->data->response[$arrayIndex]->$key;
    }
}