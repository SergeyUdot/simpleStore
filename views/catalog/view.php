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

</section>
<div class="c_b"></div>

<?php include ROOT.'/views/layouts/footer.php'; ?>