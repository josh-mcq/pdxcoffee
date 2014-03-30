<html>
<body>
  <div id="hours">   <!-- HOURS SECTION -->
    
	
	<?php foreach ($shophours as $hours): ?>	
	<table>
     <tr>
	    <th>Hours:</th>
		</tr>
		
		<tr>
		  <td>Sunday:</td><td><?php echo $hours['sunopen'] . "-" . $hours['sunclose'];?></td>
		</tr>
		<tr>
		  <td>Monday:</td><td><?php echo $hours['monopen'] . "-" . $hours['monclose'];?></td>
		</tr>
		<tr>
		  <td>Tuesday:</td><td><?php echo $hours['tueopen'] . "-" . $hours['tueclose'];?></td>
		</tr>
		<tr>
		  <td>Wednesday:</td><td><?php echo $hours['wedopen'] . "-" . $hours['wedclose'];?></td>
		</tr>
		<tr>
		  <td>Thurday:</td><td><?php echo $hours['thuropen'] . "-" . $hours['thurclose'];?></td>
		</tr>
		<tr>
		  <td>Friday:</td><td><?php echo $hours['friopen'] . "-" . $hours['friclose'];?></td>
		</tr>
		<tr>
		  <td>Saturday:</td><td><?php echo $hours['satopen'] . "-" . $hours['satclose'];?></td>
		</tr>
		</table>
		<h6><?php echo "Location:    " . htmlspecialchars($hours['address'], ENT_QUOTES, 'UTF-8');?> </h6>
		<?php endforeach; ?>
		
		
		</div><div id = "shopname">
       <?php foreach($shopinfo as $resultz): ?>
   <h1 id = "whatshop"> <?php echo htmlspecialchars($resultz['name'], ENT_QUOTES, 'UTF-8')?></h1> 
  	<?php endforeach; ?>
   <br/>
    <a href="?">Go Home</a>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/coffeejoint/test.html'; ?> <!--nothing currently in this file-->
  </div><!--id:shopname-->
  <hr />
 <div id = 'pics'>
<img src="images/coffee_beans.jpg"/>
</div>
 <?php foreach($desc as $descript): ?>
 <blockquote id="comments"><?php echo $descript['description']; ?></blockquote> 
 <?php endforeach; ?>
  
</body></html> 
