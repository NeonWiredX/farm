<?php


namespace Farm\Infrastructure;

//TODO: implement psr
class Request {
    /**
     * @var array Collection of request headers.
     */
    private $headers;

    private $method;

    private $get;

    private $post;

    private $rawBody;

    private $queryParams;

    private $bodyParams;

    public function __construct() {
        foreach ($_SERVER as $name => $value) {
            if (strncmp( $name, 'HTTP_', 5 ) === 0) {
                $name = str_replace( ' ', '-', ucwords( strtolower( str_replace( '_', ' ', substr( $name, 5 ) ) ) ) );
                $this->headers[$name] = $value;
            }
        }

        if (isset( $_SERVER['REQUEST_METHOD'] )) {
            $this->method = strtoupper( $_SERVER['REQUEST_METHOD'] );
        } else {
            $this->method = 'GET';
        }

        if ($this->rawBody === null) {
            $this->rawBody = file_get_contents( 'php://input' );
        }

        if ($this->queryParams === null) {
            $this->queryParams = $_GET;
        }

        if ($this->bodyParams === null) {
            //TODO: CHECK CONTENT-TYPE
            $this->bodyParams = json_decode( $_POST );
        }
    }

}