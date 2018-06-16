<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<div class="side-menu">
	<ul>
	<?php foreach ($categories as $categoryItem) { ?>
		<li class="<?php if($category == $categoryItem['slug']) echo 'active'; ?>"><a href="/catalog/<?php echo $categoryItem['slug']; ?>"><?php echo $categoryItem['name']; ?></a></li>
	<?php } ?>
	</ul>
</div>
<section class="main-cont mc-wl">
  
  <?php foreach($categoryProducts as $product) { 
			if(isset($product['id'])) {
  ?> 
		<div class="product-short">
			<img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
			<h2><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>"><?php echo $product['name']; ?></a></h2>
			<div class="prod-price">$<?php echo $product['price']; ?></div>
			<a href="#">To Cart</a>
			<?php if($product['is_new']) { ?>
				<span class="prod-new">NEW!</span>
			<?php } ?>
			<?php if($product['is_promo']) { ?>
				<span class="prod-promo">Special offer!</span>
			<?php } ?>
		</div>
  <?php
		} else {
			echo '<div class="emty-category">Empty category</div>';
		}
  } ?>

</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>