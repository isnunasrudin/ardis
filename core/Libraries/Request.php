<?php

namespace Libraries;

class Request
{
    public Collection $posts;
    public Collection $gets;
    public Collection $files;

    public function __construct(array $posts, array $gets, array $files)
    {
        $this->posts = collect($posts)->filter(fn($v) => trim($v) != '');
        $this->gets = collect(array_merge($_POST['url']['current']['params'] ?? [], $gets))->filter(fn($v) => trim($v) != '');
        $this->files = collect($files)->filter(fn($v) => trim($v) != '');
    }

    public function get($key) : string|null
    {
        return $this->gets[$key] ?? null;
    }

    public function post($key) : string|null
    {
        return $this->posts[$key] ?? null;
    }

    public function file($key)
    {
        return $this->files[$key] ?? null;
    }

    public function any($key)
    {
        return $this->post($key) ?? $this->file($key) ?? $this->get($key);
    }

    public function has($key) : bool
    {
        return $this->any($key) != null;
    }
    
    public function method() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function validate(array $rules, $aliases = array()) : Validation
    {
        return new Validation($this, $rules, $aliases);
    }

}