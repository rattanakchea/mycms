<?php
/**
 * single.php
 *
 * display a single article
 *
 */
include './includes/header.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
// Get the existing information for an existing item
    $item = Article::displayArticle($id);
} else {
    header('location:index.php');
}

$user = $item->getAuthor();
$username = $user->getUsername();
?>

<h1 style="color:green; margin-top: 20px; border-top: 1px solid #f1ebe0">
    <?php echo htmlspecialchars($item->getTitle()); ?>
    <?php if ($accessLevel == 'admin') { ?>
        <a class="button" href="article_edit.php?id=<?php echo $item->getArticleId(); ?>">Edit Article</a>
    <?php } ?></h1>
<p style="color: #999;">by <?php echo $username; ?>
    on <?php echo htmlspecialchars($item->getDate_modified()); ?>
</p>
<p>
    <?php echo html_entity_decode($item->getText()); ?>
</p>
<?php
include './includes/footer.php';
?>