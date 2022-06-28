<?php

namespace Libraries\Console;

class Styling {

    protected function print(string $string)
    {
        echo "$string";
    }

    protected function println(string $string)
    {
        echo "\n$string";
    }

    protected function br()
    {
        echo "\n";
    }

    //Color
    protected function setDefault()
    {
        echo "\e[39m";
    }

    protected function setError()
    {
        echo "\e[31m";
    }

    protected function setSuccess()
    {
        echo "\e[32m";
    }

    protected function setInfo()
    {
        echo "\e[34m";
    }

    protected function setWarning()
    {
        echo "\e[33m";
    }

}