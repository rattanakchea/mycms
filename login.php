<?php
/**
 * login.php page
 */
include './includes/header.php';

if (isset($_POST['login']) AND $_POST['login'] == 'Login') {
    // check the token
  

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'password');

        // login
        $results = User::logIn($username, $pass);
        if ($results){
            header('location:index.php');
        } else {
            echo 'Invalid username/password';
        }
        
    }
?>

<h1>Login</h1>

<form action="login.php" method="post" name="maint" id="maint">

    <fieldset class="maintform">
        <legend>Login</legend>
        <ul>
            <li><label for="username" class="required">User Name</label><br />
                <input type="text" name="username" id="user_name" class="required" /></li>
            <li><label for="password" class="required">Password</label><br />
                <input type="password" name="password" id="password" class="required" /></li>
        </ul>

        <input type="submit" name="login" value="Login" />
        <a class="cancel" href="index.php">Cancel, return to Home Page</a>
    </fieldset>
</form>
<?php include './includes/footer.php'; ?>