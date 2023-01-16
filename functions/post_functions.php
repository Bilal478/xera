<?php

if (isset($_POST['create_post'])) {
    var_dump($_POST['create_post']);
    if ($_POST['create_post'] == 'ok') {
        create_post();
        $_POST['create_post'] = 'no';
        var_dump($_POST['create_post']);
    }
}

if (isset($_POST['key'])) {
    if ($_POST['key'] == 'store_likes') {
        store_likes();
    }
    if ($_POST['key'] == 'store_comments') {
        store_comments();
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
    $posts = array();
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT * FROM xb_posts ORDER BY id DESC");
    while ($row = $query->fetch_assoc()) {
        $comments = mysqli_query($con, "SELECT * FROM xb_comments where post_id='".$row['id']."' ORDER BY id DESC");
        $likes = mysqli_query($con, "SELECT * FROM xb_likes where post_id='".$row['id']."'");
        $userQuery = mysqli_query($con, "SELECT first_name, last_name FROM xb_users where id='".$row['user_id']."'");
        $user = mysqli_fetch_assoc($userQuery);
        $row['comments'] = $comments;
        $row['likes'] = $likes->num_rows;
        $row['user'] = $user;
        $posts[] = $row;
    }
   
    return $posts;
}

function store_likes()
{
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '" . mysqli_real_escape_string_x($_COOKIE['user_session_code']) . "' ") or die(mysqli_error($con));

    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    $post_id=$_POST['post_id'];
    
    
    $sql=mysqli_query($con, "SELECT * FROM xb_likes where user_id = $user_id AND post_id = $post_id");
    if($sql->num_rows>0){
        mysqli_query($con, "DELETE FROM xb_likes WHERE user_id=$user_id AND post_id=$post_id");
        $likes = mysqli_query($con, "SELECT * FROM xb_likes where post_id = $post_id");
        echo $likes->num_rows;
        exit;
    }
    else{
        mysqli_query($con, "INSERT INTO xb_likes (user_id,post_id) VALUES ($user_id,$post_id)");
        
        $likes = mysqli_query($con, "SELECT * FROM xb_likes where post_id = $post_id");
        echo $likes->num_rows;
        exit;
    }
    
}

function store_comments()
{
  
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '" . mysqli_real_escape_string_x($_COOKIE['user_session_code']) . "' ") or die(mysqli_error($con));

    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $sql="INSERT INTO xb_comments (post_id,user_id,comment,created_at) VALUES ('$post_id','$user_id','$comment',now())";
    mysqli_query($con,$sql);
    $comments = mysqli_query($con, "SELECT * FROM xb_comments where post_id = $post_id ORDER BY id DESC");
    $likes = mysqli_query($con, "SELECT * FROM xb_likes where post_id='".$post_id."'");
    $extra = '<div class="flex space-x-4 lg:font-bold">
    <a href="#" class="flex items-center space-x-2" onclick="return false;">
        <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600" onclick="like('.$post_id.')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
            </svg>
        </div>
        <span id="count'.$post_id.'">'.$likes->num_rows.'</span>
        <div id="like" class="like-btn" data-id="'.$post_id.'">Like</div>
    </a>
    <a href="#" class="flex items-center space-x-2">
        <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
            </svg>
        </div>
        <span>'.$comments->num_rows.'</span>
        <div> Comment</div>
    </a>
</div>';
    $extra2 = '';
    while ($row = $comments->fetch_assoc()) {

      $extra2.=('<div class="border-t py-4 space-y-4 dark:border-gray-600">
            <div class="flex">
                <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                    <img src="assets/images/avatars/avatar-1.jpg" alt="" class="absolute h-full rounded-full w-full">
                </div>
                <div>
                    <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 relative lg:ml-5 ml-2 lg:mr-12  dark:bg-gray-800 dark:text-gray-100">
                    <p class="leading-6"><b>Bilal Rasool</b> </p>    
                    <p class="leading-6">'.$row["comment"].'</p>
                        <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                    </div>
                    
                </div>
            </div>
        </div>');
    }
    echo $extra.=$extra2;
   exit;
}
