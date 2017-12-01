<?php

require('../database/dbconfig.php');

/*
 * id, title, description, startDate, endDate, imagePath, featuredStatus
 */

$id = $_POST['edit_id'];

$sql = "SELECT * FROM promotions WHERE id = '$id'";
$req = $conn->prepare($sql);
$req->execute();
$rows = $req->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        //$id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        $imagePath = $row['imagePath'];
        $featuredStatus = $row['featuredStatus'];

    endforeach;
}
else {
    echo "No promotions found";
}


//$firstName = $_POST['firstName'];
//$lastName = $_POST['lastName'];
//$address = $_POST['address'];
//$mobile = $_POST['mobile'];
$title = empty($_POST['title']) ? $title : $_POST['title'];
$description = empty($_POST['description']) ? $description : $_POST['description'];
$startDate = empty($_POST['startDate']) ? $startDate : $_POST['startDate'];
$endDate = empty($_POST['endDate']) ? $endDate : $_POST['endDate'];
$imagePath = empty($_POST['imagePath']) ? $imagePath : "images/promoUploads/" . $_POST['imagePath'];
$featuredStatus = empty($_POST['featuredStatus']) ? $featuredStatus : $_POST['featuredStatus'];

 if ($_POST['featuredStatus'] == 0){
    $featuredStatus = 0;
}
else {
    $featuredStatus = $_POST['featuredStatus'];
}
//upload image
/*$file = $_FILES['file'];

$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));

$allowed = array('jpg', 'jpeg', 'png', 'pdf');

if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
        if ($fileSize < 1000000) {
            $fileNameNew = "profile" . $id . "." . $fileActualExt;
            $fileDestination = '../images/uploads/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
            $sql = "UPDATE users SET profilePicture='images/uploads/$fileNameNew' WHERE email='$id';";
            $result = $conn->prepare($sql);
            $result->execute();
            header("Location: ../trainee_dashboard.php?uploadsuccess");
        } else {
            echo "Your file is too big!";
        }
    } else {
        echo "There was an error uploading your file!";
    }
} else {
    echo "You cannot upload files of this type!";
}*/


$sql = "UPDATE promotions SET title = '$title', description = '$description', startDate ='$startDate', endDate = '$endDate', imagePath = '$imagePath', featuredStatus='$featuredStatus' WHERE id = '$id'";
$req = $conn->prepare($sql);
$req->execute();

header('Location: promo-management.php');
exit();
?>
