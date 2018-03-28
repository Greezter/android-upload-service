<?php
 
require_once 'include/db_connection.php';
 
global $connection;
$upload_path = 'uploads/'; //this is our upload folder
$server_ip = gethostbyname(gethostname()); //Getting the server ip
$upload_url = '<a class="vglnk" href="http://'.$server_ip.'/android_upload/'.$upload_path" rel="nofollow"><span>http</span><span>://'.$</span><span>server</span><span>_</span><span>ip</span><span>.'/</span><span>android</span><span>_</span><span>upload</span><span>/'.$</span><span>upload</span><span>_</span><span>path</span></a>; //upload url
 
//response array
$response = array();
 
 
if($_SERVER['REQUEST_METHOD']=='POST'){
 
    //checking the required parameters from the request
    if(isset($_POST['caption']))
    {
         
        $caption = $_POST['caption'];
        $fileinfo = pathinfo($_FILES['image']['name']);//getting file info from the request
        $extension = $fileinfo['extension']; //getting the file extension
        $file_url = $upload_url . getFileName() . '.' . $extension; //file url to store in the database
        $file_path = $upload_path . getFileName() . '.'. $extension; //file path to upload in the server
        $img_name = getFileName() . '.'. $extension; //file name to store in the database
 
        try{
            move_uploaded_file($_FILES['image']['tmp_name'],$file_path); //saving the file to the uploads folder;
           
            //adding the path and name to database
            $sql = "INSERT INTO photos(photo_name, photo_url, caption) ";
            $sql .= "VALUES ('{$img_name}', '{$file_url}', '{$caption}');";
             
            if(<a href="#">mysql</a>i_query($connection,$sql)){
                //filling response array with values
                $response['error'] = false;
                $response['photo_name'] = $img_name;
                $response['photo_url'] = $file_url;
                $response['caption'] = $caption;
            }
            //if some error occurred
        }catch(Exception $e){
            $response['error']=true;
            $response['message']=$e->getMessage();
        }
        //displaying the response
        echo json_encode($response);
 
        //closing the connection
        <a href="#">mysql</a>i_close($connection);
    }else{
        $response['error'] = true;
        $response['message']='Please choose a file';
    }
}
 
/*
We are generating the file name
so this method will return a file name for the image to be uploaded
*/
function getFileName(){
    global $connection;
     
    $sql = "SELECT max(id) as id FROM photos";
    $result = <a href="#">mysql</a>i_fetch_array(<a href="#">mysql</a>i_query($connection, $sql));
 
    if($result['id']== null)
        return 1;
    else
        return ++$result['id'];
     
    <a href="#">mysql</a>i_close($connection);
}
?>