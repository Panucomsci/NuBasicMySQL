<?php
	$orderBy = "id";
	$order = "asc";	
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	$id = "asc";
	$firstname = "asc";
	$lastname = "asc";
	$idcard = "asc";	
	if($orderBy == "id" and $order == "asc") {
		$id = "desc";
	}
	if($orderBy == "firstname" and $order == "asc") {
		$firstname = "desc";
	}
	if($orderBy == "lastname" and $order == "asc") {
		$lastname = "desc";
	}
	if($orderBy == "idcard" and $order == "asc") {
		$idcard = "desc";
	}
?>