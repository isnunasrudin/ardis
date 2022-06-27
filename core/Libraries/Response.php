<?php

namespace Libraries;

class Response
{
    private $headers = array();
    private $httpCode = 200;
    private $body = null;

    public function addHeader($key, $val) : self
    {
        $this->headers[$key] = $val;
        return $this;
    }

    public function view(...$params)
    {
        return View::render(...$params);
    }

    public function json($data, $httpCode = null) : self
    {
        $this->addHeader('Content-type', 'application/json');
        $this->body = json_encode($data);
        if($httpCode) $this->httpCode = $httpCode;

        return $this;
    }

    public function getHeaders() : array
    {
        return $this->headers;
    }

    public function getHttpCode() : int
    {
        return $this->httpCode;
    }

    public function getBody() : string
    {
        return $this->body;
    }
}