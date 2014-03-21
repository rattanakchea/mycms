<?php
/**
 * article_edit.php
 *
 * Edit existing article
 * Admin can edit all articles
 * Member can edit only theri own articles
 */
include './includes/header.php';
$accessLevel = User::accessLevel();
if ($accessLevel != 'member' && $accessLevel != 'admin') {
    echo 'Sorry, no access allowed to this page';
    include './includes/footer.php';
    exit();
}
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
// Get the existing information for an existing item
    $item = Article::getArticle($id);
    $cat_id = $item->getCat_id();
} else if (isset($_POST['update']) && $_POST['update'] == 'Update') {

        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);
        $item = array('title' => $title,
            'text' => $text,
            'article_id' => $_POST['id']);

        if (empty($title) || empty($text)) {
            echo 'Please fill out the form';
        } else {
            // Get the existing information for an existing item
            $item = new Article($item);
            //delete article
            $result = $item->editRecord();
            echo $result;
        }
        // Add article
//    $results = User::logIn($username, $pass);
//    echo $results;
    } else {
        //go to main articles
        header('location: articles.php');
        exit();
    }

// Is this an existing item or a new one?
?>
<h1>Edit an article
<a class='button' href="single.php?id=<?php echo $item->getArticleId(); ?>">View Article</a>
</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="maint" id="maint">

    <fieldset class="maintform">
        <legend><?php 'Add an Article' ?></legend>
        <ul>
            <li><label for="title" class="required">Title</label><br />
                <input type="text" name="title" id="title" class="required" 
                       value="<?php echo html_entity_decode($item->getTitle()); ?>" /></li>
             <li><?php echo Category::getCat_DropDown($cat_id); ?> </li>
            <li><label for="text" class="required">Text</label><br />
                <textarea rows="30" cols="80" name="text" 
                          id="text" class="required">
                              <?php echo html_entity_decode($item->getText()); ?>
                </textarea></li>
        </ul>

        <input type="hidden" name="id" id="id" value="<?php echo $item->getArticleId(); ?>" />
        <input type="submit" name="update" value="Update" />
        <a class="cancel" href="articles.php">Cancel</a>
    </fieldset>
</form>
<?php include './includes/footer.php'; ?>