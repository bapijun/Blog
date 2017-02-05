<?php
  require_once('connectvars.php');

  function check_password($password) {
  	
  	if(strlen($password) < 6 || strlen($password) >20) { // password is too short or long
  		return 0;
  	}
  	
  	if (preg_match("/^\d+$/", $password)) {// The password is completely numeric
  		return 0;
  	}

  	if (preg_match("/^[A-Za-z\s]+/" ,$password)) {//The password is completely alphabetic
  		return 0;
  	}
    //esle
  	return 1;//The password is safe

  }

  function check_email($email) {
    if (preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
      return 1;
    }
    else {
      return 0;
    }
  }

  function check_telepone($telephone){
   
    if(preg_match("/^d{11}$/", $telephone)) {
      return 1;
    }
    else  {
      return 0;
    }
  }

  if (!isset($_POST['submit'])) {
  	  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
  		$user_email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  		$user_phone = mysqli_real_escape_string($dbc, trim($_POST['telephone']));

  		if (empty($user_username) || empty($user_password) || empty ($user_email) || empty($user_phone)) {//check 
  				$error_msg = 'Sorry, your have fill something.';
        	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/sign_up.html';
          echo '<script type="text/javascript">alert("' . $error_msg  . '");location.href="' . $home_url . '"</script>';
          exit;//exit

  		}

  		//check the username is repeated
  		$query = "SELECT user_id, username FROM blog_user WHERE username = '$user_username'";
      $data = mysqli_query($dbc, $query);

      if (mysqli_num_rows($data) != 0) {// found username was repeaded 
       		$error_msg = 'Sorry, your username is repeated.Try to change another name.';
        	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/sign_up.html';
          // header('Location: ' . $home_url);
           echo '<script type="text/javascript">alert("' . $error_msg  . '");location.href="' . $home_url . '"</script>';
           exit;
      }

      if(!check_password($user_password)) {
       		$error_msg = 'Sorry, your password is easy.Try to change another password.';
        	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/sign_up.html';
          // header('Location: ' . $home_url);
           echo '<script type="text/javascript">alert("' . $error_msg  . '");location.href="' . $home_url . '"</script>';
           exit;
      }

      if(!check_email($user_email)) {
          $error_msg = 'Sorry, error email format.Try to check email.';
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/sign_up.html';
          // header('Location: ' . $home_url);
           echo '<script type="text/javascript">alert("' . $error_msg  . '");location.href="' . $home_url . '"</script>';
           exit;
      }

      if(!check_telepone($user_phone)) {
          $error_msg = 'Sorry, error telephone format.Try to check your telephone number.';
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/sign_up.html';
          // header('Location: ' . $home_url);
           echo '<script type="text/javascript">alert("' . $error_msg  . '");location.href="' . $home_url . '"</script>';
           exit;
      }

      $user_firstname = ""; $user_lastname = ""; $user_city = ""; $user_country = "";
      $user_gender = ""; $user_picture = "";

      if (!isset($firstname)) {
       		$user_firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
       }
      if(!isset($lastname)) {
       		$user_lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
       }
      if(!isset($city)) {
       		$user_city = mysqli_real_escape_string($dbc, trim($_POST['city']));
       }
      if(!isset($country)) {
       		$user_country = mysqli_real_escape_string($dbc, trim($_POST['country']));
       }
      if(!isset($gender)) {
       		$user_gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
       }
      if(!isset($picture)) {
       		$user_picture = mysqli_real_escape_string($dbc, trim($_POST['picture']));
       }


      $query = "INSERT INTO blog_user (username, password, join_date, first_name, last_name, country, city, gender, picture) VALUES ('$user_username', SHA('$user_password'), NOW(), '$user_firstname', '$user_lastname', '$user_country', '$user_city', '$user_gender', '$user_picture')";
      echo $query;

      if(!mysqli_query($dbc, $query)) {
      	//Fill the log
      		$error_msg = 'Something wrong' . mysql_errno();
        	echo '<script type="text/javascript"> alert("' . $error_msg . '")</script>';
          exit;
      }

  }

?>