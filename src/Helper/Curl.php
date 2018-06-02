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
 * This is the cURL helper to communicate with server
 *
 * @package Ricky\Helper
 */
class Curl
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
     * @var resource curl acturl curl connection handler
     */
    protected $ch;

    /**
     * @var integer response code from the request
     */
    protected $status;


    /**
     * Curl constructor.
     */
    public function __construct()
    {
        $this->url = null;

        // make default type to GET if not specified
        $this->type = 'GET';

        $this->ch = curl_init();
        $this->status = null;
        $this->response = null;

        // set options to request
        $this->init();
    }


    /**
     * @param $url The url used to communicate
     * @return Curl
     */
    public function setUrl($url)
    {
        $this->url = $url;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return $this;
    }

    /**
     * Can be GET,POST,PUT,DELETE type
     *
     * @param $type
     * @return Curl
     */
    public function setType($type)
    {
        $this->type = $type;
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST,
            $type);
        return $this;
    }

    /**
     * Get response of curl
     *
     * @return null|mix
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get status code
     *
     * @return int|null
     *
     */
    public function getStatusCode()
    {
        return $this->status;
    }

    /**
     * set option to curl, replace the option if specified in parameter
     *
     * @param array $options
     * @return Curl
     */
    private function init(array $options = [])
    {
        // default options for all request method
        $defaultOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => [
                "Cache-Control: no-cache"
            ]
        ];

        // replace the default options if required
        $options = array_replace($defaultOptions, $options);


        curl_setopt_array($this->ch, $options);


        return $this;

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

        $this->response = curl_exec($this->ch);
        $this->status = curl_getinfo($this->ch,
            CURLINFO_HTTP_CODE);

        return $this;

    }



}