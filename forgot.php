<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!--condition sit ml forgot password form atwt-->
<?php
  use PHPMailer\PHPMailer\PHPMailer;

  require './phpmailer/vendor/autoload.php';
  require './classes/Config.php';

  if(!isset($_GET['forgot'])){//dr ka forgot password so tk sidebar ka link ko nate mha

    redirect('index');

    }


  if(ifItIsMethod('post')){

    if(isset($_POST['email'])) {

        $email = $_POST['email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));



      if(email_exists($email)){
        if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        /**
         *
         * configure PHPMailer
         *
         *
         */
        $mail=new PHPMailer();

        $mail->isSMTP();
        $mail->Host       = 'smtp.mailtrap.io';
        $mail->Port       = 2525;
        $mail->Username   = '09caa557c5af04';
        $mail->Password   = '7a87b2afef3b4c';
        $mail->SMTPSecure='tls';
        $mail->SMTPAuth=true;
        $mail->isHTML(true);
        $mail->CharSet="UTF-8";

        $mail->setFrom('meemee@gmail.com','Mailer');
        $mail->addAddress($email);//forgot form mr htae tk email new
        $mail->Subject="This is an email for password reset";
        // $mail->Body="<h2>This is email body love ya love ya chefkiss</h2>";
        // $mail->AltBody="I hate you gordan ramsay";
        $mail->Body = "<h3>Password Reset</h3>
        <p>
        Please click <a href='http://localhost/NewCMS/reset.php?email={$email}&token={$token}'>
        http://localhost/cms/reset.php?email={$email}&token={$token}</a> to reset your password.

        Thank you
        </p>";


        if($mail->send()){
          // echo "Thanks god email is sent";
        $emailSent=true;
        }else{
          echo "Fucking shit email is not sent";
        }


          }

        }
      }
   }

    ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
     <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">

        <?php if(!isset($emailSent)):?>
        <h3><i class="fa fa-lock fa-4x"></i></h3>
         <h2 class="text-center">Forgot Password?</h2>
         <p>Don't Worry!!You can reset your password here.</p>
         <div class="panel-body">

        <form id="register-form" role="form" autocomplete="off" class="form" method="post">

            <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                </div>
            </div>
            <div class="form-group">
                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
            </div>

            <input type="hidden" class="hide" name="token" id="token" value="">
        </form>
        </div><!-- Body-->
      <?php else: ?>
        <h3 style= 'color:red'>Please check your email you stupid dumb head:3</h3>
      <?php endIf; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->
