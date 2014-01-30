<?php
include_once('CAS/CAS.php');
phpCAS::client(CAS_VERSION_2_0,'felicity.iiit.ac.in/cas', 443,''); // initializes phpCAS
phpCAS::setNoCasServerValidation(); // no SSL validation for the CAS server

$logged_in = false;
$user = '';
if(phpCAS::isAuthenticated())
{
    global $logged_in, $user;
    $logged_in=true;
    $user = phpCAS::getUser();
    //Returns the name of the authenticated user (you get the full college email id, in my case : sharada.mohanty@students.iiit.ac.in)
}
