<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="?">PDXcoffee</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
			<?php if(!userIsLoggedIn()) { ?>	
           <!--  <button class="btn btn-success"><a class= "login" href="?login">Log In</a></button> -->
			  <?php 
			  }
			  else
              { 
			    $email = $_SESSION['email'];?>
			  
             <!-- 	<button class = "btn-info">Logged in as <?php echo $email;?> -->
				<form class="" action="" method="post"> 
				  <input type="submit" name="action" value="logout"/> 
				</form></button> <?php } ?> 
            </p>
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="main"><!--changing class to main-->
	 

