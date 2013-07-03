<div id= "wrap">
 <div class="main-content"><!--nothing here-->
 </div>
   <div class="container-fluid">
<div class="">
</div><!--noclass-->
    <div class="row-fluid well--header">
   <div class="accordion span4" id="accordion2">
     <?php while($row = mysql_fetch_assoc($result1)) {?>
 <div class="accordion-group">
   <div class="accordion-heading">
     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="<?php echo '#collapse' . $row['ID'];?>">
   <?php echo $row['Name'];?>
 </a>
   </div>
   <div id="<?php echo 'collapse' . $row['ID'];?>" class="accordion-body collapse">
     <div class="accordion-inner">
   <p>
 <?php echo $row['Address'];?>
</p>
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
 <td>Thurday:</td><td><?php echo $row['thuropen'] . "-" . $row['thurclose'];?></td>
</tr>
<tr>
 <td>Friday:</td><td><?php echo $row['friopen'] . "-" . $row['friclose'];?></td>
</tr>
<tr>
 <td>Saturday:</td><td><?php echo $row['satopen'] . "-" . $row['satclose'];?></td>
</tr>
</table>

 

 </div>
</div>
 </div><?php }?>
 

</div><!-- accordion -->


<div class="span4">
<h3>New Listings</h3>
  
  <table class="dataTable">
 <thead>
   <tr class="alt">
     <th scope="col">Shop Name</th>
 <th scope="col">Location</th>
</tr>
<tbody>
 <?php while($row2 = mysql_fetch_assoc($result_new_listings)) {?> </td>
   <tr>
     <td><?php echo $row2['Name'];?></td>
                 <td><?php echo $row2['Address'];?></td>
</tr>

<?php }?>
</tbody>
 </table>
 <h3 class="middle">From Twitter</h3>
         <a class="twitter-timeline" href="https://twitter.com/PDXCoffee1" data-widget-id="323515371921481729">Tweets by @PDXCoffee1</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

   </div><!--span4-->  
       
 <?php
$sql = "SELECT Name, Address, ID  FROM shops ORDER BY Name ASC";
$result = mysql_query($sql, $connection);
$results = array();
if(!$result)
{ 
 $error = 'uh oh';http://localhost/recurrence/index.php?#collapse1
 include 'includes/error.html.php';
 exit();
}?>
  <?php while ($fav1 = mysql_fetch_assoc($result)) {
$results[] = array('name' => $fav1['Name'], 'address' => $fav1['Address'],'id' => $fav1['ID']);}?>

 <div class="span4">
<!--this is my latest reviews section -->

<h2 class="right">Latest Reviews</h2>
              <article class="quotes">
                <h3>Anna Bannana's</h3>
                <p>This place is great!  The staff are friendly, and the drinks are great.  It's a quaint little place for shizzle! <span class="reviewer">Katrina L.</span></p>
              </article>
  <article class="quotes">
                <h3>Urban Grind</h3>
                <p>Very hipster-chic indeed!  I love the Pearl District;-) <span class="reviewer">Bobby Deez.</span></p>
              </article>
  <p><a class="btn" href="#">Leave a review &raquo;</a></p>

<!-- end latest reviews-->
<!-- leave a review form below -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
 <label for="fav-name">my name is..</label>
 <input type="text" name="fav-name" id="fav-name" />
 <label for="fav-shop" class="favorite-form">favorite shop..</label>
 <select  id="small" name="fav-shop">
<?php foreach($results as $shop):?>	
<option value='<?php echo $shop['id'];?>'>
 <?php echo $shop['name'];?>
</option> 
<?php endforeach ?>
 </select>
 <br /> 
 <label for="fav-reason">it's my favorite because..</label>
 <textarea rows="10" cols=30" name="fav-reason" id="fav_reason"></textarea>
 <br />
 <input type="submit" name="add-favorite" value="Submit!" /> 
</form>
 </div><!--span4-->
</div><!--row-fluid-->
 </div><!--container-fluid-->
</div> <!--wrap-->
</body>
</html>
