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

// get server list
$serverList = $controller->getServerListFromRemote();

// get the first server stats
if (is_array($serverList) && count($serverList) > 0) {
    // get transformed line chart data
    $defaultServerStatslineChartData = $controller->getServerStatsFromRemote($serverList[0]->getName());
}



?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" type="text/css" href="assets/css/jquery.jqplot.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <?php if (isset($defaultServerStatslineChartData)) { ?>

    <script>
        var defaultServerStatslineChartData = <?php echo json_encode($defaultServerStatslineChartData) ?>;
    </script>

    <?php } ?>
    <title>Server Statistics</title>
</head>
<body>
<main class="py-4">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <h1>Server Statistic</h1>

                <select class="form-control" id="server">
                    <?php
                    foreach($serverList as $server) {
                    ?>
                    <option value="<?php echo htmlspecialchars($server->getName()); ?>"><?php echo htmlspecialchars($server->getName()); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-lg-12" id="line-chart">

            </div>
        </div>


    </div>
</main>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/jqplot/jquery.jqplot.min.js"></script>
<script src="assets/js/jqplot/jqplot.json2.min.js"></script>

<script src="assets/js/jqplot/jqplot.enhancedLegendRenderer.min.js"></script>
<script src="assets/js/jqplot/jqplot.dateAxisRenderer.min.js"></script>
<script src="assets/js/jqplot/jqplot.logAxisRenderer.min.js"></script>
<script src="assets/js/jqplot/jqplot.canvasTextRenderer.min.js"></script>

<script src="assets/js/jqplot/jqplot.canvasAxisLabelRenderer.js"></script>
<script src="assets/js/jqplot/jqplot.highlighter.min.js"></script>


<script src="assets/js/app.js"></script>

</body>
</html>