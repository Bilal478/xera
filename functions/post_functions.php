<?php 

if(isset($_POST['create_post']))
{ 
    var_dump($_POST['create_post']);
      if($_POST['create_post'] == 'ok'){
    create_post();
    $_POST['create_post'] = 'no';
    var_dump($_POST['create_post']);
}
  
}

function create_post(){
    $con = connect_to_maindb();
    $query = mysqli_query($con, "SELECT user_id FROM xb_sessions WHERE
             session_id = '".mysqli_real_escape_string_x($_COOKIE['user_session_code'])."' ") or die(mysqli_error($con));

    $count = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    $user_id = $row['user_id'];
    
    // File upload configuration 
    $targetDir = "upload/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
        
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $fileName = rand(1000,99999).$fileName;
            // exit;
            $targetFilePath = $targetDir . $fileName; 
                
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$user_id."','".$_POST['title']."','".$fileName."', NOW()),"; 
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
             
         
        $insertValuesSQL = trim($insertValuesSQL, ','); 
        
        // Insert image file name into database 
        $insert = mysqli_query($con,"INSERT INTO xb_posts (user_id,title,picture, created_At) VALUES $insertValuesSQL"); 
              
            
        }
}

function get_posts(){
    $con = connect_to_maindb();
    return $query = mysqli_query($con,"SELECT * FROM xb_posts ORDER BY id DESC");
   
}