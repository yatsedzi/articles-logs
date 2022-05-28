<?php

	include_once('model/visits.php');
	
	if(isset($_GET['dt'])){
		$showDay = true;
		$dt = $_GET['dt'];

		if(!checkDay($dt) || !file_exists("db/logs/$dt")){
			exit('Bad log day!');
		}
		
		$visits = file("db/logs/$dt");
	}
	else{
		$showDay = false;
		$days = getVisitsDays();
	}

?>
<style>
	table, td{
		border: 1px solid #000;
	}

	td{
		padding: 10px;
	}

	.danger{
		color: red;
	}
</style>
<?php if($error): ?>
	error || foreach errors
<?php elseif($showDay): ?>
	<h1>Log by <?=$dt?></h1>
	<table>
		<tr>
			<th>Time</th>
			<th>Ip</th>
			<th>URI</th>
			<th>Referer</th>
		</tr>
		<?php 
			foreach($visits as $row): 
			$visit = json_decode($row, true);
			$isDanger = isDangerUrl($visit['uri']);
		?>
		<tr <?php if($isDanger) echo 'class="danger"'?>>
			<td><?=$visit['dt']?></td>
			<td><?=$visit['ip']?></td>
			<td><?=$visit['uri']?></td>
			<td><?=$visit['referer']?></td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Logs days</h1>
	<ul>
		<?php foreach($days as $day): ?>
		<li><a href="logs.php?dt=<?=$day?>"><?=$day?></a></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>