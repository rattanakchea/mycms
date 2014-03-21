<?php
/**
 * index.php
 *
 * Main file
 *
 * @version    1.2 2014-02-03
 * @package    My CMS
 * @license    GNU General Public License
 * @since      Since Release 1.0
 */
require_once 'includes/init.php';
$logged_in = User::isLoggedIn();
$accessLevel = User::accessLevel();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>My CMS</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea"
            });
        </script>

    </head>

    <body>
        <div id="container">

            <div id="header">
                <a href="index.php"><h1>MyCMS</h1></a> 
            </div><!-- end header -->

            <div id="navigation">
                <h3 class="element-invisible">Menu</h3>
                <ul class="mainnav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="about.php">About Us</a></li>                               
                    <li><a href="single.php?id=1">Terms of Use</a></li>
                </ul>
                <form class="search" method="post" action="search.php">
                    <input type="text" name="search" placeholder="search" />
                    <input type="submit" name="submit" value="Search" />
                </form>
                <div class="clearfloat"></div>
            </div><!-- end navigation -->

            <div class="message">
                
                <?php if (isset( $_SESSION['username'])) {
                    echo 'Welcome, ' .  $_SESSION['username'];
                }
                ?>
                <?php if ($logged_in) : ?>
                        <a href="logout.php">Logout</a> |
                        <?php if ($logged_in) : ?>
                            <a href="articles.php">Manage Articles</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a href="login.php">Login</a> |
                        <a href="signup.php">Sign Up</a>
                    <?php endif; ?>
            </div><!-- end message -->  
            <div class="sidebar">
                <?php include './includes/sidebar.php'; ?>
            </div><!-- end sidebar -->
            <div class="content">