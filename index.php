<?php
require_once('includes/initialize.php');
require 'includes/head.html.php';
require_once('includes/access.inc.php');
require 'includes/header.html.php'; 

//**Logic for Displaying Addshop form**
if (isset($_GET['addshop']))
{  
  if (!userIsLoggedIn())
  {
    include 'includes/login.html.php';
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

//**Logic for login form** 
if (isset($_GET['login']))
{
  if (!userIsLoggedIn())
  {
    include 'includes/login.html.php';
    exit();
  }
  if (!userHasRole('Account Admin'))
  {
    $error = 'Only Shop Editors may access this page.';
    include 'accessdenied.html.php';
    exit();
  }
}

// **SEARCH SECTION FOR RESULTS FILTERING**
if(isset($_POST['search']))
{
  $sql = "SELECT *
   	 FROM `shops`
		 WHERE `Name` LIKE '%:search %'
		 OR `Address` LIKE '%:search%'";
  $result = $db_conn->prepare($sql);
  $result->bindValue(':search', $_POST['search']);
  $result->execute();
  $results = array();
  if(!$result)
  { 
    $error = 'uh oh shit';
    include 'includes/error.html.php';
    exit();
  }
  while($row = $result->fetch())
  {
	$results[] = array('name' => $row['Name'], 'address' => $row['Address'], 'id' => $row['ID']);
  } 
  include 'includes/home.html.php';
}  
 
//**ADD SECTION FOR PROCESSING SHOB SUBMISSIONS**
if(isset($_POST['coffeeshop'])) 
{
  
    $coffeeshop = $_POST['coffeeshop'];
    $location = $_POST['location'];
    $sunopentime = $_POST['opentime'];
    $sunclosetime = $_POST['closetime'];
    $monopentime = $_POST['opentime'];
    $monclosetime = $_POST['closetime'];
    $tueopentime = $_POST['opentime'];
    $tueclosetime = $_POST['closetime'];
    $wedopentime = $_POST['opentime'];
    $wedclosetime = $_POST['closetime'];
    $thuropentime = $_POST['opentime'];
    $thurclosetime = $_POST['closetime'];
    $friopentime = $_POST['opentime'];
    $friclosetime = $_POST['closetime'];
    $satopentime = $_POST['opentime'];
    $satclosetime = $_POST['closetime'];
    $sql="INSERT INTO shops (name, address, sunopen, sunclose, monopen, monclose, tueopen, tueclose, wedopen, wedclose, thuropen, thurclose, friopen, friclose, satopen, satclose)
         VALUES
         ('$coffeeshop','$location','$sunopentime', '$sunclosetime','$monopentime', '$monclosetime','$tueopentime', '$tueclosetime','$wedopentime', '$wedclosetime','$thuropentime', '$thurclosetime','$friopentime', '$friclosetime','$satopentime', '$satclosetime')";
    $stmt = $db_conn->prepare($sql);
    $stmt->execute(); 
  
}

//**HOME SECTION FOR DISPLAYING THE FULL LIST OF SHOPS**
if(isset($_POST['displayall']))
{ 
	// 1. write the SQL query
	$sql = "SELECT ID, Name, Address FROM shops";
	
	// 2. Query the database
	// you could put the query from above directly into the mysql_query function, but this keeps it cleaner
	$result= $db_conn->prepare($sql);
	$result->execute();
	
	// 3. Fetch the results
	$results = array();
	if(!$result)
{ 
  $error = 'uh oh';
  include 'includes/error.html.php';
  exit();
}
	while($row = $result->fetch())
	{
		 $results[] = array('name' => $row['Name'], 'address' => $row['Address'],'id' => $row['ID']);
	
	
	} 
	include 'includes/home.html.php';  
}	

//  This is for adding user favorites
if(isset($_POST['add-favorite']))
{
$fav_name = $_POST['fav-name'];
$fav_shop = $_POST['fav-shop'];
$fav_comment = $_POST['fav-comment'];
$sql = "INSERT INTO comments(author, shopid, comment) 
VALUES
('$fav_name','$fav_shop','$fav_comment')";
$result_add_comment = $db_conn->prepare($sql);
$result_add_comment->execute();
if (!$result_add_comment)
  {
  die('Error: ' . mysql_error());
  }
}


// end user favorite section


//**intro section to the page

//**Accordion **//
  $sql = "SELECT ID, Name, Address, sunopen, sunclose, monopen, monclose, tueopen, tueclose, wedopen, wedclose, thuropen, thurclose, friopen, friclose, satopen, satclose  FROM shops ORDER BY Name asc";
  $result1 = $db_conn->prepare($sql);
	$result1->execute();
	if(!$result1)
{ 
  $error = 'uh oh';
  include 'includes/error.html.php';
  exit();
}
//**end here.  intro.html.php will fetch the associative arrays and print out in a while loop.**//

//**New Listings Section**//
	$sql2 = "SELECT ID, Name, Address FROM shops ORDER BY ID desc LIMIT 2";
 try {
 $result_new_listings = $db_conn->prepare($sql2);
 $result_new_listings->execute();
	
	} catch (PDOException $e) {
echo "A database problem has occurred: " . $e->getMessage();
}
	 /*if(!$result_new_listings)
{ 
  $error = 'trouble with new lstings';
  include 'includes/error.html.php';
  exit();
} */  


//**End New Listings**//
//**Comments**

 $sql3 = "SELECT commentid, shopid, comment, Author, Name FROM comments inner join shops ON shopid = shops.ID ORDER BY commentid desc LIMIT 2";
  $result_comments = $db_conn->prepare($sql3);
  $result_comments->execute();
	if(!$result_comments)
{ 
  $error = 'no result_comments';
  include 'includes/error.html.php';
  exit();
}
//**Select Form**//
$sql4 = "SELECT ID, Name FROM shops ORDER BY Name asc";
  $result_select = $db_conn->prepare($sql4);
  $result_select->execute();
	
	if(!$result_select)
{ 
  $error = 'uh oh';
  include 'includes/error.html.php';
  exit();
  }
//**End Comments**//
//**	  
include 'includes/intro.html.php';	
?>
