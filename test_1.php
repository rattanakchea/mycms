<?php

require_once './mysqli.php';
require_once './class/My_DateTime.php';
$mysqli = dbConnect();
//$mysqli->close();

$class = 'mysqli';
echo "<p>Find Recurring Dates on Monday and Tue</p>";

$start = '2014-03-05';
$end = '2014-05-05';
$days = array('Monday');
echo '<pre>';
print_r($days);
echo '</pre>';
echo count($days);
echo '<hr/>';

$dates = find_recurring_dates($start, $days, $end);
sort($dates);

echo '<pre>';
print_r($dates);
echo '</pre>';

function find_recurring_dates($start, $days, $end) {
    $dateStrings = array(); //for inserting into MYSQL

    $interval = new DateInterval('P1W');  //one week interval

    $endDate = new DateTime($end);

    //check if multiple days

    for ($i = 0; $i < count($days); $i++) {
        $startDate[] = new DateTime($start);
        $startDate[$i]->modify($days[$i]);

        $period = new DatePeriod($startDate[$i], $interval, $endDate);


        foreach ($period as $date) {
            $dateStrings[] = $date->format('Y-m-d');
        }
    }
    return $dateStrings;
}
