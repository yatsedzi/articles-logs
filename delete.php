<?php

	include_once('model/articles.php');
	include_once('model/visits.php');		

	logVisit();
	$id = $_GET['id'] ?? '';
	$isNormId = preg_match('/^[1-9][0-9]*$/', $id);
	$res = $isNormId && removeArticle($id);
?>
<?=($res ? 'All done!' : 'Not found')?>
<hr>
<a href="index.php">Move to main page</a>

<?php
/* 1 && 2

if(!1)
	false
else
	2 
	
	if($isNormId){
		removeArticle($id);
		//...
	}
	
	*/
?>