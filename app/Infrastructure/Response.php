<?php


namespace Farm\Infrastructure;

//TODO: implement psr
class Response
{
    public $plainText = "s";


    public function __toString()
    {
        return $this->plainText;
    }
}