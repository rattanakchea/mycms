<?php
/**
 * categories_manage.php
 */
// Get the category information
include './includes/header.php';

$accessLevel = User::accessLevel();
?>
<h1>Categories
    
  <?php
  $message ='';
  if ($accessLevel == 'admin') {
  
      if (isset($_GET['del']) && is_numeric($_GET['del'])) {
          $id = $_GET['del'];
          $result = Category::deleteRecord($id);
            //success
          $message = $result[1];
      }
      $items = Category::getCategories();
        if (empty($items)) {
          $items = array();
        }
  
?>
    <a class="button" href="category_add.php">Add New Category</a>
    
    
    
  <?php } ?>
</h1>
<?php echo $message;?>
<ul class="ulfancy">

  <?php foreach ($items as $i=>$item) : ?>
  <li class="row<?php echo $i % 2; ?>">
    
      <?php // Set up the images
        $image = 'images/'. $item->getCat_image(); 
          if (!is_file($image)) {
            $image = 'images/nophoto.jpg';
          }
        
        $image_t = 'images/thumbnails/'. $item->getCat_image(); 
          if (!is_file($image_t)) { 
            $image_t = 'images/thumbnails/nophoto.jpg';
          }
      ?>
    <div class="list-photo">
      <a href="<?php echo $image; ?>">
          <img alt="" src="<?php echo $image_t; ?>" width="130px" height="130px"/></a>
    </div>
    <div class="list-description">
      <h2><a href="category.php?cat_id=<?php echo (int) $item->getCat_id(); ?>">
      <?php echo htmlspecialchars($item->getCat_name()); ?></a></h2>  
      <p><?php echo htmlspecialchars($item->getCat_description()); ?></p>
      
      <?php if ($accessLevel == 'admin') : ?>
        <a class="button edit" 
          href="categories.php?del=<?php echo 
          $item->getCat_id(); ?>">Delete</a>      
        <a class="button edit" 
          href="category_edit.php?cat_id=<?php 
          echo $item->getCat_id(); ?>">Edit</a>
      <?php endif; ?>
    </div>
    <div class="clearfloat"></div>
  </li>
  <?php endforeach; ?>
</ul>
<?php include './includes/footer.php'; ?>