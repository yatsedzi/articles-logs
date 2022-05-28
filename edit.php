<?php

	include_once('model/articles.php');
	include_once('model/visits.php');

	logVisit();
	$id = $_GET['id'] ?? '';
	$isNormId = preg_match('/^[1-9][0-9]*$/', $id);
		
	$articles = getArticles();
	$post = $articles[$id] ?? null;
	$err = '';

	/* echo '<pre>';
	print_r($articles);
	echo '</pre>'; */

	if(!$isNormId || $post === null){
		exit('Error: art not found');
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		
		if($title === '' || $content === ''){
			$err = 'Заполните все поля!';
		}
		/* else if($post['title'] === $title && $post['content'] === $content){
			$err = 'Поменяйте хоть что-нибудь!';
		} */
		else{
			editArticle($id, $title, $content);
			header('Location: index.php?added');
			exit();
		}
	}
	else{
		$title = $post['title'];
		$content = $post['content'];
	}

?>
<div class="form">
	<form method="post">
		Name:<br>
		<input type="text" name="title" value="<?=$title?>"><br>
		Phone:<br>
		<textarea name="content"><?=$content?></textarea><br>
		<button>Send</button>
		<p><?=$err?></p>
	</form>
</div>
<hr>
<a href="index.php">Move to main page</a>