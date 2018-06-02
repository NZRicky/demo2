<?php
/**
 * Created by PhpStorm.
 * User: ricky
 * Date: 3/6/18
 * Time: 12:01 AM
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ricky\Controller\ServerController;
use Ricky\Model\Server;
use Ricky\Helper\StubCurl;

class ServerTest extends TestCase
{

    /**
     * Test remote server return correct response as expected.
     */
    public function testHasRemoteServerList()
    {
        $curl = new StubCurl();
        $curl->setResponse('[{"s_system":"name1"},{"s_system":"name2"}]');
        $controller = new ServerController($curl);

        $serverList = $controller->getServerListFromRemote();

        $server1 = new Server();
        $server1->setName('name1');

        $server2 = new Server();
        $server2->setName('name2');

        $expected = [$server1, $server2];
        $this->assertEquals($serverList, $expected);
    }


    /**
     * Test remote server return incorrect response
     * will throw exception
     */
    public function testReturnWrongResponseForServerList()
    {
        $curl = new StubCurl();
        $curl->setResponse('[asdfasdfanasdfasd]');
        $controller = new ServerController($curl);

        $serverList = $controller->getServerListFromRemote();
    }

    /**
     * Test if return the correct line chart data from given repsonse
     */
    public function testReturnCorrectServerStats(){
        $curl = new StubCurl();
        $curl->setResponse('[{"data_value":"1000","data_label":"abc"}]');
        $controller = new ServerController($curl);

        // here we can pass any server name
        $data = $controller->getServerStatsFromRemote('test');


        $expected = [['abc',1000]];

        $this->assertEquals($data, $expected);


    }
}