    <?php 
      include_once "header.php";
      include_once "user.php";
      include_once "validation.php";
    // Import PHPMailer classes into the global namespace
  // These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // Load Composer's autoloader
  require 'vendor/autoload.php';
      $errors=[];
      if (!empty($_POST)) {
       
        if (!empty($_POST['email'])&&!empty($_POST['password'])) {
         
          // email in correct form
          $validate =new validation();
          $validate->setEmail($_POST['email']);
          $errors['email'] = $validate->validateEmail() ;
         
           
          if (empty($errors['email'])) {
           
           
            $user = new user();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $logged = $user->userLogin();
           
            if (!empty($logged)) {
               //the user existes 
               // fetch user data
               $user_data = $logged->fetch_object();
              
               //check status oof user
               if ($user_datauser->status==2) {
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'ntitasks@gmail.com';                     // SMTP username
                    $mail->Password   = 'NTI@123456';                              // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('ntitasks@gmail.com', 'Verfication Code');
                    $mail->addAddress($email , $frist_name);     // Add a recipient


                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Verfiy';
                    $mail->Body  = 'Your Verification Code is:<b>'.$code.'</b>';

                    $mail->send();
                   
                    header('Location:verify_code.php?email='.$email);
                  } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

               }else {
                 
               }
              
              //  header('Location:index.php');
            }else{
              
              $errors['logged']='
              <div class="alert alert-danger col-10 mx-auto">
                  Invalid Email or password
              </div>';
            }
          }
          
        }else {
         $errors['allRequried'] = "<div class='alert alert-danger'> You must enter all fields </div>";
        }
       
      }
          ?>
        <form class="col-12 col-md-6 mx-auto contact-form " method="POST">
            
            <div class="about-seconed-title">
                <h1 class="col-6 col-md-6 mx-auto">Login To Your Account</h1>
            </div>
            <div class="row col-10 mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label ">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name="email"
                value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
              </div>
            </div>
            <?php
            if (isset($errors['email'])) {
               echo $errors['email'];
           } ?>
            
            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label ">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputEmail3" name="password" value="">
                </div>
            </div>
            <?php
           
            if (isset($errors['logged'])) {
               echo $errors['logged'];
           } ?>
           
           <?php
           
            if (isset($errors['allRequried'])) {
               echo $errors['allRequried'];
           } ?>
            <button type="submit" class="btn btn-success ">Login</button>
            <a class="mx-2" href="sign_up.php">I Don't Have Account</a>
            <a class="mx-2" href="verify_code.php">Forget Password</a>
            
        </form>

       
    <?php include_once "footer.php"?>

    </main>


   