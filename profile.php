<?php
      include 'inc/User.php';
      Session::init();
      if(isset($_GET['action']) && $_GET['action'] == 'logout'){
        Session::destroy();
        Session::set('login',false);
      }
     
     $log  = Session::get('login');
     if( $log === false){
        header("Location:index.php");
     }
     

     $user = new User();    
     $name = Session::get('name');
     $email = Session::get('email');
     $ID = Session::get('id');

     $courses = $user->getAllCourse();
     $userInfos = $user->getuserInfo($ID);
  
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome.all.min.css">

  <link rel="stylesheet" href="css/profile.css">
  <title>Online Course Timeline</title>
</head>

<body>

  <div class="jumbotron jumbotron-fluid jumbo-background">
    <div class="container">
      <h1>The People's University of Bangladesh</h1>
      <h3>Online Course Timeline</h3>
    </div>
    <?php if($userInfos){?>
    <?php foreach($userInfos as $userInfo){?>
    <div class="card">
      <div class="front">

      </div>

      <div class="back">
        <div class="info">
          <h2><?php if(isset($name)){ echo $name; } ?></h2>
          <p id="designation"><?php echo $userInfo['designation'];?></p>
          <button type="button" id="edit">Edit</button>
        </div>
      </div>

      <div class="profile-img">
        <div class="up-img">
          <img src="uploads/<?php echo $userInfo['pro_img'];?>" height="400px" width="300px" alt="">
        </div>
        <div class="up-prof">
          <input type="file" name="file" id="file">
          <i class="fas fa-camera"></i>
        </div>
      </div>
      <p id="showErr"></p>
    </div>
    <?php }?>
    <?php }?>

  </div>


  <div class="headlines">
    <h1>Running Course :</h1>
  </div>


  <div class="containers">

    <div class="post">
      <i class="fas fa-book-reader boi"></i>
      <h1>CREATE COURSE</h1>
      <div class="post-s class=" btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"">
        <i class=" fas fa-plus-circle"id="create-new"></i>
      </div>
    </div>


    <?php if($courses){?>
    <?php $count = 1;?>
    <?php foreach($courses as $course){?>
    <div class="box">
      <div class="icon"><?php echo $count++;?></div>
      <div class="content">
        <h3><?php echo $course['course_code'];?></h3>
        <p>Course name: <?php echo $course['course_title'];?></p>
        <a href="course-page.php?courseid=<?php echo $course['id'];?>">Read More</a>
      </div>
    </div>
    <?php }?>
    <?php }?>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="error"></p>
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Course Code:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Course Title:</label>
              <input type="text" class="form-control" id="recipient-title">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="create" class="btn btn-primary">Create</button>
        </div>
      </div>
    </div>
  </div>




  <footer class="section bg-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="">
            <h6 class="footer-heading text-uppercase text-white">Information</h6>
            <ul class="list-unstyled footer-link mt-4">
              <li><a href="">Baul Aditya</a></li>
              <li><a href="">Kacci sumon</a></li>
              <li><a href="">Shukna Naime</a></li>
              <li><a href="">Tanvir The Real Hero</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="">
            <h6 class="footer-heading text-uppercase text-white">Ressources</h6>
            <ul class="list-unstyled footer-link mt-4">
              <li><a href="">Baul Aditya</a></li>
              <li><a href="">Kacci sumon</a></li>
              <li><a href="">Shukna Naime</a></li>
              <li><a href="">Tanvir The Real Hero</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="">
            <h6 class="footer-heading text-uppercase text-white">Help</h6>
            <ul class="list-unstyled footer-link mt-4">
              <li><a href="">Baul Aditya</a></li>
              <li><a href="">Kacci sumon</a></li>
              <li><a href="">Shukna Naime</a></li>
              <li><a href="">Tanvir The Real Hero</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="">
            <h6 class="footer-heading text-uppercase text-white">Contact Us</h6>
            <p class="contact-info mt-4">Contact us if need help withanything</p>
            <p class="contact-info">+01 123-456-7890</p>
            <div class="mt-5">
              <ul class="list-inline">
                <li class="list-inline-item"><a href="#"><i
                      class="fab facebook footer-social-icon fa-facebook-f"></i></i></a></li>
                <li class="list-inline-item"><a href="#"><i
                      class="fab twitter footer-social-icon fa-twitter"></i></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab google footer-social-icon fa-google"></i></i></a>
                </li>
                <li class="list-inline-item"><a href="#"><i class="fab apple footer-social-icon fa-apple"></i></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="text-center mt-5">
      <p class="footer-alt mb-0 f-14">2019 © Tanvir, all rights reserved</p>
    </div>
  </footer>
  <a id="logout" href="?action=logout" data-toggle="tooltip" title="Want to logout?!"><img width="100%" height="100%"
      src="images/shutdown.png" alt="shutdown"></a>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ajax.functions.js"></script>
  <script src="js/ajax.request.js"></script>
  <script src="js/main.js"></script>
</body>

</html>