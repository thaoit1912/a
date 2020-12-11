<link rel="stylesheet" href="assets/css/homeadmin.css">
<div class="border-bottom">
  <div class="float-left">
  <div class="collaspe1">
    <ul class="menu">
    <div class="float-right">
    Hello <b><?= unserialize($_SESSION['admin'])->username ?></b><a href="?controller=admin&action=logout">&nbsp;||&nbsp;Logout</a>
  </div>
      <li class="menu"><a href="?controller=admin&action=home">Home</a></li>
      <li class="menu"><a href="?controller=admin&action=listcategory">Category</a></li>
      <li class="menu"><a href="?controller=admin&action=listproduct">Product</a></li>
      <li class="menu"><a href="?controller=admin&action=listorder">Order</a></li>
      <li class="menu"><a href="?controller=admin&action=listcustomer">Customer</a></li>
      <li class="menu"><a href="cmt.php">Comment</a></li>
      
      
    </ul>
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