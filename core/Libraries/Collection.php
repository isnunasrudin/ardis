<?php

namespace Libraries;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use mysqli_result;
use Traversable;

class Collection implements ArrayAccess, IteratorAggregate {

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
        foreach($this->data as $k => $v) $callback($v, $k);
        return $this;
    }

    public function map(callable $callback) : self
    {
        foreach($this->data as $k => $v) $this->offsetSet($k, $callback($v, $k));
        return $this;
    }

    public function merge(array $array) : self
    {
        $this->data = array_merge($this->data, $array);
        return $this;
    }

    public function pluck($key) : self
    {
        foreach($this->data as $k => $data)
        {
            $this->offsetSet($k, $data->$key);
        }
        return $this;
    }

    public function filter(callable $callback)
    {
        foreach($this as $k => $v) if($callback($v) === FALSE) $this->offsetUnset($k);
        return $this;
    }

    public function toArray() : array
    {
        return (array) $this->data;
    }

    // ArrayAccess

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

}