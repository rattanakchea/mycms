<?php

/**
 * article.php
 *
 * Article class file
 */
class Article {

    /**
     * title
     * @var string
     */
    protected $article_id;
    protected $cat_id;
    protected $title;

    /**
     * Text
     * @var String
     */
    protected $text;

    /**
     * Contact who created the article
     * @var int
     * @return user_id
     */
    protected $user_id;

    /**
     * Date & time created
     * @var datetime
     */
    protected $date_created;
    protected $date_modified;

    /**
     * Author Information
     * @var Contact
     * @return Contact 
     */
    protected $author;

    /**
     * Initialize the Article with data from database
     * @param array
     */
    public function __construct($input = false) {
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                // Note the $key instead of key. 
                // This will give the value in $key instead of 'key' itself
                $this->$key = $val;
            }
        }
        $this->author = User::getContact($this->user_id);
    }

    /**
     * Return Article ID
     * @return string
     */
    public function getArticleId() {
        return $this->article_id;
    }

    /**
     * Return Title
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }
    
    public function getCat_id() {
        return $this->cat_id;
    }
    
    public function get_cat_name($cat_id){
        
    }

    /**
     * Return Text
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Return Created by
     * @return int
     */
    public function getCreated_by() {
        return $this->created_by;
    }

    /**
     * Return Created date/time
     * @return datetime
     */
    public function getDate_created() {
        return $this->date_created;
    }

    /**
     * Return Created date/time
     * @return datetime
     */
    public function getDate_modified() {
        return $this->date_modified;
    }

    /**
     * Return Modified date/time
     * @return datetime
     */
    public function getModified_by() {
        return $this->modified_by;
    }

    /**
     * Verify the Input
     * @return boolean
     */
    protected function _verifyInput() {
        $error = false;
        if (!trim($this->title)) {
            $error = true;
        }
        if (!trim($this->text)) {
            $error = true;
        }

        if ($error) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Add a Row to the table
     * @return array (redirect content,message,id)
     */
    public function addArticle() {

        // Verify the fields
        if ($this->_verifyInput()) {
            // prepare the encrypted password
            // Get the Database connection
            $connection = Database::getConnection();

            // Prepare the data 
            $query = "INSERT INTO articles(title, cat_id, text, user_id, 
        date_created, date_modified) 
      VALUES ('" . Database::prep($this->title) . "',
           '" . Database::prep($this->cat_id) . "',
       '" . Database::prep($this->text) . "',
       '" . (int) $_SESSION['user_id'] . "',
       CURRENT_TIMESTAMP,
       CURRENT_TIMESTAMP)";
            //echo $query;
            // Run the MySQL statement 
            if ($connection->query($query)) {
                $return = 'Article successfully added';

                // add success message
                return $return;
            } else {
                // send fail message and return to Usermaint
                $return = 'No Article Added. Unable to create record.';
                return $return;
            }
        } else {
            // send fail message and return to Usermaint
            $return = 'No Article Added. Missing required information.';
            return $return;
        }
    }

    /**
     * Update a Row in the table
     * @return array (redirect content,message,id)
     */
    public function editRecord() {
        // Verify the fields
        if ($this->_verifyInput()) {

            // Get the Database connection
            $connection = Database::getConnection();

            // Prepare the data 
            $query = "UPDATE `articles` 
      SET `title` = '" . Database::prep($this->title) . "',
          `text` = '" . Database::prep($this->text) . "',
          `user_id` = '" . (int) $_SESSION['user_id'] . "',
          `date_modified` = CURRENT_TIMESTAMP
          WHERE article_id='" . (int) $this->article_id . "'";
            //echo $query;
            // Run the MySQL statement 
            if ($connection->query($query)) {
                $return = 'Article successfully updated.';

                // add success message
                return $return;
            } else {
                // send fail message 
                $return = 'Article not updated. Unable to update record.';
                return $return;
            }
        } else {
            // send fail message and return to maint
            $return = array('articlemaint', 'Article not updated. Missing required information.', '0');
            return $return;
        }
    }

    /**
     * Delete a Row from the table
     * @param  int 
     * @return array (redirect content,message,id)
     */
    public static function deleteArticle($id) {
        // Get the Database connection
        $connection = Database::getConnection();
        // Set up query
        $query = 'DELETE FROM `articles` WHERE article_id="' . (int) $id . '"';
        //return $query;
        // Run the query
        if ($result = $connection->query($query)) {
            $return = 'Article successfully deleted.';
            return $return;
        } else {
            $return = 'Unable to delete Article.';
            return $return;
        }
    }

    /**
     * Get an Article
     * @param  int 
     * @return Article object
     */
    public static function getArticle($id) {
        // Get the database connection
        $connection = Database::getConnection();
        // Set up the query
        $accessLevel = User::accessLevel();
        if ($accessLevel == 'member') {
            $userID = $_SESSION['user_id'];
            $query = "SELECT * FROM `articles` WHERE article_id= '$id' AND user_id='$userID'";
        } else if ($accessLevel == 'admin') {
            $query = "SELECT * FROM `articles` WHERE article_id= '$id'";
        }
        // Run the MySQL command   
        $result_obj = '';
        try {
            $result_obj = $connection->query($query);
            if ($result_obj->num_rows == 1) {
                $item = $result_obj->fetch_object('Article');
                if (!$item) {
                    throw new Exception($connection->error);
                } else {
                    // pass back the results
                    return($item);
                }
            } else { //wrong article id, redirect to article page
                header("location: articles.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display an Article
     * @param  int 
     * @return Article object
     */
    public static function displayArticle($id) {
        // Get the database connection
        $connection = Database::getConnection();
        $query = "SELECT * FROM `articles` WHERE article_id= '$id'";

        // Run the MySQL command   
        $result_obj = '';
        try {
            $result_obj = $connection->query($query);
            if ($result_obj->num_rows == 1) {
                $item = $result_obj->fetch_object('Article');
                if (!$item) {
                    throw new Exception($connection->error);
                } else {
                    // pass back the results
                    return($item);
                }
            } else { //wrong article id, redirect to article page
                header("location: index.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Get an array of Articles
     * @return array (Article)
     */
    public static function getArticles() {
        // clear the results
        $items = '';
        // Get the connection  
        $connection = Database::getConnection();
        $accessLevel = User::accessLevel();
        if ($accessLevel == 'member') {
            $userID = $_SESSION['user_id'];
            $query = "SELECT * FROM `articles` WHERE user_id='$userID' ORDER BY date_modified DESC";
        } else if ($accessLevel == 'admin') {
            $query = "SELECT * FROM `articles` ORDER BY date_modified DESC";
        }
        // Set up query
//        $query = 'SELECT * FROM `articles` ORDER BY date_modified';
        // Run the query
        $result_obj = '';
        $result_obj = $connection->query($query);
        // Loop through the results, 
        // passing them to a new version of this class, 
        // and making a regular array of the objects
        try {
            while ($result = $result_obj->fetch_object('Article')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get an array of Articles by its category id
     * @return array (Article)
     */
    public static function getArticlesByCat($cat_id) {
        // clear the results
        $items = '';
        // Get the connection  
        $connection = Database::getConnection();
        $query = "SELECT * FROM `articles` WHERE cat_id='$cat_id' ORDER BY date_modified DESC";

        $result_obj = '';
        $result_obj = $connection->query($query);
        // Loop through the results, 
        // passing them to a new version of this class, 
        // and making a regular array of the objects
        try {
            while ($result = $result_obj->fetch_object('Article')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get an array of some Articles for pagination
     * @para $startRow
     * @para $num number of articles
     * @return array (Article)
     */
    public static function getSomeArticles($startRow, $num) {
        $items = '';
        $connection = Database::getConnection();

        $query = "SELECT * FROM articles ORDER BY date_modified DESC LIMIT $startRow, $num";
        $result_obj = '';
        $result_obj = $connection->query($query) or die('Check syntax');

        try {
            while ($result = $result_obj->fetch_object('Article')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }
    
     /**
     * Get an array of some Articles for pagination
     * @para $startRow
     * @para $num number of articles
     * @return array (Article)
     */
    public static function searchArticles($term) {
        $items = '';
        $connection = Database::getConnection();

        $query = "SELECT * FROM articles WHERE text LIKE '%$term%' OR title LIKE '%$term%' ORDER BY date_modified DESC";
        $result_obj = '';
        $result_obj = $connection->query($query) or die('Check syntax');

        try {
            while ($result = $result_obj->fetch_object('Article')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }
    
    

    /**
     * Get an array of soome Articles for pagination
     * @return array (Article)
     */
    public static function numOfArticles() {
        $connection = Database::getConnection();
        $query = "SELECT count(*) FROM articles";
        $result_obj = $connection->query($query) or die('Check total articles SQL syntax');
        $result = $result_obj->fetch_array();
        return $result[0];
    }

    /**
     * Get an array of Articles
     * @return array (Article)
     */
    public static function getArticlesByUser() {
        // clear the results
        $userID = $_SESSION['user_id'];
        $items = '';
        // Get the connection  
        $connection = Database::getConnection();
        // Set up query
        $query = "SELECT * FROM `articles` WHERE user_id = '$userID' ORDER BY date_modified";
        // Run the query
        $result_obj = '';
        $result_obj = $connection->query($query);
        // Loop through the results, 
        // passing them to a new version of this class, 
        // and making a regular array of the objects
        try {
            while ($result = $result_obj->fetch_object('Article')) {
                $items[] = $result;
            }
            // pass back the results
            return($items);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Magic function to debug Contact Object
     */
    public function __toString() {
        $s = 'title: ' . $this->title . '<br/>';
        $s .= 'text: ' . $this->text;
        return $s;
    }

}
