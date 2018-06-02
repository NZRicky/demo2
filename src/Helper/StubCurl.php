<?php
/**
 * Created by PhpStorm.
 * User: ricky
 * Date: 31/5/18
 * Time: 3:30 PM
 */

namespace Ricky\Helper;

/**
 *
 * This is the stub class for Curl to do the unit test.
 */
class StubCurl extends Curl
{
    /**
     * @var string url for connection
     */
    protected $url;

    /**
     * @var string request type "GET, POST, PUT..."
     */
    protected $type;

    /**
     * @var mix response data
     */
    protected $response;



    /**
     * @var integer response code from the request
     */
    protected $status;


    public function __construct()
    {
        $this->url = null;

        // make default type to GET if not specified
        $this->type = 'GET';

        $this->status = null;
        $this->response = null;

    }


    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }


    /**
     * Set the response returned by server(use for stub test).
     *
     * @param $response
     * @return StubCurl
     */
    public function setResponse($response) {
        $this->response = $response;
        return $this;
    }
    public function getResponse()
    {
        return $this->response;
    }

    public function getStatusCode()
    {
        return $this->status;
    }



    /**
     * execute the request and get response & response status
     *
     * @return $this|null
     */
    public function execute()
    {
        if (!$this->url) {
            return null;
        }

        return $this;

    }



}