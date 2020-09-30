<?php


namespace Farm\Infrastructure;

//TODO: implement psr
class Request
{
    /**
     * @var array Collection of request headers.
     */
    private $_headers;

    private $_method;

    public function __construct() {
        $headers = http_get_request_headers();
        foreach ($headers as $name => $value) {
            $this->_headers[$name] = $value;
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->_method =  strtoupper($_SERVER['REQUEST_METHOD']);
        }else{
            $this->_method =  'GET';
        }
    }



}