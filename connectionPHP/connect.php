<?php 
	$conn=oci_connect("ADMIN","Nepal123#","localhost/xe");
	If (!$conn)
		echo 'Failed to connect to Oracle';
	// else 
	// 	echo 'Succesfully connected with Oracle DB';
?>