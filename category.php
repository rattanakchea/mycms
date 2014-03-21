<?php
/**
 * category.php
 */
// Get the Category
include './includes/header.php';
$cat_id_in = (int) $_GET['cat_id'];
$category = Category::getCategory($cat_id_in);
// Get the article information
$items = Article::getArticlesByCat($cat_id_in);
?>
<h1>Category: <?php echo $category->getCat_name(); ?></h1>

<?php
if (empty($items)) {
    $items = array();
    echo '<p>No article under this category yet</p>';
} else {
    foreach ($items as $i => $item) {
        $user = $item->getAuthor();
        $username = $user->getUsername();
        ?>

        <a href="single.php?id=<?php echo $item->getArticleId(); ?>"><h1 style="color:green; margin-top: 20px; border-top: 1px solid #f1ebe0">
                <?php echo htmlspecialchars($item->getTitle()); ?></h1></a>
        <p style="color: #999;">by <?php echo $username; ?>
            on <?php echo htmlspecialchars($item->getDate_modified()); ?>
        </p>
        <p>
            <?php echo html_entity_decode(substr($item->getText(), 0, 100)) . '...'; ?>
            <br>
            <a href="single.php?id=<?php echo $item->getArticleId(); ?>">Read more..</a>
        </p>
    <?php }
} ?>

<?php
include './includes/footer.php';
