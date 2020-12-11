<head>
<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>
<body class="customer">
<img class="wave" src="assets/img/car.jpg">
	<div class="container">
		<div class="slogan">
		<h3 contenteditable spellcheck="false">SMART CAR LIKE YOU</h3>
			
		</div>
		<div class="login-content">
			<form form action="?controller=admin&action=login" method="POST">
				<img src="assets/img/car1.png">
				<h2 class="title">LOGIN</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		
           		   		<input type="text" name="txtUsername" required placeholder="Username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    
           		    	<input type="password" name="txtPassword" required placeholder="Password">
                 </div>
                 
              </div>
              <input class='btn' type="submit" name="btnSubmit" value="LOGIN" >
            	
              
            </form>
        </div>
    </div>
  
	
</body>