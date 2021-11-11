<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	
	if($stmt->prepare("select * from address where user like ?") or die(mysqli_error($db))) {
		$searchString = '%' . $_GET['searchUAForm'] . '%';
		$stmt->bind_param("s", $searchString);
		$stmt->execute();
		$stmt->bind_result($ip, $user, $datetime);
		echo "<table border=1><th>IP</th><th>User Agent</th><th>Date of Access</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>$ip</td><td>$user</td><td>$datetime</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>