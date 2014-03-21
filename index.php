<?php include './includes/header.php'; ?>

<h1>Most Recent Articles</h1>
<?php
$total = Article::numOfArticles();
$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;

$max = 2;
$startRow = $curPage * $max;

$items = Article::getSomeArticles($startRow, $max);
?>
<p>Displaying <?php
echo $startRow + 1;
if ($startRow + 1 < $total) {
    echo ' to ';
    if ($startRow + $max < $total) {
        echo $startRow + $max;
    } else {
        echo $total;
    }
}
echo " of $total articles<br/>";

// create a back link if current page greater than 0
if ($curPage > 0) {
    echo '<a href="' . $_SERVER['PHP_SELF'] . '?curPage=' . ($curPage - 1) . '"> &lt; Prev</a>';
} else {
    // otherwise leave the cell empty
    echo '&nbsp;';
}
    
    // create a forward link if more records exist
    if ($startRow + $max < $total) {
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?curPage=' . ($curPage + 1) . '"> Next &gt;</a>';
    } else {
        // otherwise leave the cell empty
        echo '&nbsp;';
    }

    if (empty($items)) {
        $items = array();
    } else {
        echo '<pre>';
        //print_r($items);
        echo '</pre>';
    }
    ?>

    <?php
    foreach ($items as $i => $item) {
        $user = $item->getAuthor();
        $username = $user->getUsername();
        ?>

    <a href="single.php?id=<?php echo $item->getArticleId(); ?>"><h1 style="color:green; margin-top: 20px; border-top: 1px solid #f1ebe0"><?php echo htmlspecialchars($item->getTitle()); ?></h1></a>
    <p style="color: #999;">by <?php echo $username; ?>
        on <?php echo htmlspecialchars($item->getDate_modified()); ?>
    </p>
    <p>
    <?php echo html_entity_decode(substr($item->getText(),0, 100)) . '...'; ?>
        <br>
        <a href="single.php?id=<?php echo $item->getArticleId(); ?>">Read more..</a>
    </p>
<?php } ?>

<?php include './includes/footer.php';

