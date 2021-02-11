<?php

 include_once 'header.php';
 include_once 'validation.php';
 include_once 'user.php';
   

    

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
              $show = "show";
             
          }

          $extArrays = ['png', 'jpg', 'jpeg'];
          if (!in_array($extention, $extArrays)) {
              $errors['ext'] = "<div class='alert alert-danger'> You must upload image With extensions png, jpg, jpeg only </div>";
              $show = "show";
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
            
              
              $_SESSION['user_data']->first_name = $first;
              $_SESSION['user_data']->last_name = $last;
              $_SESSION['user_data']->gender = $gender;
              $_SESSION['user_data']->phone = $phone;
          } else {
              $errors['something'] = "<div class='alert alert-danger'> SomeThing Went Wrong </div>";
              $show = "show";
              echo $errors['something'];
          }
      }
  } else {
      $errors['allFields'] = "<div class='alert alert-danger'> You must Enter all fields </div>";
      $show = "show";
      echo $errors['allFields'];
  }
}
    
?>

<div class="">
  <h1 class="about-seconed-title text-center col-3 mx-auto  my-5">Edit Profile</h1>
  <div class="row edit-form">

    <div class="col-8 mx-auto  ">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
          <!-- form information edit information -->
          <form action="" method="post" enctype="multipart/form-data" class=" mx-5">
          <?phpecho $success['updateInfo'] ;?>  
          <div class="offset-4 col-4">
              <img src="images/users/<?php echo $_SESSION['user_data']->photo ?>" alt="" class="rounded" style="width:100%">
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
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
          2</div>
        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
          3</div>
        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
          4</div>
      </div>
    </div>

    <div class="  col-4 row justify-content-center align-self-center mx-auto ">
      <div class="list-group row align-items-center rounded mx-auto  text-center" id="list-tab" role="tablist">
        <a class="list-group-item p-3 col-6 list-group-item-action active" id="list-home-list" style=""
          data-toggle="list" href="#list-home" role="tab" aria-controls="home">Edit information</a>
        <a class="list-group-item p-3 col-6 list-group-item-action" id="list-profile-list" data-toggle="list"
          href="#list-profile" role="tab" aria-controls="profile">Profile</a>
        <a class="list-group-item p-3 col-6 list-group-item-action" id="list-messages-list" data-toggle="list"
          href="#list-messages" role="tab" aria-controls="messages">Messages</a>
        <a class="list-group-item p-3 col-6 list-group-item-action" id="list-settings-list" data-toggle="list"
          href="#list-settings" role="tab" aria-controls="settings">Settings</a>
      </div>
    </div>
  </div>


  <!-- left column -->


  <!-- edit form column -->


</div>

<?php include_once 'footer.php'?>