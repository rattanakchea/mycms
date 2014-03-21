<?php $items = Category::getCategories(); ?>
<h3 class="element-invisible">Lot Categories</h3>
<ul class="catnav">
  <?php foreach ($items as $i=>$item) : ?>
	<li><a href="category.php?cat_id=<?php echo 
	  (int) $item->getCat_id(); ?>"><?php echo 
	  htmlspecialchars($item->getCat_name()); ?></a></li>	
  <?php endforeach; ?>
</ul>