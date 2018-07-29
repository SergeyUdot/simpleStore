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
    <img src="<?php echo !empty($product['image']) ? $product['image'] : Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>" />
	<h2><a href="/catalog/<?php echo $product['category_slug']; ?>/<?php echo $product['slug'].'-'.$product['id']; ?>" title="<?php echo $product['name']; ?>"><?php echo $product['name']; ?></a></h2>
	<div class="prod-price">$<?php echo $product['price']; ?></div>
	<a href="/cart/add/<?php echo $product['id']; ?>" class="tocart-button" data-id="<?php echo $product['id']; ?>">To Cart</a>
	<?php if($product['is_new']) { ?>
		<span class="prod-new">NEW!</span>
	<?php } ?>
	<?php if($product['is_promo']) { ?>
		<span class="prod-promo">Special offer!</span>
	<?php } ?>
  </div>
  <?php } ?>
  
  <div class="c_b"></div>
  <?php if(!empty($sliderProducts)) { ?>
  <br/>
  <div class="recommended">
	<h3>Recommended products</h3>
	<?php 
		foreach ($sliderProducts as $sliderItem) { ?>
			<div class="product-short">
				<img src="<?php echo !empty($sliderItem['image']) ? $sliderItem['image'] : Product::getImage($sliderItem['id']);; ?>" alt="<?php echo $sliderItem['name']; ?>" />
				<h2><a href="/catalog/<?php echo $sliderItem['category_slug']; ?>/<?php echo $sliderItem['slug'].'-'.$sliderItem['id']; ?>" title="<?php echo $sliderItem['name']; ?>"><?php echo $sliderItem['name']; ?></a></h2>
				<div class="prod-price">$<?php echo $sliderItem['price']; ?></div>
				<a href="/cart/add/<?php echo $sliderItem['id']; ?>" class="tocart-button" data-id="<?php echo $sliderItem['id']; ?>">To Cart</a>
				<?php if($sliderItem['is_new']) { ?>
					<span class="prod-new">NEW!</span>
				<?php } ?>
				<?php if($sliderItem['is_promo']) { ?>
					<span class="prod-promo">Special offer!</span>
				<?php } ?>
			</div>
	<?php } ?>
  </div>
  <?php } ?>
</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>