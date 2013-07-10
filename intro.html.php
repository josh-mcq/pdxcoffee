 
 
<div id= "wrap">
  <div class="main-content"><!--nothing here-->
  </div>
  <div class="container-fluid">
    <div class="row-fluid well--header">
<!--full width section--> 
	  <div class="span12 well">
	    <h1>Welcome To PDX Coffee</h1>
	    <span class="hero">Won't you sit down and stay awhile?</span>
	  </div><!--span12-->
	</div>
	<div class="row-fluid well--header">
<!-- Shop Listings Column 1 -->	  
	  <div class="accordion span4 well" id="accordion2">
	  <h3>Places to have a cup..</h3>
	     <?php try 
		 {
		   while($row = $result1->fetch(PDO::FETCH_ASSOC)) {?>
		     <div class="accordion-group">
		       <div class="accordion-heading">
		         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="<?php echo '#collapse' . $row['ID'];?>">
			       <?php echo $row['Name'];?>
			     </a>
		       </div>
		       <div id="<?php echo 'collapse' . $row['ID'];?>" class="accordion-body collapse">
		         <div class="accordion-inner">
			        <table>
				     <tr>
					  <th>Hours:</th>
					 </tr>
					 <tr>
					   <td>Sunday:</td><td><?php echo $row['sunopen'] . "-" . $row['sunclose'];?></td>
				 	 </tr>
					 <tr>
					   <td>Monday:</td><td><?php echo $row['monopen'] . "-" . $row['monclose'];?></td>
			 	 	 </tr>
					 <tr>
					   <td>Tuesday:</td><td><?php echo $row['tueopen'] . "-" . $row['tueclose'];?></td>
					 </tr>
					 <tr>
					   <td>Wednesday:</td><td><?php echo $row['wedopen'] . "-" . $row['wedclose'];?></td>
					 </tr>
					 <tr>
					   <td>Thursday:</td><td><?php echo $row['thuropen'] . "-" . $row['thurclose'];?></td>
					 </tr>
					 <tr>
					   <td>Friday:</td><td><?php echo $row['friopen'] . "-" . $row['friclose'];?></td>
					 </tr>
					 <tr>
					   <td>Saturday:</td><td><?php echo $row['satopen'] . "-" . $row['satclose'];?></td>
					 </tr>
					 <tr>
					   <td class="address"><?php echo $row['Address'];?></td>
					 </tr>
					 </table>
			       </div>
			     </div>
		      </div><?php } }
		   catch (PDOException $e) {
             echo "a database problem has occured: " . $e->getMessage();
         }?>
	   </div><!-- accordion -->
<!-- - Latest Reviews Column Column 2 -->	   
	 	   <div class = "span4">
	   <div class="well">
		<h3 class="right">Latest Reviews</h3>
        <?php while ($reviews = $result_comments->fetch()) { ?>
	      <article class="shopreviews">
            <h4 class = "h4-review"><?php echo $reviews['Name'];?></h4>
            <p class="review"><?php echo $reviews['comment'];?><span class="reviewer"> -<?php echo $reviews['Author'];?></span></p>
          </article>
		<?php }?>
		</div><!--well-->	
<!-- leave a review form below -->
		<div class="well">
		<h3>Add A Review</h3>
		<form class="review-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
		  <label class="review-form__label" for="fav-shop" class="favorite-form">Coffeeshop name</label>
		  <select  id="small" name="fav-shop">
			<?php while ($shop = $result_select->fetch()) {?>	
			<option value='<?php echo $shop['ID'];?>'>
			<?php echo $shop['Name'];?>
			</option> 
			<?php } ?>
		  </select>
		  <br /> 
		  <label class="review-form__label" for="fav-reason">Comment</label>
		  <textarea rows="10" cols=30" name="fav-comment" id="fav-comment"></textarea>
			
		  <label class="review-form__label" for="fav-name">Name</label>
		  <input type="text" name="fav-name" id="fav-name" />
		  <input type="submit" name="add-favorite" value="Submit!" /> 
		</form>
		</div><!--well-->
	  </div>  
        	
<!--New Listings Section 3 -->
	<div class="span4">
			 <div class="well" >
			 <h3>New Listings</h3>
			 <table class="dataTable">
			   <thead>
				<tr class="alt">
				 <th scope="col">Shop Name</th>
				 <th scope="col">Location</th>
				</tr>
				<tbody> 
				<?php while($row2 = $result_new_listings->fetch()) {?> </td>
				  <tr>
					<td><?php echo $row2['Name'];?></td>
					<td><?php echo $row2['Address'];?></td>
				  </tr>
				<?php }?>
			   </tbody>
			 </table>
			 </div><!--" "-->
			 <div class="well">
			 <h3>Add New Shop</h3>
			 <form action = "?" method = "post">
				<input type = "hidden" id = "id" name = "id" Value = "id" />  <!--this should be type=hidden-->
				<label for="coffeeshop">Name</label><input type = "text" id = "coffeeshop" name = "coffeeshop"/>
				<label for= "location">Street Address</label><input type = "text" id = "location" name = "location"/>
				<label for = "city">City, State</label><input type = "text" id = "city" name = "city" placeholder = "Portland, OR"/>
				<label for ="opentime">Open Time</label>
				<select id= "opentime" name= "opentime">
				  <option value="4:00am">4:00am</option>
				  <option value="4:30am">4:30am</option>
				  <option value="5:00am">5:00am</option>
				  <option value="5:30am">5:30am</option>
				  <option value="6:00am">6:00am</option>
				  <option value="6:30am">6:30am</option>
				  <option value="7:00am">7:00am</option>
				  <option value="7:30am">7:30am</option>
				  <option value="8:00am">8:00am</option>
				  <option value="8:30am">8:30am</option>
				  <option value="9:00am">9:00am</option>
				  <option value="9:30am">9:30am</option>
				</select>
				  
				<label for ="closetime">Open Time</label>
				<select id= "closetime" name= "closetime">
				  <option value="4:00pm">4:00pm</option>
				  <option value="4:30pm">4:30pm</option>
				  <option value="5:00pm">5:00pm</option>
				  <option value="5:30pm">5:30pm</option>
				  <option value="6:00pm">6:00pm</option>
				  <option value="6:30pm">6:30pm</option>
				  <option value="7:00pm">7:00pm</option>
				  <option value="7:30pm">7:30pm</option>
				  <option value="8:00pm">8:00pm</option>
				  <option value="8:30pm">8:30pm</option>
				  <option value="9:00pm">9:00pm</option>
				  <option value="9:30pm">9:30pm</option>
				  <option value="10:00pm">10:00pm</option>
				  <option value="10:30pm">10:30pm</option>
				  <option value="11:00pm">11:00pm</option>
				  <option value="11:30pm">11:30pm</option>
				  <option value="12:00am">12:00am</option>
				  <option value="12:30am">12:30am</option>
				  <option value="1:00am">1:00am</option>
				  <option value="1:30am">1:30am</option>
				  <option value="2:00am">2:00am</option>
				  <option value="2:30am">2:30am</option>
				</select>
				<input type ="submit" value = "submit" />
			 </form>
			 </div><!--well add new shop"-->
		   </div><!--span4-->	
	  </div><!--row-fluid-->
  </div><!--container-fluid-->
</div> <!--wrap-->
<div class = "well credit pull-right">Website by: <a href="http://www.joshmcquiston.com">Josh McQuiston</a></div>
</body>
</html>
