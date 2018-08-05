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

  <pre><?php print_r($product); ?></pre>
  
  <img src="<?php echo !empty($product['image']) ? $product['image'] : Product::getImage($product['id']); ?>" alt="<?php echo $product['name']; ?>" />
  <h2><?php echo $product['name']; ?></h2>
  <div class="prod-brand"><?php echo $product['brand']; ?></div>
  <div class="prod-price">$ <?php echo $product['price']; ?></div>
  <div class="prod-description"><?php echo $product['description']; ?></div>
  
  <div class="c_b"></div>
</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>