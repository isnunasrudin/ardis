<?php

namespace Libraries;

use mysqli_result;

class Collection
{
    public static function mysqlresultToObject(mysqli_result $result, string $object) : array
    {
        $data = array();
        while($r = $result->fetch_object($object)) $data[] = $r;
        return $data;
    }
}