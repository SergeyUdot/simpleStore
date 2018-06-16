<?php include ROOT.'/views/layouts/header.php'; ?>

<?php include ROOT.'/views/layouts/nav.php'; ?>

<div class="side-menu">
	<ul>
	<?php foreach ($categories as $categoryItem) { ?>
		<li><a href="/catalog/<?php echo $categoryItem['slug']; ?>"><?php echo $categoryItem['name']; ?></a></li>
	<?php } ?>
	</ul>
</div>
<section class="main-cont mc-wl">
  
  <?php foreach($latestProducts as $product) { ?>
  <div class="product-short">
    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" />
	<h2><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>" title="<?php echo $product['name']; ?>"><?php echo $product['name']; ?></a></h2>
	<div class="prod-price">$<?php echo $product['price']; ?></div>
	<a href="#" class="tocart-button">To Cart</a>
	<?php if($product['is_new']) { ?>
		<span class="prod-new">NEW!</span>
	<?php } ?>
	<?php if($product['is_promo']) { ?>
		<span class="prod-promo">Special offer!</span>
	<?php } ?>
  </div>
  <?php } ?>

</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>