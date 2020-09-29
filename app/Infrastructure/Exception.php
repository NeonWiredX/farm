<?php


namespace Farm\Infrastructure;


abstract class Exception extends \Exception
{
    protected int $statusCode = 500;
}