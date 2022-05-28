<?php

	include_once('model/articles.php');
	include_once('model/visits.php');
	
	logVisit();
	$articles = getArticles();
	$isAdded = isset($_GET['added']);

?>
<?php if($isAdded): ?>
	<div class="">Your article added</div>
<?php endif; ?>
<a href="add.php">Add article</a>
<hr>
<div class="articles">
    <?php foreach($articles as $id => $article): ?>
		<div class="article">
			<h2><?=$article['title']?></h2>
			<a href="article.php?id=<?=$id?>">Read more</a>
		</div>
    <?php endforeach; ?>
</div>
	