<?php

if (isset($_POST['create_post'])) {
    var_dump($_POST['create_post']);
    if ($_POST['create_post'] == 'ok') {
        create_post();
        $_POST['create_post'] = 'no';
        var_dump($_POST['create_post']);
    }
}

function create_post()
{
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '" . mysqli_real_escape_string_x($_COOKIE['user_session_code']) . "' ") or die(mysqli_error($con));

    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];

    // File upload configuration 
    $targetDir = "upload/";
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    $fileNames = array_filter($_FILES['files']['name']);
    if (!empty($fileNames)) {
        foreach ($_FILES['files']['name'] as $key => $val) {
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]);
            $fileName = rand(1000, 99999) . $fileName;
            // exit;
            $targetFilePath = $targetDir . $fileName;

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server 
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql 
                    $insertValuesSQL .= "('" . $user_id . "','" . $_POST['title'] . "','" . $fileName . "', NOW()),";
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
            }
        }


        $insertValuesSQL = trim($insertValuesSQL, ',');

        // Insert image file name into database 
        $insert = mysqli_query($con, "INSERT INTO xb_posts (user_id,title,picture, created_At) VALUES $insertValuesSQL");
    }
}

function get_posts()
{
    $con = connect_to_maindb();
    return $query = mysqli_query($con, "SELECT * FROM xb_posts ORDER BY id DESC");
}
if (isset($_POST['key'])) {
    if ($_POST['key'] == 'store_likes') {
        store_likes();
    }
}
function store_likes()
{
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '" . mysqli_real_escape_string_x($_COOKIE['user_session_code']) . "' ") or die(mysqli_error($con));

    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    // $postid = mysqli_query($con, "SELECT id FROM xb_posts WHERE user_id = '$user_id'");
    // $row = mysqli_fetch_assoc($postid);
    // $post_id = $row['id'];
    if(isset($_POST['action'])){
      $post_id=$_POST['post_id'];
      $action=$_POST['action'];
      switch($action){
        case 'like':
            $sql="INSERT INTO xb_likes (user_id,post_id) VALUES ($user_id,$post_id)";
        break;
        case 'unlike':
            $sql="DELETE FROM xb_likes WHERE user_id=$user_id AND post_id=$post_id";
        break;
      }
      mysqli_query($con,$sql);
      exit(0);
    }
  
    // $query1 = mysqli_query($con, "INSERT INTO xb_likes (user_id,post_id) VALUES ($user_id,$post_id)");
}
function get_likes()
{
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
    session_id = '" . mysqli_real_escape_string_x($_COOKIE['user_session_code']) . "' ") or die(mysqli_error($con));

$row = mysqli_fetch_assoc($query);
$user_id = $row['user_id'];
$postid = mysqli_query($con, "SELECT id FROM xb_posts WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($postid);
$post_id = $row['id'];
    // var_dump( mysqli_query($con, "SELECT * FROM xb_likes"));
    $query1 = mysqli_query($con, "SELECT * FROM xb_likes where post_id = '$post_id'");
    $count=mysqli_num_rows($query1);
    return $count;
    
}
