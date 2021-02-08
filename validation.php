<?php 

class validation{
    private $errors=[];
    //validate password
    public function setPassword($pass)
    {
        $this->password =$pass;
    }

    public function setConfirmPassword($con)
    {
        $this->confirmPass =$con;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getConfirmPassword()
    {
        return $this->confirmPass;
    }

    function passwordValidation(){

        $password_pattern ='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        
        if (!preg_match($password_pattern,$this->password)) {
           $errors['pattern']='
            <div class="alert alert-danger col-10 mx-auto">
              Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special characte
            </div>';
        }

        if ($this->password!=$this->confirmPass) {
           $errors['confirm']= '
           <div class="alert alert-danger col-10 mx-auto">
             Password confirmation is wrong
           </div>';
        }
        if (isset($errors)) {
            return $errors;
        }
       

    }

    
    //validate email
    
    public function setEmail($email)
    {
        $this->email=$email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function validateEmail() {

        $pattern = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
         if (!preg_match($pattern, $this->email)) {
             
            $errors['email']='
            <div class="alert alert-danger col-10 mx-auto">
              Please Enter valid Email
            </div>';
        }
        
        if (isset($errors['email'])) {
            return $errors['email'];
        }
        
       
    }
}

?>