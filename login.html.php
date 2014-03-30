<?php include_once 'includes/helpers.inc.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Log In</title>
	<meta http-equiv="content-type" 
	  content="text/html; charset=utf-8"/>
	</head>
	<body>
     <div class = "well main">	
	  <h1>Log In</h1>
	  <p>Please log in to view the page that you requested.</p>
	  <?php if (isset($loginError)): ?>
	    <p><?php echo htmlout($loginError); ?></p>
		<?php endif;?>
		<form action="" method="post">
		  <div>
		    <label for="email">Email: <input type="text" name="email" id="email"/></label>
		  </div>
		  <div>
		    <label for="password">Password: <input type="password" name="password" id="password"/></label>
		  </div>
		  <div>
		    <input type="hidden" name="action" value="login"/> 
			<input type="submit" value="Log In"/>
		  </div>
		</form>
	  
	  </div>
	</body>
</html>
