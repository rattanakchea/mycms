<?php
/**
 * about.php
 *
 * Content for About us page
 *
 */
include './includes/header.php';
// Get the contact information
$items = User::getContacts();
echo '<pre>';
//print_r($items);
echo '</pre>';
$accessLevel = User::accessLevel();
?>

<h2>MyCMS members</h2>

<ul class="ulfancy">
    <?php if ($accessLevel == 'admin') {
        foreach ($items as $i => $item) {
        ?>
        <li class="row<?php echo $i % 2; ?>">
            <p>Username: <?php echo htmlspecialchars($item->username); ?><br />
                Email: <?php echo htmlspecialchars($item->email); ?><br />
                Type: <?php echo htmlspecialchars($item->access); ?><br />
<!--            <div>
            <a class="button" 
               href="index.php?content=contactdelete&id=<?php //echo $item->getId(); ?>">Delete</a>
            <a class="button" 
               href="index.php?content=contactmaint&id=<?php //echo $item->getId(); ?>">Edit</a>
            </div>-->
            </p>
            </li>
            
            
            

    <?php }
        } else { ?>
            <p>You need to login as an admin to view this page.</p>

<?php } ?>
            </ul>
<?php include './includes/footer.php';