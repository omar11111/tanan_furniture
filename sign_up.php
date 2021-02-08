<?php include_once "header.php"?>
        

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
            $validate->getPhone();
            $errors['phone']=$validate->validatePhone();
            
            print_r($errors);
            //insert user data
             if (empty($errors['frist_name'])&& empty($errors['last_name'])
                 && empty($errors['email'])&&empty($errors['phone']) &&empty($errors['password_confirm'])) {
                
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
                
                // if the query successed
                if ($result) {
                   echo 'query success'.$result;
                }else {
                  echo 'query failed'. $result;
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
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Frist Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="frist_name" >
                </div>
            </div>

            <?php 
            if (!empty($errors['frist_name'])){

                echo $errors['frist_name'];
             
         }?>

            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Last Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="last_name" >
                </div>
            </div>
            <?php 
            if (isset($errors['last_name'])){

                echo $errors['last_name'];
             
         }?>
            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Email</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="email">
                </div>
            </div>

            <?php 
            if (isset($errors['email'])) {

                echo $errors['email'];
             
           }?>

            <div class="row col-10 mb-3 mx-auto">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Phone</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="phone">
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


   