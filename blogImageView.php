<?php
  require_once('blogParams.inc.php');
  require_once('DbH.inc.php');
  $dbh = new DbH($db);
	if(isset($_GET['pid']) && is_numeric($_GET['pid'])) {
		$sql  = "select mimetype, resourceitself";
		$sql .= " from resource";
		$sql .= " where id = " . $_GET['pid'];
		$result = $dbh->query($sql) 
				or die("Error:"."<br/>".$sql);
		$out = $dbh->fetch_array($result);
		header("Content-type: " . $out['mimetype']);
		echo $out['resourceitself'];	
	}