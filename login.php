<?php 

include('sso.php');

include('auth.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Marketing Target Tracker | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">


<?php 
//Error Display
if(!empty($myemailaddress_err)){
  echo '<div class="alert alert-warning alert-dismissible fade show">';
  echo '<strong>Warning! </strong>' . $myemailaddress_err;
  echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  echo '</div>';

}

if(!empty($mypassword_err)){
  echo '<div class="alert alert-warning alert-dismissible fade show">';
  echo '<strong>Warning! </strong>' . $mypassword_err;
  echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
  echo '</div>';

}

?>

<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo BASE_URL . 'index.php'; ?>"><b>Marketing Target Tracker </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name = "emailaddress" value="<?php echo $myemailaddress; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
         
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name = "password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <div class="social-auth-links text-center mb-3">
        
        <?php
        if(GLOGIN == 'TRUE'){
          if($login_button == ''){
            header(BASE_URL . 'index.php');
          }
          else{
            echo '<p>- OR -</p>';
            echo $login_button;
          }
        }

        ?>
      </div>
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/adminlte.min.js"></script>

</body>
</html>
