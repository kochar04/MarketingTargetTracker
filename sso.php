<?php
include('./includes/config.php');

// GOOGLE SSO START
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }


  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
   $mysqli = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);
   $sql = "SELECT * FROM users_login WHERE user_email_address='".$_SESSION['user_email_address']."'";
   $result = $mysqli->query($sql);
   if(!empty($result->fetch_assoc())){
    $sql2 = "UPDATE users_login SET user_profile_pricture='".$_SESSION['user_image']."' WHERE user_email_address='".$_SESSION['user_email_address']."'";
    }else{
    $sql2 = "INSERT INTO users_login (user_first_name, user_email_address, user_last_name, user_profile_pricture) VALUES ('".$_SESSION['user_first_name']."', '".$_SESSION['user_email_address']."', '".$_SESSION['user_last_name']."', '".$_SESSION['user_image']."')";
    }
    $mysqli->query($sql2);
  }

 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(isset($_SESSION['user_email_address']))
{
  header('Location: ' . BASE_URL . 'index.php');
}
else{
  $login_button = '<a href="'.$google_client->createAuthUrl().'"><button class="btn btn-secondary btn-block">Sign in using SSO</button></a>';
}
// GOOGLE SSO END


?>

