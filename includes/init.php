<?php

/**
 * init.php
 *
 * Initialization file
 *
 */
session_start(); // starts new or resumes existing session
// include required files
require_once 'includes/functions.php';

/**
 * Auto load the class files
 * @param string $class_name
 */

// server: /home1/rattana1/public_html/mycms/includes/classes/
function __autoload($class_name) {
    try {
        $class_file = './includes/classes/' . strtolower($class_name) . '.php';
        if (is_file($class_file)) {
            require_once $class_file;
        } else {
            throw new Exception("Unable to load class $class_name in file $class_file.");
        }
    } catch (Exception $e) {
        echo 'Exception caught: ', $e->getMessage(), "\n";
    }
}