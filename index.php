<?php
     include 'inc/User.php';
    Session::init();
    if(isset($_GET['action']) && $_GET['action'] == 'logout'){
      Session::destroy();
      Session::set('login',false);
    } 

    $user = new User();
    $getUsers = $user->getAllUser();
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Online Course Timeline</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>


  <div class="jumbotron jumbotron-fluid jumbo-background">
    <div class="container">

      <h1>WELCOME TO PUB</h1>
      <h3>Online Course Timeline</h3>
      <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      <a href="log-reg.php">
        <div class="get-started">

          <span></span>
          <span></span>
          <span></span>
          <span></span>
          GET STARTED
        </div>
      </a>
    </div>
  </div>


  <div class="containers">
  <?php if($getUsers){?>
  <?php foreach($getUsers as $users){?>
    <div class="box">
    <?php if($users['pro_img'] == ""){?>
      <div class="icon"><i class="fas fa-user-circle"></i></div>
    <?php } else{?>
    <div class="icon"><img class="w-50 img-fluid img-thumbnail rounded-circle" src="uploads/<?php echo $users['pro_img']; ?>" alt="<?php echo $users['pro_img']; ?>"></div>
    <?php }?>
      <div class="content">
        <h3><?php echo $users['username']; ?></h3>
        <p><?php echo $users['designation']; ?></p>
        <a href="profile.php?id=<?php echo $users['id']; ?>">See Details</a>
      </div>
    </div>
    <?php }?>
    <?php }?>
  </div>


  <section class="about">
    <div class="about-box">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <div class="about-content">
        <h1>About PUB</h1>
        <p>
          It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search
        </p>
      </div>
    </div>

  </section>




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
                <li class="list-inline-item"><a href="#"><i class="fab facebook footer-social-icon fa-facebook-f"></i></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab twitter footer-social-icon fa-twitter"></i></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab google footer-social-icon fa-google"></i></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fab apple footer-social-icon fa-apple"></i></i></a></li>
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
  <?php 

       $userLogin = Session::get('login');
       if($userLogin === true){
  ?>

    <a id="logout" href="?action=logout" data-toggle="tooltip" title="Want to logout?!"><img width="100%" height="100%" src="images/shutdown.png" alt="shutdown"></a>
    <a class="profile-img" href="profile.php" data-toggle="tooltip" title="go to profile">
      <img src="images/profile.jpg" height="100%" width="100%" alt="">
    </a>

  <?php }?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
