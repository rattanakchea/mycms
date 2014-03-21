<?php

require_once './mysqli.php';
require_once './class/My_DateTime.php';
$mysqli = dbConnect();
//$mysqli->close();
echo $mysqli->errno;

$class = 'mysqli';
echo "<p>inspect a class $class</p>";

$date = new My_DateTime();
$date->setDate(2014, 3, 6);
echo "<p>echo date used toString</p>";
echo $date;
echo "<p>magic _get_w</p>";
echo $date->w;
echo "<p>magic _get_</p>";
echo $date->getTimestamp();