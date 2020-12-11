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
<body>
  

<div class="border-bottom">
  <div class="float-left">
    <div class="logo">
   <a href="?controller=customer&action=home"><img src="assets/img/car1.png" alt=""></a>
   <div class="sign">
      <span class="fast-flicker">s</span>mca<span class="flicker">r</span>it
    </div>
    </div>
    

  <div class="collaspe">
    <ul class="menu">
      <div class="menu-1">
      <?php if (isset($cates)) { foreach ($cates as $cate) { ?>
      <li class="form"><a href="?controller=customer&action=listproduct&cateid=<?=$cate->id?>"><?=$cate->name?></a></li>
      <?php } } ?>
     
    </div>
    
    </ul>
   
  </div>
  <div class="btn-1">
  <button type="button" class="btn" id ="navbar-toggler">
    <i class="fas fa-bars"></i>
    </button>
  </div>
  

  
 
  </div>
  <div class="float-right">
    <div class="pan">
    <form action="?controller=customer&action=search" method="POST" class="search">
      <input type="search" name="txtKeyword" placeholder="    Enter keyword" class="keyword" required
        oninvalid="this.setCustomValidity('Keyword cannot be empty')"
        oninput="this.setCustomValidity('')" />
      <button class="search_btn"><i class="fas fa-search"></i></button>
    </form>
    </div>
   
  </div>
  <div class="float-clear"></div>
</div>
<script src = "assets/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"> </script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="assets/js/main.js"></script>
</body>