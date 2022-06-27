<?php

namespace Libraries;

use ArrayAccess;
use mysqli_result;

class Collection implements ArrayAccess {

    protected $data = array();

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function mysqlresultToObject(mysqli_result $result, string $object) : self
    {
        $data = array();
        while($r = $result->fetch_object($object)) $data[] = $r;

        return new self($data);
    }

    public function each(callable $callback)
    {
        $result = null;

        foreach($this->data as $d) $result = $callback($d);

        return $result;
    }
}