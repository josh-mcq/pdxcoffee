<?php
  function userIsLoggedIn()
  {
    if (isset($_POST['action']) and $_POST['action'] == 'login')
    {
      if (!isset($_POST['email']) or $_POST['email'] == '' or !isset($_POST['password']) or $_POST['password'] == '')
      {
        $GLOBALS['loginError'] = 'Please fill in both fields';
   	    return FALSE;
      }
      $password = md5 ($_POST['password'] . '3456_1');
      if(databaseContainsAuthor($_POST['email'], $password))
      {
        session_start();
  	    $_SESSION['loggedIn'] = TRUE;
	    $_SESSION['email'] = $_POST['email'];
	    $_SESSION['password'] = $password;
	    return TRUE;
      }
      else
      {
        session_start();
	    unset($_SESSION['loggedIn']);
	    unset($_SESSION['loggedIn']);
	    unset($_SESSION['loggedIn']);
	    $GLOBALS['loginError'] = 'The specified email address or password was incorrect.';
	    return FALSE;
      } 
    }
    else if (isset($_POST['action']) and $_POST['action'] == 'logout')
    {
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['loggedIn']);
      unset($_SESSION['loggedIn']);
      header('Location: ' .  $_SERVER['PHP_SELF']);
      exit();
    } 
    session_start();
    if (isset($_SESSION['loggedIn']))
    {
      $loginemail = $_SESSION['email'];
      return databaseContainsAuthor($_SESSION['email'], $_SESSION['password']);
    }
  }

  function databaseContainsAuthor($email, $password)
  {
  	include 'connection.php';
	try
	{ 
	  $sql = 'SELECT COUNT(*) FROM users WHERE user = :email AND password = :password';
	  $s = $db_conn->prepare($sql);
	  $s->bindValue(':email', $email);
	  $s->bindValue(':password', $password);
	  $s->execute();
	}
	catch (PDOException $e)
	{
	  $error = 'Sorry, error finding you.';
	  include 'error.html.php';
	  exit();
	}
	$row =  $s->fetch();
	if ($row[0] >0)
    {
	  return True;
	  echo "true";
    }
	  else
    {
	  return FALSE;
	  echo "false";
	}
  }
  function userHasRole($role)
  {
  include 'connection.php';
  $email = $_SESSION['email'];
  $sql = "SELECT COUNT(*) FROM users
		  INNER JOIN userrole ON users.id = userid
		  INNER JOIN role ON roleid = role.id
		  WHERE user = '$email' AND role.id = '$role'";
  
  $result = $db_conn->prepare($sql);
  $result->execute();
  if (!$result)
  {
    $error = 'Error searching for author roles.';
    include 'error.html.php';
    exit();
  }
  $row = $result->fetch();
  if($row[0] > 0)
  {
    return TRUE;
  }
  else
  {
    return FALSE;
  }
  }
