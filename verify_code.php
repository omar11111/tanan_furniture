<?php include_once "header.php";
if(isset($_SESSION['user'])){
  header('Location:index.php');
}?>

<form class="col-12 col-md-6 mx-auto contact-form " method="POST">
    
    <div class="about-seconed-title">
        <h1 class="col-6 col-md-6 mx-auto">Verify code</h1>
    </div>
    <?php
    // get email from url sent with header
      if (!empty($_GET)) {
         if (isset($_GET['email'])) {
             echo 'pppp';
             $email = $_GET['email'];
         }else{
             echo'gfgfgf';
           //  header('Location:404.php');
            }
      }
      
    ?>
    <div class="row col-10 mb-3">
      <label for="inputEmail3" class="col-sm-3 col-form-label ">Enter Code</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" id="inputEmail3" name="code">
      </div>
    </div>

    <?php
     include_once 'validation.php';
     include_once 'user.php';
     $validate =new validation();
     $errors=[];
     if (isset($email)) { 
      
       // check that the email at it's correct form
        $validate->setEmail($email);
        $emailValidation= $validate->validateEmail();

        if (empty($emailValidation)) {
          //done
          // chech if there is a user with  this email
           $user = new user();
           $user->setEmail($email);
           $result = $user->checkEmail();
           if (!empty($result)) {
            // done
               $user_data = $result->fetch_object();
              
           }else{
               $errors['user_data']='
               <div class="alert alert-danger col-10 mx-auto">
                 Email dosen\'t Exist 
               </div>';
               echo $errors['user_data'];
           }

        }

       }

       if (!empty($_POST))  {
          
           echo $_POST['code'];
          echo $user_data->code;
           //if the inserted code is equal to the user code
           if ($user_data->code == $_POST['code']) {
            //Set User to Verified
           
            $user->setId($user_data->id);
            $user->setStatus(1);
            $activation_result= $user->setUserActive();
            //if the query successed
           if ($activation_result) {
           
            $_SESSION['user_data']=$user_data;
            header('Location:index.php');
           }else {
            $errors['something']='
            <div class="alert alert-danger col-10 mx-auto">
              Some Thing Went Wrong 
            </div>';
            echo $errors['something'];
           }
           }else {
            $errors['wrong_code']='
            <div class="alert alert-danger col-10 mx-auto">
              Wrong Code 
            </div>';
            echo $errors['wrong_code'];
           }
           
       }else{echo 'dsfsdfsdf';}
    ?>
     
    <button type="submit" class="btn btn-success ">Verify</button>
    
  
</form>


<?php include_once "footer.php"?>

</main>


