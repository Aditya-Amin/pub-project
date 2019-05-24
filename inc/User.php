<?php

   include_once 'Session.php';
   include 'Database.php';

   class User{
       private $db;

       public function __construct(){
           $this->db = new Database();
       }

       public function userRegister($arr){
           $name  = $arr->userName;
           $email = $arr->userEmail;
           $pass  = $arr->userPass;
           $confirmPass = $arr->userConfirmPass;
           $chkUserName = $this->checkUserName($name);
           $chkUserEmail = $this->checkUserEmail($email);

           if( $name == '' || $email == '' || $pass == '' || $confirmPass == ''){
               $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Field Must Not Be Empty!</span>";
               return $errMsg; 
           }
           if($chkUserName == true){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Username Already Exist!</span>";
                return $errMsg; 
           }
           if( strlen($name) < 3){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Username 3 characters Need!</span>";
                return $errMsg; 
           }
           if($chkUserEmail == true){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Email Already Exist!</span>";
                return $errMsg; 
            }
           if( !preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',$email)){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Invalid Email!</span>";
                return $errMsg; 
           }
           if( $pass != $confirmPass){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Password not match!</span>";
                return $errMsg;
           }
           $pass = md5($confirmPass);
           $insert = "INSERT INTO pub_users(username, useremail,userpass) VALUES(:name,:email,:pass)";

           $query = $this->db->pdo->prepare($insert);
           $query->bindValue(':name', $name);
           $query->bindValue(':email', $email);
           $query->bindValue(':pass', $pass);
           $result = $query->execute();
           if($result){
               $errMsg =  "<span class='alert alert-success'><strong>Success:</strong>Registration Successfull.</span>";
               return $errMsg;
           }else{
               $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Can't Register Now.</span>";
               return $errMsg;
           }

       }

       public function checkUserName($name){
           $userName = "SELECT username FROM pub_users WHERE username = :name";
           $query =  $this->db->pdo->prepare($userName);
           $query->bindValue(':name', $name);
           $query->execute();
           if( $query->rowCount() > 0){
               return true;
           }else{
               return false;
           }
       }

       public function checkUserEmail($email){
            $useremail= "SELECT useremail FROM pub_users WHERE useremail = :email";
            $query =  $this->db->pdo->prepare($useremail);
            $query->bindValue(':email', $email);
            $query->execute();
            if( $query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
      }

      public function userLogin($arr){
            $email = $arr['userlogEmail'];
            $pass  = $arr['userlogPass'];
            $md5    = md5($pass);
            $chkUserEmail = $this->checkUserEmail($email);
            $chkUserPass  = $this->checkUserPass($md5);
           

            if($email == '' || $pass == ''){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Field Must Not Be Empty!</span>";
                return $errMsg; 
            }
            if($chkUserEmail == false){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Wrong Email!</span>";
                return $errMsg; 
            }
            if($chkUserPass == false){
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>Wrong password!</span>";
                return $errMsg; 
            }
          
            $userLogin = $this->getUserLogin($email,$md5);
            if($userLogin){
                Session::init();
                Session::set('login',true);
                Session::set('id', $userLogin->id);
                Session::set('name', $userLogin->username);
                Session::set('email', $userLogin->useremail);
                header("Location:profile.php"); 
            }else{
                $errMsg =  "<span class='alert alert-danger'><strong>Error:</strong>login can't possible!</span>";
                return $errMsg; 
            }

            
      }

      public function checkUserPass($pass){
            $userPass = "SELECT userpass FROM pub_users WHERE userpass = :pass";
            $query =  $this->db->pdo->prepare($userPass);
            $query->bindValue(':pass', $pass);
            $query->execute();
            if( $query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
      }

      public function getUserLogin($email,$pass){
          $select = "SELECT * FROM pub_users WHERE useremail = :email AND userpass = :pass LIMIT 1";
          $query = $this->db->pdo->prepare($select);
          $query->bindValue(':email', $email);
          $query->bindValue(':pass', $pass);
          $query->execute();
          $result = $query->fetch(PDO::FETCH_OBJ);
          return $result;
      }
   }
?>