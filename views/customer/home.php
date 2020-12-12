<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMCARIT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/home.css">

    <script
	src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Karla&display=swap"
	rel="stylesheet">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>
<body>
  <div class="container">

  <?php require_once('views/layouts/customer_menu.php') ?>
  <?php require_once('views/layouts/customer_inform.php') ?>
  <svg viewBox="0 0 960 300">
	<symbol id="s-text">
		<text text-anchor="middle" x="50%" y="80%">MonsterCar</text>
	</symbol>

	<g class = "g-ants">
		<use xlink:href="#s-text" class="text-copy"></use>
		<use xlink:href="#s-text" class="text-copy"></use>
		<use xlink:href="#s-text" class="text-copy"></use>
		<use xlink:href="#s-text" class="text-copy"></use>
		<use xlink:href="#s-text" class="text-copy"></use>
	</g>
</svg>
  
  </div>
  <div class="align-center">
    <h2 class="text-center">PRODUCTS</h2>
    <?php foreach ($newprods as $prod) { ?>
    <div class="line">
      <figure>
        <a href="?controller=customer&action=details&id=<?=$prod->id?>"><img src="data:image/jpg;base64,<?=$prod->image?>" /></a>
        <figcaption class="text-center"><?=$prod->name?><br />Price: <?=$prod->price?>000$</figcaption>
      </figure>
    </div>
    <?php } ?>
  </div>
  <?php if ($hotprods) { ?>
  <div class="align-center">
    <h2 class="text-center">HOT PRODUCTS</h2>
    <?php foreach ($hotprods as $prod) { ?>
    <div class="inline">
      <figure>
        <a href="?controller=customer&action=details&id=<?=$prod->id?>"><img src="data:image/jpg;base64,<?=$prod->image?>" width="300px" height="300px" /></a>
        <figcaption class="text-center"><?=$prod->name?><br />Price: <?=$prod->price?>00$</figcaption>
      </figure>
    </div>
    <?php } ?>
  </div>
  <?php } ?>
  </div>

  <div class="bk">
    <div class="about">
  </div>
    <div class="type_bk">
   <p>Mercedes-Benz – “The best or nothing”</p> 
   <p>Audi – “Vorprung durch Technik”</p>
   <p>BMW – “The ultimate machine”</p>
  <p>Porsche – “Origin of speed”</p>
  <p>Lamborghini – “We are not supercars. We are Lamborghini”</p>
  <a href="?controller=customer&action=home"><i class="fas fa-car"></i></a>
  </div>
  </div>
    </div>
  
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7920748506513!2d106.70110461474442!3d10.8272180612149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175288ad78aea3d%3A0x832872254782586d!2zxJDhuqFpIGjhu41jIFbEg24gTGFuZyBjxqEgc-G7nyAz!5e0!3m2!1svi!2s!4v1607654869019!5m2!1svi!2s" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>  


<div class="footer">
  <div id="button"></div>
<div id="container">
<div id="cont">
<div class="footer_center">
<ul>
    <li><a href="https://www.facebook.com/bathao.nguyen.505/">Facebook</a></li>
    <li></li>
    <li><a href="">Twitter</a></li>
    <li></li>&nbsp;
    <li></li>
    <li><a href="">Phone</a></li>
    <li></li>
    <li><a href="">Github</a></li>
    <li>
    </li>
  </ul>
</div>
</div>
</div>



</body>

</html>
