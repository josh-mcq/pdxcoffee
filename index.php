<?php
require_once('includes/initialize.php');
require 'includes/head.html.php';
require 'includes/header.html.php'; 


   //**Addshop form for adding more coffeeshops**
if (isset($_GET['addshop']))
{
require_once('includes/access.inc.php');

if (!userIsLoggedIn())
{
 include 'login.html.php';
 exit();
}

if (!userHasRole('Account Admin'))
{
 $error = 'Only Shop Editors may access this page.';
 include 'accessdenied.html.php';
 exit();
}

if(true)                                                          
{
 include 'includes/addshop.html.php';
 exit();
} 
}

//**Adding Comments to coffee shop page**
 if (isset($_POST['comment']))
{
   $comment=mysql_real_escape_string($_POST['comment'] , $connection);
$shopid=mysql_real_escape_string($_POST['id'] , $connection);
$author=mysql_real_escape_string($_POST['name'] , $connection);
$sql="INSERT INTO description(shopid, descriptionb, author)
VALUES ('$shopid' , '$comment' , '$author')";

if (!mysql_query($sql,$connection))
 {
 die('Error: ' . mysql_error());
 }  
}


//**SHOPPAGE SECTION FOR INDIVIDUAL COFFEE SHOP VIEWING**
 if (isset($_POST['view']))    
{
   $id=mysql_real_escape_string($_POST['id'] , $connection);
$view="SELECT * FROM shops WHERE ID=$id";
    

      $resulta=mysql_query($view, $connection);
 
if(!$resulta)
      { 
       $error='no resultx' . mysql_error();
       include 'includes/error.html.php';
       exit();
      }


 while($raw = mysql_fetch_assoc($resulta))
{

$shopinfo[] = array('name' => $raw['Name'], 'address' => $raw['Address'],'id' => $raw['ID']); 
$shophours[] = array('sunopen' => $raw['sunopen'],'sunclose' => $raw['sunclose'],'monopen' => $raw['monopen'],'monclose' => $raw['monclose'],
     'tueopen' => $raw['tueopen'],'tueclose' => $raw['tueclose'],'wedopen' => $raw['wedopen'],'wedclose' => $raw['wedclose'],
 'thuropen' => $raw['thuropen'],'thurclose' => $raw['thurclose'],'friopen' => $raw['friopen'],'friclose' => $raw['friclose'],
 'satopen' => $raw['satopen'],'satclose' => $raw['satclose'], 'address' => $raw['Address']);
} 

$viewcom=" SELECT descriptionb, author, time
FROM shops INNER JOIN description ON ID = shopid WHERE ID = $id";


$resultc=mysql_query($viewcom, $connection);


{
  if(!$resultc)
      { 
         $error='no resultc' . mysql_error();
         include 'includes/error.html.php';
         exit();
  } 


while($rawcom = mysql_fetch_assoc($resultc))
  {
    $desc[] = array('description' => $rawcom['descriptionb'] , 'author' => $rawcom['author'] , 'time' => $rawcom['time']);
  } 


if(!isset($desc))
{
 $nocomment = "no comments";
 $desc[] = array('description' => $nocomment);
}

include 'includes/shoppage.html.php';
exit();
   }
}
 
 
 // **SEARCH SECTION FOR RESULTS FILTERING**
 if(isset($_POST['search']))
{
 $search = mysql_real_escape_string($_POST['search'] , $connection);

 $sql = "SELECT *
FROM `shops`
WHERE `Name` LIKE '%$search%'
OR `Address` LIKE '%$search%'";
 $result = mysql_query($sql, $connection);
 $results = array();
if(!$result)
 { 
 $error = 'uh oh shit';
 include 'includes/error.html.php';
 exit();
 }

while($row = mysql_fetch_assoc($result))
{

$results[] = array('name' => $row['Name'], 'address' => $row['Address'], 'id' => $row['ID']);


} 
include 'includes/home.html.php';

}  

 
 //**ADD SECTION FOR PROCESSING SHOB SUBMISSIONS**
 if(isset($_POST['coffeeshop']))
{
 $coffeeshop = mysql_real_escape_string($_POST['coffeeshop'] , $connection);
 $location = mysql_real_escape_string($_POST['location'], $connection);
 $sunopentime = mysql_real_escape_string($_POST['sunopentime'], $connection);
 $sunclosetime = mysql_real_escape_string($_POST['sunclosetime'], $connection);
 $monopentime = mysql_real_escape_string($_POST['monopentime'], $connection);
 $monclosetime = mysql_real_escape_string($_POST['monclosetime'], $connection);
 $tueopentime = mysql_real_escape_string($_POST['tueopentime'], $connection);
 $tueclosetime = mysql_real_escape_string($_POST['tueclosetime'], $connection);
 $wedopentime = mysql_real_escape_string($_POST['wedopentime'], $connection);
 $wedclosetime = mysql_real_escape_string($_POST['wedclosetime'], $connection);
 $thuropentime = mysql_real_escape_string($_POST['thuropentime'], $connection);
 $thurclosetime = mysql_real_escape_string($_POST['thurclosetime'], $connection);
 $friopentime = mysql_real_escape_string($_POST['friopentime'], $connection);
 $friclosetime = mysql_real_escape_string($_POST['friclosetime'], $connection);
 $satopentime = mysql_real_escape_string($_POST['satopentime'], $connection);
 $satclosetime = mysql_real_escape_string($_POST['satclosetime'], $connection);
 
 $sql="INSERT INTO shops (name, address, sunopen, sunclose, monopen, monclose, tueopen, tueclose, wedopen, wedclose, thuropen, thurclose, friopen, friclose, satopen, satclose)
VALUES
('$coffeeshop','$location','$sunopentime', '$sunclosetime','$monopentime', '$monclosetime','$tueopentime', '$tueclosetime','$wedopentime', '$wedclosetime','$thuropentime', '$thurclosetime','$friopentime', '$friclosetime','$satopentime', '$satclosetime')";
 
 if (!mysql_query($sql,$connection))
 {
 die('Error: ' . mysql_error());
 }

}

//**HOME SECTION FOR DISPLAYING THE FULL LIST OF SHOPS**
if(isset($_POST['displayall']))
{ 
// 1. write the SQL query
$sql = "SELECT ID, Name, Address FROM shops";

// 2. Query the database
// you could put the query from above directly into the mysql_query function, but this keeps it cleaner
$result = mysql_query($sql, $connection);

// 3. Fetch the results
$results = array();
if(!$result)
{ 
 $error = 'uh oh';
 include 'includes/error.html.php';
 exit();
}
while($row = mysql_fetch_assoc($result))
{
$results[] = array('name' => $row['Name'], 'address' => $row['Address'],'id' => $row['ID']);


} 
include 'includes/home.html.php';  
}	

//  This is for adding user favorites
if(isset($_POST['add-favorite']))
{
$fav_name = mysql_real_escape_string($_POST['fav-name'], $connection);
$fav_shop = mysql_real_escape_string($_POST['fav-shop'], $connection);
$fav_reason = mysql_real_escape_string($_POST['fav-reason'], $connection);
$sql = "INSERT INTO favorites(AUTHOR, SHOPID, REASON) 
VALUES
('$fav_name','$fav_shop','$fav_reason')";
if (!mysql_query($sql,$connection))
 {
 die('Error: ' . mysql_error());
 }
}


// end user favorite section


//**intro section to the page


 $sql = "SELECT ID, Name, Address, sunopen, sunclose, monopen, monclose, tueopen, tueclose, wedopen, wedclose, thuropen, thurclose, friopen, friclose, satopen, satclose  FROM shops ORDER BY Name asc";
 $result1 = mysql_query($sql, $connection);

if(!$result1)
{ 
 $error = 'uh oh';
 include 'includes/error.html.php';
 exit();
}
$sql_hours = "SELECT sunopen, sunclose, monopen, monclose, tueopen, tueclose, wedopen, wedclose, thuropen, thurclose, friopen, friclose, satopen, satclose, Address  FROM shops ORDER BY Name asc";
 $sql_hours_result = mysql_query($sql_hours, $connection);

if(!$sql_hours_result)
{ 
 $error = 'problem with sql_hours_result';
 include 'includes/error.html.php';
 exit();
}



 while($raw = mysql_fetch_assoc($sql_hours_result))
{

//	$shopinfo[] = array('name' => $raw['Name'], 'address' => $raw['Address'],'id' => $raw['ID']); 
$shophours[] = array('sunopen' => $raw['sunopen'],'sunclose' => $raw['sunclose'],'monopen' => $raw['monopen'],'monclose' => $raw['monclose'],
     'tueopen' => $raw['tueopen'],'tueclose' => $raw['tueclose'],'wedopen' => $raw['wedopen'],'wedclose' => $raw['wedclose'],
 'thuropen' => $raw['thuropen'],'thurclose' => $raw['thurclose'],'friopen' => $raw['friopen'],'friclose' => $raw['friclose'],
 'satopen' => $raw['satopen'],'satclose' => $raw['satclose'], 'address' => $raw['Address']);
} 
$sql2 = "SELECT ID, Name, Address FROM shops ORDER BY ID desc LIMIT 4";
 $result_new_listings = mysql_query($sql2, $connection);

if(!$result_new_listings)
{ 
 $error = 'trouble with new lstings';
 include 'includes/error.html.php';
 exit();
}
//**this section is for pulling favorite-shops section of the Intro page. josh says oblique because blah blah**

$sql_fav_shops = "SELECT favorites.id, author, shopid, reason, Name FROM favorites inner join shops ON shopid = shops.ID ORDER BY favorites.id desc LIMIT 2";
 $result2 = mysql_query($sql_fav_shops, $connection);
$resultb = array();
if(!$result2)
{ 
 $error = 'uh oh';
 include 'includes/error.html.php';
 exit();
}
//<?php while ($fav1 = mysql_fetch_array($result2)) 

//{$row_fav_shops[] = array('name' => $fav1['AUTHOR'], 'shopid' => $fav1['shopid'],'reason' => $fav1['reason']);}  
include 'includes/intro.html.php';	
?>
