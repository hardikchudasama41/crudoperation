<!DOCTYPE HTML>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Edit Operation In PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body>

    <?php

    session_start();
    include('dbconfigure.php');

    ?>

    <br>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">

                <?php

                include('dbconfigure.php');
                if (isset($_POST['data_edit'])) {
                    $id = $_POST['edit_id'];
                    $query = "SELECT * FROM user WHERE id = '$id'";
                    $query_run = mysqli_query($con, $query);

                    foreach ($query_run as $row) {
                ?>

                        <form action="code.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="edited_id" value="<?php echo $row['id'] ?>">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" value="<?php echo $row['password'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Update Image</label>
                                <input type="file" name="image" value="<?php echo $row['image'] ?>" class="form-control">
                            </div>

                            <div class="modal-footer">
                                <a href="index.php"><button type="button" class="btn btn-secondary">CLOSE</button></a>
                                <button type="submit" name="update" class="btn btn-primary">UPDATE</button>
                            </div>

                        </form>

                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
    </div>

</body>

</html>