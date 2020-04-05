<?php
// Initialize the session
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["user_email_address"]) && $_SESSION["user_email_address"] === true){
   header('Location: ' . BASE_URL . 'index.php');
    exit;
}


// Define variables and initialize with empty values
$myemailaddress = $mypassword = "";
$myemailaddress_err = $mypassword_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if emailaddress is empty
    if(empty(trim($_POST["emailaddress"]))){
        $myemailaddress_err = "Please enter Email Address.";
    } else{
        $myemailaddress = trim($_POST["emailaddress"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $mypassword_err = "Please enter your password.";
    } else{
        $mypassword = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($myemailaddress_err) && empty($mypassword_err)){
       // Prepare a select statement
       $myemailaddress = mysqli_real_escape_string($link, $_POST["emailaddress"]);
       $mypassword = mysqli_real_escape_string($link, $_POST["password"]);
       $mypassword = md5($mypassword);
       $query = "SELECT user_first_name, user_last_name, user_profile_pricture  FROM users_login WHERE user_email_address = '$myemailaddress' AND password = '$mypassword'";
       $result = $link->query($query);
       $row = $result->fetch_assoc();
       if(mysqli_num_rows($result) > 0)  
           { 
            $_SESSION['user_email_address'] = $myemailaddress;
            $_SESSION['user_first_name'] = $row['user_first_name']; 
            $_SESSION['user_last_name'] = $row['user_last_name'];
            $_SESSION['user_image'] = $row['user_profile_pricture'];
            header('Location: ' . BASE_URL . 'index.php');
           }  
           else  
           {  
                echo '<script>alert("Wrong User Details")</script>';  
           }

        
    }
    
    // Close connection
    mysqli_close($link);
}
?>