<?php
if(isset($_SESSION['user_session_code'])){
  //Delete previous session login data
  deleteSessionData($_SESSION['user_session_code']);
  //Unset every previous logged in session related variables
  unset($_SESSION['user_session_code']);
}
if(isset($_COOKIE['user_session_code'])){
  //Delete previous session login data
  deleteSessionData($_COOKIE['user_session_code']);
  //Unset every previous logged in cookie related variables
  unset($_COOKIE['user_session_code']);
  setcookie('user_session_code', '', time() - 3600, '/'); // empty value and old timestamp
}

//Check if login form has been submitted
if(isset($_POST['login_form']))
{
    $email = htmlspecialchars(stripslashes(strip_tags(trim($_POST['email']))));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars(stripslashes(strip_tags(trim($_POST['pass']))));
    $user_entered_password = $password;
		$email = strtolower($email);

    if (strlen($email) >= 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $error[] = "Please enter a valid email address"; }
    if(strlen($password) < 6 || strlen($password) > 50){ $error[] = "Please enter a valid password"; }

    if(!isset($error))
    {
        $con = connect_to_maindb();
        $query = mysqli_query($con, "SELECT * FROM xb_users WHERE
                 email = '".mysqli_real_escape_string_x($email)."' LIMIT 1") or die(mysqli_error());

        $row = mysqli_fetch_assoc($query);
        $count_row = mysqli_num_rows($query);

        if(mysqli_num_rows($query) == 1)
        {
            $hash_pass = $row['password'];
            if(CheckHash($hash_pass, $user_entered_password))
            {
                $time_now = $time_created = time();
                $platform = getUserAgent();
                $ip_address = getIpAddress();
                $user_id = $row['id'];
                $session_data = random_string('alnum', 16);
                $_SESSION['user_session_code'] = $session_data;
                //Set cookie
                $expire = $time_now + (60*60*24*30); //1 month.
                setcookie('user_session_code', $session_data, $expire);

                $query = mysqli_query($con, "INSERT INTO xb_sessions
                      (user_id, session_id, platform, ip_address, time_created)
                      VALUES('".mysqli_real_escape_string_x($user_id)."',
                      '".mysqli_real_escape_string_x($session_data)."',
                      '".mysqli_real_escape_string_x($platform)."',
                      '".mysqli_real_escape_string_x($ip_address)."',
                      '".mysqli_real_escape_string_x($time_created)."')")
                      or die(mysqli_error($con));

                  if(isset($_SESSION['last_link'])){
                      $last_link_url = $_SESSION['last_link'];
                      header("location: $last_link_url");
                  }else{
                      if(!isset($dashboard_url)){ $dashboard_url = $address_path; }
                      header("location: $dashboard_url");
                  }

            }else{ $error[] = "Invalid login details! Please check email and password 1"; }
        }else{ $error[] = "Invalid login details! Please check email and password 2"; }
    }
}
