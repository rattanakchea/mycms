<?php

require './includes/classes/database.php';
require './includes/init.php';

$conn = Database::getConnection();
echo Database::getDBname();

