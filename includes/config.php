<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

// Base URL
define('BASE_URL','http://localhost/MarketingTargetTracker/');

// Title
define('PORTAL_TITLE','MindNAS');

// Database Details
define('DBUSER','root'); // Database Username
define('DBPWD',''); // Database Password
define('DBHOST','localhost'); // Database Server
define('DBNAME','marketingtargettracker'); // Database Name

// Database Link
$link = mysqli_connect(DBHOST,DBUSER,DBPWD,DBNAME);
// Check connection
if (mysqli_connect_errno()) {
    $Error =  "Failed to connect to MySQL: " . mysqli_connect_error();
    header("Location: " . BASE_URL . "Error.php?Error=" . $Error);
    exit();
  }

// Enable Google Login
define('GLOGIN','TRUE'); // FLASE TO DISABLE & TRUE TO ENABLE

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('389061885262-it44g5ptapgalfv88bcd1bpoq671kauv.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('QRtfWWKeozgckdnIEIyZMoEF');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri(BASE_URL . 'login.php');

// Scopes for Google APIs
$google_client->addScope('email');
$google_client->addScope('profile');

//start session on web page
session_start();

?>
