    <?php include_once "header.php";
   
   
          $errors=[];
          if (!empty($_POST)) {
            
            include_once "user.php";
            $user = new user();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $logged = $user->userLogin();
            
            if (!empty($logged)) {
              
            }else{
              $errors['logged']='
              <div class="alert alert-danger col-10 mx-auto">
                  Invalid Email or password
              </div>';
            }
              
          }
             ?>
        <form class="col-12 col-md-6 mx-auto contact-form ">
            
            <div class="about-seconed-title">
                <h1 class="col-6 col-md-6 mx-auto">Login To Your Account</h1>
            </div>
            <div class="row col-10 mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label ">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name="email">
              </div>
            </div>
            
            <div class="row col-10 mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label ">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputEmail3" name="password">
                </div>
            </div>
             
           <?php
            if (!empty($errors)) {
              foreach ($errors as $key => $value) {
                echo $value;
              }
           } ?>
            <button type="submit" class="btn btn-success ">Login</button>
            <a class="mx-2" href="sign_up.html">I Don't Have Account</a>
          
        </form>

       
    <?php include_once "footer.php"?>

    </main>


   