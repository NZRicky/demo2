<?php
/**
 * Created by PhpStorm.
 * User: ricky
 * Date: 31/5/18
 * Time: 2:31 PM
 */


namespace Ricky\Model;


/**
 * This is the server model
 *
 * @package Ricky\Model
 */
class Server
{


    /**
     * @var string Server name
     */
    private $name;



    /**
     * Set server's name
     *
     * @param $name
     * @return Server
     */
    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get server's name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }



}