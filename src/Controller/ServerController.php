<?php
/**
 * Created by PhpStorm.
 * User: ricky
 * Date: 31/5/18
 * Time: 2:31 PM
 */


namespace Ricky\Controller;

use Ricky\Helper\Curl;
use Ricky\Model\Server;


/**
 * This is the server controller to handle business logic
 *
 * @package Ricky\Controller
 */
class ServerController
{

    /**
     * @var Curl
     */
     private $curl;



    /**
     * constructor.
     * Inject Curl object
     *
     */
    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    /**
     * get server list from remote
     * @return array Server list collection
     */
    public function getServerListFromRemote()
    {

        try {
            $this->curl->setUrl("https://services.mysublime.net/st4ts/data/get/type/servers/")
                ->execute();

            $response = $this->curl->getResponse();

            $serverListData = json_decode($response);

            if (null == $serverListData) {
                throw new \Exception('Bad Response.');
            }
            $serverList = [];

            // only process when json_decode return array
            if (is_array($serverListData) && count($serverListData) > 0) {
                foreach ($serverListData as $s) {
                    $server = new Server();
                    $server->setName($s->s_system);
                    $serverList[] = $server;
                }
            }

            return $serverList;
        } catch (\Exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }
    }

    /**
     * get server statistics from specified server
     *
     * response json format
     * //-statistics:
     * [{"data_value":"[value]","data_label":"[date-label]"},{...}]
     *
     * @param string $serverName
     * @return array
     */
    public function getServerStatsFromRemote(string $serverName)
    {

        try {
            $this->curl->setUrl("https://services.mysublime.net/st4ts/data/get/type/iq/server/" . $serverName . "/")
            ->execute();


            $response = $this->curl->getResponse();

            $serverStatsData = json_decode($response, true);

            if (null == $serverStatsData) {
                throw new \Exception('Bad Response.');
            }

            // return line chart array
            return $this->getLineChartData($serverStatsData);

        } catch (\Exception $ex) {
            echo 'Error: ' . $ex->getMessage();
        }

    }

    /**
     * Get transformed returned data to line chart data
     *
     * @param array $serverStats
     * @return array
     */
    public function getLineChartData(array $serverStats)
    {

        // go thru the array and create new array used in line chart data
        $data = array_map(function ($n) {
            return [
                $n['data_label'],
                intval($n['data_value'])
            ];

        }, $serverStats);

        return $data;
    }

}