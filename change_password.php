<?php include_once "header.php";

if(isset($_SESSION['user_data'])){
  header('Location:index.php');
}


if(!empty($_POST)){
    //get password value
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_pass'];
    // validate password
    include_once "validation.php";
    $validate = new validation();
    $validate->setPassword($password);
    $validate->setConfirmPassword($confirmPassword);
    $passwordValidation = $validate->passwordValidation();

    // if the pass in the right form
    if(empty($passwordValidation)){
        // update new password
        $email = $_SESSION['email'];
        include_once "user.php";
        $user = new user();
        $user->setEmail($email);
        $verifiedUser = $user->checkEmail();

        if(!empty($verifiedUser)){
            $userData = $verifiedUser->fetch_object();
            $user->setPassword($password);

            if($userData->password == $user->getPassword()){
                $errors['password'] = "<div class='alert alert-danger'> You must enter a new password </div>";
            }else{

                $result = $user->updatePassword();
                if(!empty($result)){
                    $userData = $result->fetch_object();
                    $_SESSION['user_data'] = $userData;
                    header('Location:index.php');

                }else{
                    $errors['dbError'] = "<div class='alert alert-danger'> Something went Wrong </div>";
                }
            }
        }else{
            $errors['email'] = "<div class='alert alert-danger'> this email dosen't exists </div>";
        }

    }
}

?>

<form class="col-12 col-md-6 mx-auto contact-form " method="POST">
    
    <div class="about-seconed-title mb-3">
        <h1 class="col-6 col-md-6 mx-auto">Change Password</h1>
    </div>
    
    

    <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="password">
                </div>
            </div>


            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-4 col-form-label ">Confirm Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="confirm_pass">
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

   
     
    <button type="submit" class="btn btn-success ">Verify</button>
    
  
</form>


<?php include_once "footer.php"?>

</main>


