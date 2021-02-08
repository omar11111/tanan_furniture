<?php include_once "header.php"?>
        

        <?php 
           if(!empty($_POST))
           {
            $frist_name =$_POST['frist_name'];
            $last_name =$_POST['last_name'];
            $email =$_POST['email'];
            $phone = $_POST['phone'];
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
            $errors['password'] = $validate->passwordValidation();
            //email validation 
            $validate->setEmail($email);
            $validate->getEmail();
            $errors['email']=$validate->validateEmail();
            echo '<pre>';
            print_r($errors);
            echo'</pre>';
            //insert user data
           
              
        }
        ?>
       
        <form action="" method="POST" class="col-12 col-md-6 mx-auto contact-form ">

            <div class="about-seconed-title">
                <h1 class="col-6 col-md-6 mx-auto">Create An Account</h1>
            </div>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Frist Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="frist_name" >
                </div>
            </div>

            <?php 
            if (!empty($errors['frist_name'])){

                echo $errors['frist_name'];
             
         }?>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Last Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="last_name" >
                </div>
            </div>
            <?php 
            if (isset($errors['last_name'])){

                echo $errors['last_name'];
             
         }?>
            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Email</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="email">
                </div>
            </div>

            <?php 
            if (isset($errors['email'])) {

                echo $errors['email'];
             
           }?>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Phone</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="phone">
                </div>
            </div>

           

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="password">
                </div>
            </div>

            <?php 
             if (isset( $errors['password'])) {

                foreach ($errors['password'] as $key => $value) {
                   echo $value;
                }
             
             }?>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label ">Confirm Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="confirm_pass">
                </div>
            </div>

            <?php 
            if (isset( $errors['password'])) {

                foreach ($errors['password'] as $key => $value) {
                   echo'
                    <div class="alert alert-danger col-10 mx-auto">
                       Please Confirm Password
                    </div>' ;}
         }?>


            <button type="submit" class="btn   ">Register</button>
            <a class="mx-2" href="sign_in.html"> Already have an account</a>

        </form>

        

        <?php include_once "footer.php"?>
    </main>


   