<?php

function isLocal() {
    if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) {
        return TRUE;
    } else {
        return FALSE;
    }
}
// Determine location of files and the URL of the site:
// Allow for development on different servers.
if (isLocal()) {
	// Always debug when running locally:
	$debug = TRUE;
        
        define ('ROOT', 'C:\wamp\www\mycms\\');      
        define( 'BASE_PATH', dirname(__FILE__));
        //C:\wamp\www\mycms
        //relative path from root directory
	define ('BASE_URI', '/mycms/');
        //absolute path
	define ('BASE_URL', 'http://localhost/mycms/');
        define ('UPLOAD_FOLDER', ROOT . 'images\thumbnails\\');
	
} else {
    //server: /home1/rattana1/public_html/mycms/includes/classes/	 define( 'BASE_PATH', dirname(__FILE__));
	define ('BASE_URI', '\home1\rattana1\public_html\mycms\\');
	define ('BASE_URL', 'http://www.rattanak.com/uwb/');
        define ('UPLOAD_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/mycms/images/thumbnails/');
	
}
if (!defined('LIVE')) DEFINE('LIVE', true);
DEFINE('CONTACT_EMAIL', 'rattanak.chea@gmail.com');
// Function for handling errors.
// Takes five arguments: error number, error message (string), name of the file where the error occurred (string) 
// line number where the error occurred, and the variables that existed at the time (array).
// Returns true.
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
	
	// Add the backtrace:
	$message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
	
	// Or just append $e_vars to the message:
	//	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n";

	if (!LIVE) { // Show the error in the browser.
	
		echo '<div class="alert alert-danger">' . nl2br($message) . '</div>';

	} else { // Development (print the error).

		// Send the error in an email:
		error_log ($message, 1, CONTACT_EMAIL, 'From:admin@example.com');
		
		// Only print an error message in the browser, if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="alert alert-danger">A system error occurred. We apologize for the inconvenience.</div>';
		}

	} // End of $live IF-ELSE.
	
	return true; // So that PHP doesn't try to handle the error, too.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');
error_reporting(E_ALL | E_STRICT);

/**
 * loadContent
 * Load the Content
 * @param $default
 */
function loadContent($where, $default = '') {
    // Get the content from the url 
    // Sanitize it for security reasons
    $content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
    $default = filter_var($default, FILTER_SANITIZE_STRING);
    // If there wasn't anything on the url, then use the default
    $content = (empty($content)) ? $default : $content;
    // If you found have content, then get it and pass it back
    if ($content) {
        // sanitize the data to prevent hacking.
        $html = include 'content/' . $content . '.php';
        return $html;
    }
}

/* * ****************************
 * User functions
 * *************************** */

//function userSignup() {
//    $results = '';
//    if (isset($_POST['signup'])) {
//        $item = array('username' => filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING),
//            'password' => filter_input(INPUT_POST, 'password'),
//            'email' => filter_input(INPUT_POST, 'email')
//        );
//
//        // signup
//        $results = User::signUp($item);
//    }
//    return $results;
//}
//function userLogin() {
//    $results = '';
//    if (isset($_POST['login']) AND $_POST['login'] == 'Login') {
//        // check the token
//        $badToken = true;
//        if (!isset($_POST['token']) || !isset($_SESSION['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
//            $results = array('', 'Sorry, go back and try again. There was a security issue.');
//            $badToken = true;
//        } else {
//            $badToken = false;
//            unset($_SESSION['token']);
//
//            $item = array('user_name' => filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING),
//                'password' => filter_input(INPUT_POST, 'password')
//            );
//
//            // login
//            $results = User::logIn($item);
//        }
//    }
//    return $results;
//}

function userLogout() {
    $results = '';
    if (isset($_POST['logout']) AND $_POST['logout'] == 'Logout') {
        // check the token
        $badToken = true;
        if (!isset($_POST['token']) || !isset($_SESSION['token']) || empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            $results = array('', 'Sorry, go back and try again. There was a security issue.', '');
            $badToken = true;
        } else {
            // logout
            $badToken = false;
            unset($_SESSION['token']);

            User::logout();
            $results = array('', "You have successfully logged out", '');
            ;
        }
    }
    return $results;
}

//to debug array
function debug($input) {
    echo '<pre>';
    print_r($input);
    echo '</pre>';
}
