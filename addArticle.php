<?php
/**
 * addArticle.php
 *
 * Add a new article
 */
include './includes/header.php';
$accessLevel = User::accessLevel();
//var_dump($accessLevel);
if ($accessLevel != 'member' && $accessLevel != 'admin') {
    echo 'Sorry, no access allowed to this page';
} else {
    if (isset($_POST['save']) && $_POST['save'] == 'Save') {

//        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
//        $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING));
        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);
        $cat_id = $_POST['cat_id'];
        $item = array('title' => $title,
            'text' => $text,
            'cat_id' => $cat_id);

        if (empty($title) || empty($text)) {
            echo 'Please fill out the form';
        } else {
            $article = new Article($item);
            //debug($article);
            $result = $article->addArticle();
            echo $result;
        }
    }
}

// Is this an existing item or a new one?
?>
<h1>Add an article</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="maint" id="maint">

    <fieldset class="maintform">
        <legend><?php 'Add an Article' ?></legend>
        <ul>
            <li><label for="title" class="required">Title</label><br />
                <input type="text" name="title" id="title" class="required" 
                       value="" /></li>
            <li><?php echo Category::getCat_DropDown(); ?> </li>
            <li><label for="text" class="required">Text</label><br />
                <textarea rows="30" cols="80" name="text" 
                          id="text" class="required">
                </textarea></li>
        </ul>

        <input type="submit" name="save" value="Save" />
        <a class="cancel" href="index.php?content=articles">Cancel</a>
    </fieldset>
</form>
<?php
include './includes/footer.php';
