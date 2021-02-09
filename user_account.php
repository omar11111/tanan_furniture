<?php include_once 'header.php';

if(!empty($_POST))
{
  $errors=[];
 if (
     $_POST['frist_name'] && $_POST['last_name'] 
        && $_POST['phone'] && $_POST['gender']
 ){
  $frist_name =$_POST['frist_name'];
  $last_name =$_POST['last_name'];
  $email =$_POST['email'];
  $phone = $_POST['phone'];
  $gender= $_POST['gender'];
  
  include_once 'validation.php';
  $validate=new validation();
  $validate->setName($frist_name);
  $errors['frist_name']=  $validate->validateName();

  $validate->setName($last_name);
  $errors['last_name']=  $validate->validateName();

  $validate->setPhone($phone);
  $validate->getPhone();
  $errors['phone']=$validate->validatePhone();

  if ($_FILES['photo']['error']== 0) {
    $directory='images/users/';
    $exe = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $file_name=time().'.'.$exe;
    $full_path =$directory . $file_name;

    if ($_FILES['photo']['size']>1000000) {
      $errors['size'] = 
      "<div class='alert alert-danger'> 
           photo size less than 1 mega bit 
       </div>";
    }



    $exe_array=['png','jpg','jpeg'];
    if (!in_array($exe,$exe_array)) {
      $errors['extention'] = 
      "<div class='alert alert-danger'> 
           photo size less than 1 mega bit 
       </div>";
    }




  }


 }
}
?>

<div class="container">
    <h1>Edit Profile</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="mx-auto col-8">
          <img src="images/defult.png" class="profile-image col-10 " alt="avatar">
          <h6>Upload a different photo...</h6>
          <input type="file" class="form-control">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class=" col-md-8 mx-auto">
        <div class="about-seconed-title">
          <h3>Personal info</h3>
        </div>
       
        <!-- multipart/form-data 
             means you can recive diffrtrnt types of data -->
        <form class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-lg-3 col-form-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Jane">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Bishop">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Phone:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="janesemail@gmail.com">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Time Zone:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_time_zone" class="form-control">
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" type="text" value="janeuser">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="11111122333">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="11111122333">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="button" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
<?php include_once 'footer.php'?>