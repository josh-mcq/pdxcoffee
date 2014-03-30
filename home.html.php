<!--deleted body and html openinging tags-->
<div class="container-fluid">
  <div class="row-fluid well--header">
    <div class="mainhome">
      <div class="span3" ><!--id="search"--take out-->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          Search: <input type="text" name="search" value="quadrant, name, street" /><input type="submit" value="Submit" /> 
        </form>
      </div>
      <div class="span3">
        <ul>     
	      <?php foreach($results as $resultz): ?>
          <!-- need the below line to reload control page, and include shoppage while pulling relevant data from DB.-->
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		    <li>
			  <?php echo htmlspecialchars($resultz['name'], ENT_QUOTES, 'UTF-8') . '--- ' .  htmlspecialchars($resultz['address'], ENT_QUOTES, 'UTF-8'); ?> 
	          <input type="hidden" name="id" value="<?php echo htmlspecialchars($resultz['id'], ENT_QUOTES, 'UTF-8');?>"/>
	          <input type="submit" name="view" value="view"/> 

		    </li>
          </form>	
	      <?php endforeach; ?>
        </ul>
	  </div><!--span3-->
	  <div class="span3">
        <a href="?addshop">Add New Shop</a>
        <p>
		  <a href="?">Return to CoffeeJoint Home</a>
		</p>
        <div id="displayall">
          <form acton="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="displayall" value = "Display all shops!" />
          </form> 
        </div>
      </div>
	</div><!--mainhome-->
  </div><!--row-fluid-->
</div><!--container-fluid-->
</body>
</html>
  <?php
    exit();
  ?>
