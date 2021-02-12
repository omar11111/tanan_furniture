<?php include_once "header.php";
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;


 // Load Composer's autoloader
 require 'vendor/autoload.php';
?>

<form class="col-12 col-md-6 mx-auto contact-form " method="POST">
    
    <div class="">
        <h1 class="text-center col-10   mb-5">Verify Email </h1>
    </div>
  
    <div class="row col-10 mb-3 text-center">
      <label for="inputEmail3" class="col-sm-2 col-form-label ">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEmail3" name="email">
      </div>
    </div>

    <?php
     include_once 'validation.php';
     include_once 'user.php';
     $validate =new validation();
     $errors=[];
     if (isset($_POST['email'])) { 
       $email=$_POST['email'];
     
       // check that the email at it's correct form
        $validate->setEmail($email);
        $emailValidation= $validate->validateEmail();

        if (empty($emailValidation)) {
          //done
          // chech if there is a user with  this email
           $user = new user();
           $user->setEmail($email);
           $result = $user->checkEmail();
           //check the query successed or not
            if (!empty($result)) {
                //email exists
                $user_data = $result->fetch_object();
                //generate new code
                $code =rand(10000,99999);
                //update code
                $user->setCode($code);
                // check f the update query successed
                $code_updated= $user->updateCode();
                if ($code_updated) {
                    //if successed send the new code
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
                    $mail->addAddress($user_data->email , $user_data->first_name);     // Add a recipient


                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Verfiy';
                    $mail->Body  = 'Your Verification Code is:<b>'.$code.'</b>';

                    $mail->send();
                    
                        header('Location:verify_code.php?email='.$user_data->email.'&forget=1');
                    } catch (Exception $e) 
                    {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                
                }else{
                    $errors['something']='
                <div class="alert alert-danger col-10 mx-auto">
                Something Went Wrong
                </div>';
                echo $errors['something'];
                }
                
            }else{
                
            echo $errors['email'];
            }  
           }

        

       

    //    if (!empty($_POST))  {
          
    //        echo $_POST['email'];
    //        echo $user_data->code;
    //        //if the inserted code is equal to the user code
    //        if ($user_data->email == $_POST['email']) {
    //         //Set User to Verified
           
            
    //         //if the query successed
          
           
    //         $_SESSION['user_data']=$user_data;
    //         header('Location:index.php');
          
      
    //    }
    // }
    ?>
     
    <button type="submit" class="btn btn-success ">Verify Email</button>
    
  
</form>


<?php include_once "footer.php"?>

</main>


