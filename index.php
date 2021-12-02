<!DOCTYPE HTML>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>CRUD Operation In PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <link rel="icon" href="https://icon-library.com/images/customer-icon/customer-icon-23.jpg">

    <script type="text/javascript">
        function dataformcheck() {
            var txt1 = document.forms["dataform"]["firstname"].value;
            var txt2 = document.forms["dataform"]["lastname"].value;
            var txt3 = document.forms["dataform"]["password"].value;
            var txt4 = document.forms["dataform"]["confirmpassword"].value;
            var file = document.forms["dataform"]["image"].value;
            if (txt1 == "") {
                alert("Please enter firstname...");
                return false;
            }
            if (txt2 == "") {
                alert("Please enter lastname...");
                return false;
            }
            if (txt3 == "") {
                alert("Please enter password...");
                return false;
            }
            if (txt4 == "") {
                alert("Please re-enter password...");
                return false;
            }
            if (txt3 !== txt4) {
                alert("Password not match...");
                return false;
            }
            if (file == "") {
                alert("Please select file...");
                return false;
            }
        }
    </script>

</head>

<body>

    <?php
    session_start();
    include('dbconfigure.php');
    error_reporting(0);
    ?>

    <br>
    <div class="modal fade" id="demo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Database Operation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST" enctype="multipart/form-data" id="dataform" onsubmit="return dataformcheck()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter First Name..."></label>
                        </div>
                        <div class="form-group">
                            <label>Last Name<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter Last Name..."></label>
                        </div>
                        <div class="form-group">
                            <label>Password<input type="password" name="password" class="form-control" id="password" placeholder="Enter Password..."></label>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password<input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Re-enter Password..."></label>
                        </div>
                        <div class="form-group">
                            <label>Upload Image<input type="file" name="image" id="image" class="form-control"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <?php

        if (isset($_SESSION['success']) && isset($_SESSION['success']) != '') {
            echo '<h2 class="bg-primary text-white">' . $_SESSION['success'] . '</h2>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            echo '<h2 class="bg-danger text-white">' . $_SESSION['success'] . '</h2>';
            unset($_SESSION['success']);
        }

        ?>
        <div class="card" style="width: 100%; height: 55px;">
            <h1 align="center">Database Operations</h1>
        </div><br>
        <h1 class="d-flex justify-content-center">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#demo">
                Add Data
            </button>
        </h1>
    </div>
    <br>
    <h1 class="container-fluid">All Records</h1>
    <div class="table-responsive">

        <?php

        //session_start();
        include('dbconfigure.php');
        $query = "SELECT * FROM user";
        $query_run = mysqli_query($con, $query);

        ?>

        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Password</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {

                ?>
                        <tr>
                            <td> <?php echo $row['id'] ?> </td>
                            <td> <?php echo $row['firstname'] ?> </td>
                            <td> <?php echo $row['lastname'] ?> </td>
                            <td> <?php echo $row['password'] ?> </td>
                            <td> <?php echo '<img src="upload/' . $row['image'] . '" width=100px;height=100px;">' ?></td>
                            <td>

                                <form action="edit.php" method="POST">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" name="data_edit" class="btn btn-info">EDIT</button>
                                </form>

                            </td>
                            <td>

                                <form action="code.php" method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="data_delete" class="btn btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>

                <?php
                    }
                } else {
                    echo '<h6 class="container-fluid" style="color:blue;">No record found...</h6>';
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>