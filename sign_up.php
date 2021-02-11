<?php include_once "header.php";
if(isset($_SESSION['user_data'])){
    header('Location:index.php');
  
  
}  
  // Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Load Composer's autoloader
require 'vendor/autoload.php';
?>
        

        <?php 
           if(!empty($_POST))
           {
            if (
                $_POST['frist_name'] && $_POST['last_name'] && $_POST['password'] && $_POST['confirm_pass'] &&
                $_POST['email'] && $_POST['phone'] && $_POST['gender']
            ){
            $frist_name =$_POST['frist_name'];
            $last_name =$_POST['last_name'];
            $email =$_POST['email'];
            $phone = $_POST['phone'];
            $gender= $_POST['gender'];
            $password =$_POST['password'];
            $con_password =$_POST['confirm_pass'];
            $code=rand(10000,99999);
            $errors=[];

            // class validation 
            include_once 'validation.php';
            $validate = new validation();
            //name validation 
            $validate->setName($frist_name);
            $errors['frist_name']=  $validate->validateName();
         
            $validate->setName($last_name);
            $errors['last_name']=  $validate->validateName();


            //password validation
            $validate->setPassword($password);
            $validate->setConfirmPassword($con_password);
            $errors['password_confirm'] = $validate->passwordValidation();
            
            //email validation 
            $validate->setEmail($email);
            $validate->getEmail();
            $errors['email']=$validate->validateEmail();
            

            // phone validation
            $validate->setPhone($phone);
            $errors['phone']=$validate->validatePhone();
            //insert user data
             if (empty($errors['frist_name'])&& empty($errors['last_name'])
                 && empty($errors['email'])&&empty($errors['phone']) &&empty($errors['password_confirm']))
                  {
                
                include_once "user.php";
                $user = new user();
                $user->setPassword($password);
                $user->setFirstName($frist_name );
                $user->setLastName($last_name);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setGender($gender);
                $user->setCode($code);
                $result = $user->insertData();                                  
               echo $result;
                // if the query successed
                   if ($result) {
                    // send code via mail
                    echo $email;
                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = "ntitasks@gmail.com";                     // SMTP username
                        $mail->Password   = "NTI@123456";                              // SMTP password
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


                } else {
                    $errors['someThing'] = "<div class='alert alert-danger'> Something Went Wrong Email used Before or number</div>";
                    
                }
                
             }else{
                 echo 'ffff';
             }
              
        }else{
            $errors['allRequried'] = "<div class='alert alert-danger'> You must enter all fields </div>";
        }
    }
        ?>
       
        <form action="" method="POST" class="col-12 col-md-6 mx-auto contact-form ">
           
            <div class="about-seconed-title">
                <h1 class="col-6 col-md-6 mx-auto">Create An Account</h1>
            </div>

            <div class="row col-10 mb-3 mx-auto">
            <?php 
            if (!empty($errors['allRequried'])){

                echo $errors['allRequried'];
             
         }?>
            <?php 
            if (!empty($errors['someThing'])){

                echo $errors['someThing'];
             
         }?>
            </div>
          
          
            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Frist Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="frist_name"
                     value="<?php if(isset($_POST['frist_name'])){echo $_POST['frist_name'];} ?>" >
                </div>
            </div>

            <?php 
            if (!empty($errors['frist_name'])){

                echo $errors['frist_name'];
             
         }?>

            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Last Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="last_name" value="<?php echo(isset($_POST['last_name']) ? $_POST['last_name'] : '') ?>">
                </div>
            </div>
            <?php 
            if (isset($errors['last_name'])){

                echo $errors['last_name'];
             
         }?>
            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Email</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="email"  value="<?php echo(isset($_POST['email']) ? $_POST['email'] : '') ?>">
                </div>
            </div>

            <?php 
            if (isset($errors['email'])) {

                echo $errors['email'];
             
           }?>

            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Phone</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="phone"  value="<?php echo(isset($_POST['phone']) ? $_POST['phone'] : '') ?>">
                </div>
            </div>

            <?php 
            if (isset($errors['phone'])) {

                echo $errors['phone'];
             
           }?>

           
            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Select Gender</label>
                <div class="col-sm-10 mx-auto">
                <select name="gender" id="" class="form-control" style="color: #b8802c;">
                   <option <?php echo ((isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : '') ?> value="Male">Male</option>
                   <option <?php if(isset($_POST['gender']) &&  $_POST['gender'] == 'Female') {echo "selected";} ?> value="Female">Female</option>
                </select> </div>
            </div>


            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="password">
                </div>
            </div>

            <?php 
             if (isset( $errors['password_confirm']['password'])) {
                echo $errors['password_confirm']['password'] ;
              }?>

            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-4 col-form-label ">Confirm Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="confirm_pass">
                </div>
            </div>

            <?php 
            if (isset( $errors['password_confirm']['confirm'])) {
                   echo $errors['password_confirm']['confirm'] ;
                 }
                   ?>


            <button type="submit" class="btn   ">Register</button>
            <a class="mx-2" href="sign_in.html"> Already have an account</a>

        </form>

        

        <?php include_once "footer.php"?>
    </main>


   