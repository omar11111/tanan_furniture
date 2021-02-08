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

            //password validation
            include_once 'validation.php';
            $validate = new validation();
            $validate->setPassword($password);
            $validate->setConfirmPassword($con_password);
            $password_validation =$validate-> passwordValidation();
            
            //email validation 
            $validate->setEmail($email);
            $validate->getEmail();
            $email_validation=$validate->validateEmail();

            //insert user data
            include_once'user.php';
              
        }
        ?>
       
        <form action="sign_up.php" method="POST" class="col-12 col-md-6 mx-auto contact-form ">

            <div class="about-seconed-title">
                <h1 class="col-6 col-md-6 mx-auto">Create An Account</h1>
            </div>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Frist Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="frist_name" >
                </div>
            </div>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Last Name</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="last_name" >
                </div>
            </div>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Email</label>
                <div class="col-sm-10 mx-auto">
                    <input type="text" class="form-control" id="inputEmail3" name="email">
                </div>
            </div>

            <?php 
            if (!empty($email_validation)) {

                   echo $email_validation;
                
            }?>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Phone</label>
                <div class="col-sm-10 mx-auto">
                    <input type="email" class="form-control" id="inputEmail3" name="phone">
                </div>
            </div>

           

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label ">Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="password">
                </div>
            </div>

            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label ">Confirm Password</label>
                <div class="col-sm-10 mx-auto">
                    <input type="password" class="form-control" id="inputEmail3" name="confirm_pass">
                </div>
            </div>

            <?php 
            if (!empty($password_validation)) {
                foreach ($password_validation as $key => $value) {
                   echo $value;
                }
            }?>


            <button type="submit" class="btn   ">Register</button>
            <a class="mx-2" href="sign_in.html"> Already have an account</a>

        </form>

        <footer class="col-12 row  mx-auto p-3 text-center">
            <h2 class=" mb-4 ">More Than A Place It's Your Home</h2>
            <div class="col-12 col-md-3  mx-auto">
                <h3>Location</h3>

                <a href=""> Tanan Qlioup Qlioupia</a>
                <a href="">Tanan Qlioup Qlioupia</a>
                <a href="">Tanan Qlioup Qlioupia</a>

            </div>
            <div class="col-12 col-md-3 mx-auto">
                <h3> Company</h3>

                <a href="">About Us</a>
                <a href="">Products</a>
                <a href="">Contact US</a>

            </div>
            <div class="col-12 col-md-3  mx-auto">
                <h3>Social Media</h3>

                <a href=""><i class="mx-2 fab fa-facebook-f"></i>Facebook</a>
                <a href=""><i class="mx-2 fab fa-youtube"></i>YouTube</a>
                <a href=""><i class="mx-2 fab fa-twitter"></i>Twitter</a>

            </div>

            <div class="col-12 my-4 color-light ">This Website &copy; Omar ALGalfy</div>

        </footer>

        <?php include_once "footer.php"?>
    </main>


   