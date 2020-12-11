<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/toggler.css">
</head>
<div class="border-bottom1">
  <div class="collaspe1">
    <div class="name-user">
    <?php if (isset($_SESSION['customer'])) { ?>
    Hello <a href="?controller=customer&action=myprofile"> <b class="name"><?= unserialize($_SESSION['customer'])->name ?></b></a>  

    </div>
  <div class="float-left-1">
    <a href="?controller=customer&action=myprofile">
    <a href="?controller=customer&action=logout" >Logout</a> 
    <a href="?controller=customer&action=myprofile">My profile</a> 
    <a href="?controller=customer&action=myorders">My orders</a>
    <a href="cmt.php">Comment</a> 
    <?php } else { ?>
      <div class="dangnhap">
    <a class= "login"  href="?controller=customer&action=login">Login</a>
    <a class= "signup" href="?controller=customer&action=signup">Sign-up</a>

    </div>
    
    <div class="slidershow middle">
 

<div class="slides">
  <input type="radio" name="r" id="r1" checked>
  <input type="radio" name="r" id="r2">
  <input type="radio" name="r" id="r3">
  <input type="radio" name="r" id="r4">
  <input type="radio" name="r" id="r5">
  <div class="slide s1">
    <img src="assets/img/1.jpg" alt="">
  </div>
  <div class="slide">
    <img src="assets/img/2.jpg" alt="">
  </div>
  <div class="slide">
    <img src="assets/img/3.jpg" alt="">
  </div>
  <div class="slide">
    <img src="assets/img/4.jpg" alt="">
  </div>
  <div class="slide">
    <img src="assets/img/5.jpg" alt="">
  </div>
</div>

<div class="navigation">
  <label for="r1" class="bar"></label>
  <label for="r2" class="bar"></label>
  <label for="r3" class="bar"></label>
  <label for="r4" class="bar"></label>
  <label for="r5" class="bar"></label>
</div>
</div>
    <?php } ?>
  </div>
  <div class="float-right-2">
  <button class="btn3">
    <a href="?controller=customer&action=mycart"><i class="fas fa-shopping-cart"></i></a></button> <b><?= isset($_SESSION['mycart']) ? unserialize($_SESSION['mycart'])->getSize() : 0 ?></b> items
  </div>
  </div>
 
  <div class="float-clear"></div>
  <div class="btn-2">
  <button type="button" class="btn1" id ="navbar-toggler-1">
  <i class="far fa-user"></i>
    </button>
  </div>
 
</div>
<script src = "assets/js/user.js"></script>

