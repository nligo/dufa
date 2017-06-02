<?php
namespace Dufa\Bundle\UserBundle\Services;

class DataDetection
{
    public function generateSetMethod($obj,$data)
    {
        foreach ($data as $k => $v) {
            $setMethod = 'set'.ucfirst($k);
            $obj->$setMethod($v);
        }
        return $obj;
    }
}