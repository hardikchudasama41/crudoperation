<?php
session_start();
include('dbconfigure.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $password = $_POST['password'];
    $image = $_FILES['image']['name'];

    if (file_exists("upload/" . $_FILES["image"]["name"])) {
        $store = $_FILES["image"]["name"];
        $_SESSION['status'] = "Image already exists... '.$store.'";
        header('Location: index.php');
    } else {
        $query = "INSERT INTO user (firstname, lastname, password, image) VALUES ('$fname','$lname','$password','$image')";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES['image']['name']);
            $_SESSION['success'] = "Data inserted successfully...";
            header("Location: index.php");
        } else {
            $_SESSION['success'] = "Data not inserted...";
            header("Location: index.php");
        }
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['edited_id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $password = $_POST['password'];
    $image = $_FILES["image"]['name'];

    $data_query = "SELECT * FROM user WHERE id='$id'";
    $data_query_run = mysqli_query($con, $data_query);

    foreach ($data_query_run as $fa_row) {
        if ($image == NULL) {
            $image_data = $fa_row['image'];
        } else {
            if ($img_path = "upload/" . $fa_row['image']) {
                unlink($img_path);
                $image_data = $image;
            }
        }
    }
    $query = "UPDATE user SET firstname='$fname', lastname='$lname', password='$password', image='$image' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if ($image == NULL) {
            $_SESSION['success'] = "Updated With exising image...";
            header('Location: index.php');
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES['image']['name']);
            $_SESSION['success'] = "Data Updated...";
            header('Location: index.php');
        }
    }
}

if (isset($_POST['data_delete'])) {
    $id = $_POST['delete_id'];
    $query = "DELETE FROM user WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['success'] = "Data Deleted...";
        header('Location: index.php');
    } else {
        $_SESSION['success'] = "Data not Deleted...";
        header('Location: index.php');
    }
}
