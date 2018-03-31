<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=Upload;charset=utf8", "root", "");
    } catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด : " . $e->getMessage();
    }
$target_dir = "Upload/image";
$image = $_POST["image"];

if(!file_exists($target_dir)){
    mkdir($target_dir,0777,true);
}

$target_dir = $target_dir ."/" . rand() ."_" . time() . ".jpeg";
if(file_put_contents($target_dir,base64_decode($image))){
    echo json_encode([
        "Message" => "The file has been uploaded.",
        "Status" => "OK"
    ]);
}else{
    echo json_encode([
        "Message" => "Sorry, there was an error uploading your file." ,
        "Status" => "Error"
        ]);
}
?>