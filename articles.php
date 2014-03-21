<?php
/**
 * articles.php
 */
include './includes/header.php';
$accessLevel = User::accessLevel();
//var_dump($accessLevel);
if ($accessLevel != 'member' && $accessLevel != 'admin') {
    echo 'You need to log in to view this page';
    include './includes/footer.php';
    exit;
} else {  //admin can edit all articles
// Get the article information
    $items = Article::getArticles();
    if (empty($items)) {
        $items = array();
    } else {
        echo '<pre>';
        //print_r($items);
        echo '</pre>';
    }
}
?>
<h1>Articles
    <a class="button" href="addArticle.php">Add New Article</a>
</h1>
<table class="table">
    <tr>
        <th>Date Last Modified</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($items as $i => $item) : ?>
        <tr>
            <?php
            $user = $item->getAuthor();
            $username = $user->getUsername();
            $cat_id = $item->getCat_id();
            $catgory = Category::getCategory($cat_id);
            $cat_name = $catgory->getCat_name();
            
            ?>
            <td><?php echo htmlspecialchars($item->getDate_modified()); ?></td>
            <td><?php echo htmlspecialchars($item->getTitle()); ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $cat_name; ?></td>
            <td><a class="button" 
                   href="article_delete.php?id=<?php echo $item->getArticleId(); ?>">Delete</a></td>
            <td><a class="button" 
                   href="article_edit.php?id=<?php echo $item->getArticleId(); ?>">Edit</a></td>
        </tr>
<?php endforeach; ?>
</table>
<?php
include './includes/footer.php';
