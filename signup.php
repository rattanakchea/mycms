<?php
/**
 * signup.php
 */
/**
 * Signup button is clicked
 */

include './includes/header.php';

$errors = array(); // Initialize an error array.
if (isset($_POST['signup'])) {

    $trimmed = array_map('trim', $_POST);
  
    // Check for username 4-20 characters
    if (preg_match('/^\w{4,20}$/', $trimmed['username'])) {
        $pass = $trimmed['username'];
    } else {
        $errors[] = 'Valid passwords consists of 4-20 characters!';
    }
    // Check for an email address:
    if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $trimmed['email'];
    } else {
        $errors[] = 'Please enter a valid email address!';
    }

    // Check for a password and match against the confirmed password:
    if (preg_match('/^\w{4,20}$/', $trimmed['password'])) {
        $pass = $trimmed['password'];
    } else {
        $errors[] = 'Valid passwords consists of 4-20 characters!';
    }
    
    $num1 = filter_var($trimmed['num1'], FILTER_VALIDATE_INT);
    $num2 = filter_var($trimmed['num2'], FILTER_VALIDATE_INT);
    $total = filter_var($trimmed['total'], FILTER_VALIDATE_INT);
    
    if (!$total){
       $errors[] = 'Total number entered was invalid';
    } else if($total  !== $num1+$num2) {
        $errors[] = 'Wrong number calculation';
    }
    
    if (empty($errors)){  //success
        $user = new User($trimmed);
        $result = $user->signUp();
        echo '<p>' . $result . '</p>';
        
    } else {
        echo '<h1>Error!</h1>';	
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';
    }
}
?>
<h1>Sign up</h1>

<form action="signup.php" method="post" name="maint" id="maint">

    <fieldset class="maintform">
        <legend>Sign up</legend>
        <ul>
            <li><label for="user_name" class="required">Username</label><br />
                <input type="text" name="username" id="username" class="required" /></li>
            <li><label for="email" class="required">Email</label><br />
                <input type="email" name="email" id="email" class="required" /></li>
            <li><label for="password" class="required">Password</label><br />
                <input type="password" name="password" id="password" class="required" /></li>
            <li><label for="capcha" class="required">Capcha</label><br />
                
                <?php
                    $num1 = rand(0, 10);
                    $num2 = rand(0, 10);
                    echo $num1 . ' + ' . $num2 . ' = '
                ?>
                <input type="hidden" name="num1" value="<?php echo $num1; ?>" />
                <input type="hidden" name="num2" value="<?php echo $num2; ?>" />
                <input type="text" name="total" id="total" /></li>
        </ul>
        <input type="submit" name="signup" value="Sign Up" />
        <a class="cancel" href="index.php">Cancel, return to Home Page</a>
    </fieldset>
</form>
<?php include './includes/footer.php'; ?>
