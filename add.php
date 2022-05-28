<?php

	include_once('model/articles.php');
	include_once('model/visits.php');

	logVisit();
	$err = '';

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		
		if($title === '' || $content === ''){
			$err = 'Заполните все поля!';
		}
		else{
			addArticle($title, $content);
			header('Location: index.php?added');
			exit();
		}
	}
	else{
		$title = '';
		$content = '';
	}

?>
<div class="form">
	<form method="post">
		Title:<br>
		<input type="text" name="title" value="<?=$title?>"><br>
		Content:<br>
		<textarea name="content"><?=$content?></textarea><br>
		<button>Send</button>
		<p><?=$err?></p>
	</form>
</div>
<hr>
<a href="index.php">Move to main page</a>