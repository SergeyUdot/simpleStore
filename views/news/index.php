<!DOCTYPE html><html><head>	<meta charset="utf-8" />	<title>News</title>		<link rel="stylesheet" href="/template/css/style.css" /></head><body>	<div class="wrap1200">		<header class="main-header">			Test site		</header>		<section class="main-cont">		<?php foreach($newsList as $newsItem) { ?>			<div class="news-item">				<h2><a href="/news/general/<?php echo $newsItem['id']; ?>"><?php echo $newsItem['title']; ?></a></h2>				<time><?php echo $newsItem['date']; ?></time>				<?php echo $newsItem['short_content']; ?>				<p class="read-more"><a href="/news/general/<?php echo $newsItem['id']; ?>">Read more &raquo;</a></p>			</div>		<?php } ?>		</section>		<footer class="main-footer">			&copy; 2016		</footer>	</div></body></html>