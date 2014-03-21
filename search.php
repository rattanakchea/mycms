<?php include './includes/header.php'; ?>

<h1>Search Result</h1>
<?php
if (isset($_POST['search'])) {
    $term = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $items = Article::searchArticles($term);
    if (empty($items)) {
        echo '<p>No results found</p>';
    } else {

        foreach ($items as $i => $item) {
            $user = $item->getAuthor();
            $username = $user->getUsername();
            ?>

            <a href="single.php?id=<?php echo $item->getArticleId(); ?>"><h1 style="color:green; margin-top: 20px; border-top: 1px solid #f1ebe0"><?php echo htmlspecialchars($item->getTitle()); ?></h1></a>
            <p style="color: #999;">by <?php echo $username; ?>
                on <?php echo htmlspecialchars($item->getDate_modified()); ?>
            </p>
            <p>
                <?php echo html_entity_decode(substr($item->getText(), 0, 100)) . '...'; ?>
                <br>
                <a href="single.php?id=<?php echo $item->getArticleId(); ?>">Read more..</a>
            </p>
        <?php
        }
    }
} else {
    header('location:index.php');
    exit;
}
?>

<?php
include './includes/footer.php';

