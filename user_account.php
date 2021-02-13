<?php
 
 include_once 'header.php';
 include_once 'validation.php';
 include_once 'user.php';
   
 $errors = [];
 $success = [];
 $emailValidation=[];
 $showPasswod =false;
 $active_info=false;
 $showEmail=false;

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;


 // Load Composer's autoloader
 require 'vendor/autoload.php';
 
// update basic info
if (isset($_POST['update_info'])) {

  if (
      isset($_POST['gender']) && $_POST['gender']
      &&  isset($_POST['frist_name']) && $_POST['frist_name']
      &&  isset($_POST['last_name']) && $_POST['last_name']
      &&  isset($_POST['phone']) && $_POST['phone']
  ) {
      $first = $_POST['frist_name'];
      $last = $_POST['last_name'];
      $phone = $_POST['phone'];
      $gender = $_POST['gender'];

     
    

      $updateData = new user();
      $updateData->setId($_SESSION['user']->id);
      $updateData->setFirstName($first);
      $updateData->setLastName($last);
      $updateData->setPhone($phone);
      $updateData->setGender($gender);

      if ($_FILES['photo']['error'] == 0) {
          $directory = 'images/users/';
          $extention = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
          $fileName = time() . '.' . $extention;
          $fullPath = $directory . $fileName;

          if ($_FILES['photo']['size'] > 1000000) {
              $errors['size'] = "<div class='alert alert-danger'> You must upload image less than 1 mega </div>";
              $active_info = "show active";
             
          }

          $extArrays = ['png', 'jpg', 'jpeg'];
          if (!in_array($extention, $extArrays)) {
              $errors['ext'] = "<div class='alert alert-danger'> You must upload image With extensions png, jpg, jpeg only </div>";
              $active_info = "show active";
          }

          if (empty($errors)) {
              move_uploaded_file($_FILES['photo']['tmp_name'], $fullPath);
              $updateData->setPhoto($fileName);
              $_SESSION['user_data']->photo = $updateData->getPhoto();
          }
      }
      if (empty($errors)) {
          $result = $updateData->updateData();
          if ($result) {
              $success['updateInfo'] = '<div class="alert alert-success" >  Information Has been Updated </div>';
              $active_info = "show active";
              
              $_SESSION['user_data']->first_name = $first;
              $_SESSION['user_data']->last_name = $last;
              $_SESSION['user_data']->gender = $gender;
              $_SESSION['user_data']->phone = $phone;
          } else {
              $errors['something'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
              $active_info = "show active";
              echo $errors['something'];
          }
      }
  } else {
      $errors['allFields'] = "<div class='alert alert-danger'> You must Enter all fields </div>";
      $active_info = "show active";
      echo $errors['allFields'];
  }
}


//change password
// change password
if (isset($_POST['change-password'])) {
  if (
      isset($_POST['old_password']) && $_POST['old_password']
      &&  isset($_POST['password']) && $_POST['password']
      &&  isset($_POST['confirm_password']) && $_POST['confirm_password']
  ) {
      $passwordData = new user();
      $passwordData->setPassword($_POST['old_password']);
      if (!($_SESSION['user']->password == $passwordData->getPassword())) {
          $erros['oldPass'] = "<div class=' alert alert-danger'> Wrong Password </div>";
          $showPasswod = "show active";
          $active_info='';
      }
      $passwordData->setPassword($_POST['password']);
      if ($_SESSION['user']->password == $passwordData->getPassword()) {
          $erros['enterNew'] = "<div class=' alert alert-danger'> You must enter New password </div>";
          $showPasswod = "show active";
          $active_info='';
      }

      $validate = new validation();
      $validate->setPassword($_POST['password']);
      $validate->setConfirmPassword($_POST['confirm_password']);
      $passwordValidation = $validate->passwordValidation();

      if (!empty($passwordValidation)) {
          $showPasswod = "show active";
          $active_info='';
      }
      if (empty($passwordValidation) && empty($errors)) {
          $passwordData->setId($_SESSION['user']->id);
          $result = $passwordData->changePassword();
          if ($result) {
              $_SESSION['user']->password = $passwordData->getPassword();
              $success['updateInfo'] = '<div class="alert alert-success" >  Password Has been Updated </div>';
              $showPasswod = "show active";
              $active_info='';
          } else {
              $errors['something'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
              $showPasswod = "show active";
              $active_info='';
          }
      }
  } else {

      $errors['allFields'] = "<div class='alert alert-danger'> You must Enter all fields </div>";
      $showPasswod = "show active";
      $active_info='';

  }
}



   // change email
   if (isset($_POST['change_email'])) {
    if ($_POST['email']) {
        // do logic
       
        if ($_SESSION['user_data']->email == $_POST['email']) {
            $sameEmail = "<div class='alert alert-danger'> Your email dosen't changed </div>";
            $showEmail = "show active";
        } else {
            // validate on email
           
            $validate = new validation();
            $validate->setEmail($_POST['email']);
            $emailValidation= $validate->validateEmail();

            if (!empty($emailValidation )) {
                $showEmail = "show active";
               
            }

            if (empty($emailValidation )) {
                // update email in db 
               
                $code = rand(10000, 99999);
                $emailUser = new user();
                $emailUser->setEmail($_POST['email']);
                $emailUser->setId($_SESSION['user_data']->id);
                $emailUser->setStatus(2);
                $emailUser->setCode($code);
                $result = $emailUser->changeEmail();
                if ($result) {
                  echo 'ddd';
                    $_SESSION['user']->email = $_POST['email'];
                    // $success['email'] = "<div class='alert alert-success'> You Email Has been Updated </div>";

                    // send code via email
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                        $mail->Username   = 'ntitasks@gmail.com';                     // SMTP username
                        $mail->Password   = 'NTI@123456';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom('ntitasks@gmail.com', 'Verfication Code');
                        $mail->addAddress($emailUser->getEmail());     // Add a recipient


                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Verfiy';
                        $mail->Body    = 'Your Verification Code is:<b>' . $code . '</b>';

                        $mail->send();
                        // echo 'Message has been sent';
                        header('Location:verify_code.php?email=' . $_POST['email']);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    $showEmail = "show active";
                } else {
                    $something = "<div class='alert alert-danger'> Email Already Exists </div>";
                    $showEmail = "show active ";
                }
            }
        }
    } else {
        $errors['allFields'] = "<div class='alert alert-danger'> You must Enter all fields </div>";
        $showEmail = "show active";
    }
}
     


// address cycle
// show 
include_once 'Address.php';
include_once 'City.php';
include_once 'Region.php';
$region =new Region();
$city= new City();
$address =new Address();
$address->setId($_SESSION['user_data']->id);
$query_user_address=$address->selectAllData($_SESSION['user_data']->id);
if ($query_user_address) {
  // now i know the adresses that belongs to that user
   $get_user_address=$query_user_address->fetch_all(MYSQLI_ASSOC);
   
  //get cites and but it into the optselector
   $city_query= $city->selectAllData();
   if ($city_query) {
     $city_data = $city_query->fetch_all(MYSQLI_ASSOC);
     
   }else{
     $something['database']= "<div class='alert alert-danger'> Something went Wrong </div>";
   }
}else{ $something['database']= "<div class='alert alert-danger'> Something went Wrong </div>";
}
?>

<div class="">
  <h1 class=" text-center col-3 mx-auto  my-5" style="color: #b8802c;">Edit Profile</h1>
  <div class="row edit-form">

    <div class="col-8 mx-auto  ">
      <div class="tab-content" id="nav-tabContent">

        <!-- update basic info -->
        <div class="tab-pane fade show  <?php if($active_info){echo $active_info;}?>" id="list-home" role="tabpanel"
          aria-labelledby="list-home-list">
          <!-- form information edit information -->
          <form action="" method="post" enctype="multipart/form-data" class=" mx-5">
            <?phpecho $success['updateInfo'] ;?>
            <div class="offset-4 col-4">
              <img src="images/users/<?php echo $_SESSION['user_data']->photo ?>" alt="" class="rounded"
                style="width:100%">
              <input type="file" name="photo" id="" class="form-control">
            </div>

            <div class="row mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c;font-size:25px">Frist
                Name</label>
              <div class="col-sm-8 mx-auto">
                <input type="text" class="form-control" id="inputEmail3" name="frist_name"
                  value="<?php echo $_SESSION['user_data']->first_name ?>">
              </div>
            </div>

            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c; font-size:25px">Last
                Name</label>
              <div class="col-sm-8 mx-auto">
                <input type="text" class="form-control" id="inputEmail3" name="last_name"
                  value="<?php echo $_SESSION['user_data']->last_name  ?>">
              </div>
            </div>

            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
                style="color: #b8802c;font-size:25px">Phone</label>
              <div class="col-sm-8 mx-auto">
                <input type="text" class="form-control" id="inputEmail3" name="phone"
                  value="<?php echo $_SESSION['user_data']->phone ?>">
              </div>
            </div>

            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
                style="color: #b8802c; font-size:25px">Select Gender</label>
              <div class="col-sm-8 mx-auto">
                <select name="gender" id="" class="form-control" style="color: #b8802c;">
                  <option
                    <?php echo ((isset($_SESSION['user_data']->gender) &&  $_SESSION['user_data']->gender  == 'Male') ? 'selected' : '') ?>
                    value="Male">Male</option>
                  <option
                    <?php if(isset($_SESSION['user_data']->gender) &&  $_SESSION['user_data']->gender == 'Female') {echo "selected";} ?>
                    value="Female">Female</option>
                </select> </div>
            </div>

            <button class="btn update-button ms-5 py-2 px-5 " type="submit" name="update_info">Update</button>

          </form>
        </div>

        <!-- update password -->
        <div class="tab-pane fade <?php if($showPasswod) { echo $showPasswod;} ?>" id="list-profile" role="tabpanel"
          aria-labelledby="list-profile-list">
          <form class="col-12  mx-auto  " method="POST">

            <div class=" mb-3">
              <h1 class="col-6 col-md-6 mx-auto" style="color: #b8802c;">Change Password</h1>
            </div>

            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c; font-size:25px">
                Old Password
              </label>
              <div class="col-sm-8 mx-auto">
                <input type="password" class="form-control" id="inputEmail3" name="old_password" value="">
              </div>
            </div>

            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c; font-size:25px">
                New Password
              </label>
              <div class="col-sm-8 mx-auto">
                <input type="password" class="form-control" id="inputEmail3" name="password" value="">
              </div>
            </div>


            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c; font-size:25px">
                Confirm Password
              </label>
              <div class="col-sm-8 mx-auto">
                <input type="password" class="form-control" id="inputEmail3" name="confirm_password" value="">
              </div>
            </div>

            <div class="col-10 mx-auto">
              <?php
                if (!empty($passwordValidation)) {
                    foreach ($passwordValidation as $key => $value) {
                        echo $value;
                    }
                }
                if (!empty($errors)) {
                    foreach ($errors as $key => $value) {
                        echo $value;
                    }
                }
            ?>
            </div>



            <button class="btn update-button ms-5 py-2 px-5 " type="submit" name="change-password">Update</button>


          </form>
        </div>

        <!-- update email -->
        <div class="tab-pane fade <?php if($showEmail) { echo $showEmail;}?>" id="list-messages" role="tabpanel"
          aria-labelledby="list-messages-list">
          <form action="" method="post">


            <div class="row  mb-3 mx-auto">
              <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label " style="color: #b8802c;font-size:25px">Your
                Email</label>
              <div class="col-sm-8 mx-auto">
                <input type="text" class="form-control" id="inputEmail3" name="email"
                  value="<?php echo $_SESSION['user_data']->email ?>">
              </div>
            </div>
            <?php
                                
                                
                                 if (isset($something)) {
                                  echo $something;
                              }
                              if (isset($sameEmail)) {
                                  echo $sameEmail;
                              }
                                if (isset($success['email'])) {
                                    echo $success['email'];
                                }
              ?>
            <?php
             if (!empty($emailValidation)) {
              foreach ($emailValidation as $ky => $vl) {
                  echo $vl;
              }
          }
          ?>

            <button class="btn update-button ms-5 py-2 px-5 " type="submit" name="change_email">Change Email</button>

          </form>
        </div>

        <!-- update address -->
        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
          <form action="" method="post">
          <!-- Add New Address -->
          <div class="row  mb-3 mx-auto">
            <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
              style="color: #b8802c;font-size:25px">Street</label>
            <div class="col-sm-8 mx-auto">
              <input type="text" class="form-control" id="inputEmail3" name="street" value="">
            </div>
          </div>

          <div class="row  mb-3 mx-auto">
            <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
              style="color: #b8802c;font-size:25px">Building</label>
            <div class="col-sm-8 mx-auto">
              <input type="number" class="form-control" id="inputEmail3" name="building"
                value="<?php //echo $_SESSION['user_data']->email ?>">
            </div>
          </div>

          <div class="row  mb-3 mx-auto">
            <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
              style="color: #b8802c;font-size:25px">Level</label>
            <div class="col-sm-8 mx-auto">
              <input type="text" class="form-control" id="inputEmail3" name="level"
                value="<?php //echo $_SESSION['user_data']->email ?>">
            </div>
          </div>

          <div class="row  mb-3 mx-auto">
            <label for="inputEmail3" class="col-sm-6 ms-4 col-form-label "
              style="color: #b8802c;font-size:25px">Flat</label>
            <div class="col-sm-8 mx-auto">
              <input type="text" class="form-control" id="inputEmail3" name="flat"
                value="<?php //echo $_SESSION['user_data']->email ?>">
            </div>
          </div>

          <div class="row  mb-3 mx-auto">
            <div class="col-sm-8 mx-auto">
              <textarea class="form-control" name="notes" id="" cols="30" rows="5" style="font-weight: bolder;">Notes</textarea>
            </div>
          </div>

          <div class="row  mb-3 mx-auto">

            <div class="col-sm-8 mx-auto">

              <select name="gender" id="" class="form-control" style="font-weight: bolder;">
                <option
                  <?php echo ((isset($_SESSION['user_data']->gender) &&  $_SESSION['user_data']->gender  == 'Male') ? 'selected' : '') ?>
                  value="Male">Home</option>
                <option
                  <?php if(isset($_SESSION['user_data']->gender) &&  $_SESSION['user_data']->gender == 'Female') {echo "selected";} ?>
                  value="Female">Work</option>
              </select>

            </div>
          </div>

          <div class="row  mb-3 mx-auto">
            <div class="col-sm-8 mx-auto">

              <select class="form-control" name="cars" id="cars" style="font-weight: bolder;">
                
                <?php
                 
                
                foreach ($city_data as $key => $value) {
                   $region->setCityId($value['id']);
                  $query_region=$region->selectAllData();
                  if ($query_region) {
                    
                    $get_regions =$query_region->fetch_all(MYSQLI_ASSOC);
                    
                  }else{
       
                  $noRegions = "<div class='alert alert-danger'> There is no Regions </div>";
                  echo $noRegions;
                } ?>   
                <?php 
                   
                  
                ?>
               
               <optgroup label="<?php echo $value['name'] ?>">
              <?php  foreach ($get_regions as $key1 => $value1) {
              ?>
                    
                  <option value="<?php echo $value1['id']?>"><?php echo $value1['name']?></option>
                  <?php } ?>
                 
                </optgroup>

                <?php }?>
                
              </select>

            </div>
          </div>


          <!-- end add new address -->
          <button class="btn update-button ms-5 py-2 px-5 " type="submit" name="editAddress">Add New Address</button>





        </div>
      </div>
    </div>

    <div class="  col-4 row justify-content-center align-self-center mx-auto ">
      <div class="list-group row align-items-center rounded mx-auto  text-center" id="list-tab" role="tablist">
        
        <a class="list-group-item p-3 col-6 list-group-item-action <?php if($active_info){echo $active_info;}?>"
          id="list-home-list" style="" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Edit
          information</a>

        <a class="list-group-item p-3 col-6 list-group-item-action <?php if($showPasswod) { echo $showPasswod;}?>"
          id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Change
          Password</a>

        <a class="list-group-item p-3 col-6 list-group-item-action <?php if($showEmail) { echo $showEmail;}?>"
          id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Change
          Email</a>

        <a class="list-group-item p-3 col-6 list-group-item-action" id="list-settings-list" data-toggle="list"
          href="#list-settings" role="tab" aria-controls="settings">Settings</a>
      </div>
    </div>
  </div>


  <!-- left column -->


  <!-- edit form column -->


</div>

<?php include_once 'footer.php'?>