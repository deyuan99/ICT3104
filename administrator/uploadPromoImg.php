<?php

session_start();
include_once '../database/dbconfig.php';
$id = $_POST['id'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

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
                $fileNameNew = "promo" . $id . "." . $fileActualExt;
                $fileDestination = '../images/promoUploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE promotions SET imagePath='images/promoUploads/$fileNameNew' WHERE id='$id';";
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
    }
}