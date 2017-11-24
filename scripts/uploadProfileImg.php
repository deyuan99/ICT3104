<?php

session_start();
include_once '../database/dbconfig.php';
$id = $_SESSION['email'];
$role = $_SESSION['role'];

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
                $fileNameNew = "profile" . $id . "." . $fileActualExt;
                $fileDestination = '../images/uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE users SET profilePicture='images/uploads/$fileNameNew' WHERE email='$id';";
                $result = $conn->prepare($sql);
                $result->execute();
                if($role == 'trainee'){
                     header("Location: ../trainee_dashboard.php?uploadsuccess");
                }
                elseif ($role == 'trainer')
                {
                    header("Location: ../trainer_dashboard.php?uploadsuccess");
                }
               
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