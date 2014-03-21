<?php
/**
 * articledelete.php
 *
 * Delete the Articles 
 *
 */
include './includes/header.php';
$accessLevel = User::accessLevel();
if (isset($_POST['delete']) && $_POST['delete'] == 'Delete') {
    $id = $_POST['id'];
    // Get the existing information for an existing item
    $item = Article::getArticle($id);
    //delete article
    $result = $item->deleteArticle($id);
    echo $result;
}

if ($accessLevel != 'admin' && $accessLevel != 'member') {
    echo 'Sorry, no access allowed to this page';
    include './includes/footer.php';
    exit;
} else {
    if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
// Get the existing information for an existing item
    $item = Article::getArticle($id);
    }
}?>
    <h1>Article Delete</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <fieldset class="maintform">
            <legend><?php echo 'Id: ' . $id ?></legend>
            <ul>
                <li><strong>Title:</strong>
                    <?php echo htmlspecialchars($item->getTitle()); ?></li>
                <li><strong>Text:</strong> 
                    <?php echo strip_tags(nl2br($item->getText()), "<p><br><h2><h3><h4><strong><em><ul><ol><li><a>");
                    ?>
            </ul>

            <input type="hidden" name="id" id="id" value="<?php echo $item->getArticleId(); ?>" />
            <input type="submit" name="delete" value="Delete" />
            <a class="cancel" href="articles.php">Cancel</a>
        </fieldset>
    </form>
    <?php

include './includes/footer.php';