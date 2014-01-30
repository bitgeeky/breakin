<?php
include_once('CAS/CAS.php');

phpCAS::client(CAS_VERSION_2_0,'felicity.iiit.ac.in/cas', 443,''); // initializes phpCAS
phpCAS::setNoCasServerValidation(); // no SSL validation for the CAS server

session_unset();
session_destroy();

if( isset($_GET['destination']))
{
	$desti = $_GET['destination'];
	echo $desti;
	header("Location: $desti");
	exit();
}

else
{
	header("Location: http://felicity.iiit.ac.in/threads");
	exit();
}
