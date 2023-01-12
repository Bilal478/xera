<?php
//Is logined in
function isLogedIn()
{
    //check for login session_code
    if(isset($_SESSION['user_session_code']) && strlen($_SESSION['user_session_code']) == 16)
    {
        $session_code = $_SESSION['user_session_code'];
        return getUserIDFromSessionCode($session_code);
    }
    elseif(array_key_exists('user_session_code', $_COOKIE) && isset($_COOKIE['user_session_code']) && strlen($_COOKIE['user_session_code']) == 16)
    {
          $session_code = $_COOKIE['user_session_code'];
          return getUserIDFromSessionCode($session_code);
    }
    else{ return FALSE; }
}
//Get user ID from session code;
function getUserIDFromSessionCode($session_code)
{
    //Search if session code is on the session database table
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '".mysqli_real_escape_string_x($session_code)."' ") or die(mysqli_error($con));

    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);

    if($count == 1){
        return $row['user_id'];
    }else{ return FALSE; }
}
//Delete user login session data
function deleteSessionData($session_code)
{
    $user_id = getUserIDFromSessionCode($session_code);
    $con = connect_to_maindb();
    $query = mysqli_query($con, "DELETE FROM xb_sessions WHERE
  					 user_id = '".mysqli_real_escape_string_x($user_id)."'") or die(mysqli_error());
}
//Validate user password
function CreateHash($textstr){
  $hash = password_hash($textstr, PASSWORD_DEFAULT);
  return $hash;
}

function CheckHash($hash, $textstr){
	if (password_verify($textstr, $hash)) {
		return TRUE;
		//$res = 'Password is valid!';
	} else {
		return FALSE;
		//$res = 'Invalid password.';
	}
}
