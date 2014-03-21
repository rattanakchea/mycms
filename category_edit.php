<?php
/**
 * category_edit.php
 *
 * edit article category
 */
include './includes/header.php';
$accessLevel = User::accessLevel();
//var_dump($accessLevel);
if ($accessLevel != 'admin') {
    echo 'Sorry, no access allowed to this page';
} else {
    if (isset($_POST['save']) && $_POST['save'] == 'Save') {
        //process image upload
         $filename = $_FILES["image"]["name"];
        try {
            $upload = new Upload(UPLOAD_FOLDER);
            echo UPLOAD_FOLDER;  
            $upload->move();
            $result = $upload->getMessages();
     
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);
        $item = array('cat_name' => $title,
            'cat_description' => $text,
            'cat_image' => $filename );

        if (empty($title) || empty($text)) {
            echo 'Please fill out the form';
        } else {
            $article = new Category($item);
            $result = $article->addRecord();
            echo $result;
        }
    }
}

// Is this an existing item or a new one?
?>
<h1>Edit category</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" id="uploadImage"s>

    <fieldset class="maintform">
        <legend><?php 'Edit Category' ?></legend>
        <ul>
            <li><label for="title" class="required">Title</label><br />
                <input type="text" name="title" id="title" class="required" 
                       value="<?php echo html_entity_decode($item->getCat_name()); ?>" /></li>
            <li><label for="text" class="required">Description</label><br />
                <input type="text" name="text" id="text" size="80" class="required"
                       value="<?php echo html_entity_decode($item->getCat_description()); ?>" /></li>
            <li><label for="text">Image</label><br />
                <input type="file" name="image" id="image" /></li>
        </ul>

        <input type="submit" name="save" value="Save" />
        <a class="cancel" href="categories.php">Cancel</a>
    </fieldset>
</form>
<?php include './includes/footer.php'; ?>