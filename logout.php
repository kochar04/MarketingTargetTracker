<?php
// Include configuration file
include('./includes/config.php');

// Remove token and user data from the session
unset($_SESSION['user_email_address']);

// Reset OAuth access token
// $gClient->revokeToken();

// Destroy entire session data
session_destroy();

// Redirect to homepage
$location_logout = 'Location:' . BASE_URL . 'login.php';
header($location_logout);
?>