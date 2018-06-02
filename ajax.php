<?php
/**
 * Created by PhpStorm.
 * User: ricky
 * Date: 31/5/18
 * Time: 2:28 PM
 */

require __DIR__ . '/vendor/autoload.php';


use Ricky\Controller\ServerController;
use Ricky\Helper\Curl;

$curl = new Curl();

$controller = new ServerController($curl);



// check if is ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
    && isset($_GET['server_name'])
    && $_GET['server_name']) {

    $serverName = $_GET['server_name'];


    // get server statistics by server name & get transformed line chart data
    $lineChartData = $controller->getServerStatsFromRemote($serverName);

    echo json_encode($lineChartData);
    die;
}