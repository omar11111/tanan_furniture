<?php include_once "header.php"?>

<form class="col-12 col-md-6 mx-auto contact-form ">
    
    <div class="about-seconed-title">
        <h1 class="col-6 col-md-6 mx-auto">Verify code</h1>
    </div>
    <?php
      if (!empty($_GET)) {
         if (isset($_GET['email'])) {
             $email = $_GET['email'];
         }else{
             header('Location:404.php');
            }
      }
      
    ?>
    <div class="row col-10 mb-3">
      <label for="inputEmail3" class="col-sm-2 col-form-label ">Enter Code</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputEmail3">
      </div>
    </div>

    <?php
     include_once 'validation.php';
     $validate =new validation();
     $errors=[];
     if (isset($email)) {
        $validate->setEmail($email);
        $emailValidation= $validate->validateEmail();
        if (empty($emailValidation)) {
           include_once 'user.php';
           $user = new user();
           $user->setEmail($email);
           $result = $user->checkEmail();
           if (!empty($result)) {
               $user_data = $result->fetch_object();

           }else{
               $errors['user_data']='
               <div class="alert alert-danger col-10 mx-auto">
                 Email dosen\'t Exist 
               </div>';
           }

        }

       }

       if (!empty($_POST) && empty($emailValidation)) {
           //set Active
       }else{
        $errors['wrong_code']='
        <div class="alert alert-danger col-10 mx-auto">
          Wrong Code 
        </div>';
       }


     
     
    ?>
     
    <button type="submit" class="btn btn-success ">Verify</button>
    
  
</form>


<?php include_once "footer.php"?>

</main>


