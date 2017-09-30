<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database
require_once('database/dbconfig.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($conn->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
