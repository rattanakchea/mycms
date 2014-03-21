<?php

/**
 * user.php
 *
 * User class file
 *
 */
class User {

    protected $user_id;
    protected $username;
    protected $password;
    protected $email;
    protected $access;

    /**
     * Initialize the User with username, password, email,
     * email, and phone
     * @param array
     */
    public function __construct($input = false) {
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $this->$key = $val;
            }
        }
    }

    protected function _verifyInput() {
        $error = false;
        if (!trim($this->first_name)) {
            $error = true;
        }
        if (!trim($this->last_name)) {
            $error = true;
        }
        if (!trim($this->username)) {
            $error = true;
        } elseif (strlen(trim($this->username)) < 6) {
            $error = true;
        } elseif (self::getContactIdByUser(trim($this->username))) {
            //user id already exists
            $error = true;
        }

        $password1 = trim($_POST['password1']);
        if ($password1) {
            if ($password1 != trim($_POST['password2'])) {
                $error = true;
            } elseif (strlen($password1) < 6) {
                $error = true;
            }
        }

        if ($error) {
            return false;
        } else {
            return true;
        }
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function getId() {
        return $this->user_id;
    }

    public function __get($input) {
        switch (strtolower($input)) {
            case 'username':
                return $this->username;
            case 'email':
                return $this->email;
            case 'access':
                return $this->access;
        }
    }

    public static function getContactIdByUser($username) {
        // Get the database connection
        $connection = Database::getConnection();
        // set up the query
        $id = '';
        $query = 'SELECT user_id FROM `users` 
      WHERE username="' . Database::prep($username) . '" 
      LIMIT 1';
        // Run the MySQL command   
        $result_obj = '';
        // Run the MySQL command
        $result_obj = $connection->query($query);
        while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
            $id = $result['user_id'];
        }
        // if user name not found, return false
        if (!$id) { // if user name not found, return with error message
            return false;
        } else {
            return $id;
        }
    }

    public static function isLoggedIn() {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function accessLevel() {
        if (isset($_SESSION['access'])) {
            return $_SESSION['access'];
        } else {
            return false;
        }
    }

    public function signUp() {
        // Get the database connection
        $connection = Database::getConnection();

        // get the id for the user
        $username = $this->username;
        $id = self::getContactIdByUser($username);

        if ($id) { // if user name not found, return with error message
            return 'Sorry, username is already taken';
        }

        //$hash_password = $item['password'];
        //$hash_password = hash_hmac('sha512', $item['password'] . '!hi#HUde9' . (int) $id, SITE_KEY);
        // Set up the query


        $query = "INSERT INTO users (username, email, password) VALUES (
            '$this->username', '$this->email', '$this->password')";

        // Run the MySQL command   
        $result_obj = '';
        // Run the MySQL command
        //return true on successful insert
        $result_obj = $connection->query($query) or die('error query' . $query);

        if ($result_obj) {
            return 'Success, you may log in now';
        }
    }

    public static function logIn($username, $pass) {
        if (empty($username) || empty($pass)) {
            return 'Sorry, invalid User Name and/or Password.';
        }
        // Get the database connection
        $connection = Database::getConnection();

        // get the id for the user
        $id = self::getContactIdByUser($username);

        if (!$id) { // if user name not found, return with error message
            return false;
        }

        //$hash_password = $item['password'];
        //$hash_password = hash_hmac('sha512', $item['password'] . '!hi#HUde9' . (int) $id, SITE_KEY);
        // Set up the query
        $query = "SELECT * FROM users
      WHERE username='$username' AND password = '$pass' LIMIT 1";
        // Run the MySQL command   
        $result_obj = '';
        // Run the MySQL command
        $result_obj = $connection->query($query);
        try {
            while ($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
                // pass back the results
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['access'] = $result['access'];
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['access']);
        header("location:index.php");

//        $_SESSION = array(); // Destroy the variables.
//        if (session_destroy()) {
//            // Destroy the session itself.
//            setcookie(session_name(), '', time() - 3600); // Destroy the cookie.
//            header("location:index.php");
//            exit();
//        }
    }

    public static function getContact($id) {
        // Get the database connection
        $connection = Database::getConnection();
        // Set up the query
        $query = 'SELECT * FROM `users` WHERE user_id="' . (int) $id . '"';
        // Run the MySQL command   
        $result_obj = '';
        try {
            $result_obj = $connection->query($query);
            if (!$result_obj) {
                throw new Exception($connection->error);
            } else {
                $item = $result_obj->fetch_object('User');
                if (!$item) {
                    throw new Exception($connection->error);
                } else {
                    // pass back the results
                    return($item);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getContacts() {
        // clear the results
        $items = '';
        // Get the connection  
        $connection = Database::getConnection();
        // Set up query
        $query = 'SELECT `username`,`email`,`access` FROM `users` ORDER BY username';
        // Run the query
        $result_obj = '';
        $result_obj = $connection->query($query);
        // Loop through the results, 
        // passing them to a new version of this class, 
        // and making a regular array of the objects
        try {
            while ($result = $result_obj->fetch_object('User')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }

}
