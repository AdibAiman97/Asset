<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (!empty($_SESSION['UserID']) AND !empty($_SESSION['Password'])) {
    header('location:dashboard.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "layout/head.php"; ?>
<style>
    .form-control {
        border: 1px solid #ececec;
        border-radius: 25px;
        padding: 12px 20px;
    }

    .input-group-text {
        border-radius: 0 25px 25px 0;
    }

    /* Center the logo and reduce its size */
    .logo {
        display: block;
        margin: 0 auto; /* Centers the logo */
        max-width: 40%; /* Adjust this value to make the logo smaller */
        height: auto; /* Maintain aspect ratio */
    }

    /* Style for the header text */
    .header-text {
        text-align: center;
        color: black; /* Change text color to grey */
        font-weight: bold;
        font-size: 35px;
        margin: 10px 0; /* Add some margin */
    }
</style>

<body>
    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">

                    <div class="col-lg-4 mx-auto">

                        <div class="auto-form-wrapper">
                            <img src="images/logo.png" class="logo" alt="logo" />
                            <p class="header-text">ASSET RECORD SYSTEM</p> <!-- Changed class to header-text -->
                            <hr />
                            <?php
                            if (isset($_POST['login'])) {
                                $UserID = $_POST['UserID'];
                                $password = $_POST['password'];

                                $login = mysqli_query($conn, "SELECT * FROM login WHERE UserID = '$UserID' AND Password = '$password' AND Status = 'Active'");
                                $success = mysqli_num_rows($login);
                                $row = mysqli_fetch_array($login);

                                if ($success > 0) {
                                    session_start();

                                    $_SESSION['UserID'] = $row['UserID'];
                                    $_SESSION['Password'] = $row['Password'];
                                    $_SESSION['UserLvl'] = $row['UserLvl'];

                                    echo "<script>window.location = 'dashboard.php';</script>";
                                } else {
                                    echo "<div class='alert alert-danger alert-dismissible'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <strong>Sorry!</strong> Authentication failed.
                                          </div>";
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="form-group">
                                    <label class="label">Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="UserID" placeholder="Username" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" placeholder="*********" required />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-textbox-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" class="btn btn-warning btn-block">Log me in</button>
                                </div>
                                <p class="text-center">
                                    <small>© 2024 <a href="#">STDC</a>. All rights reserved.</small>
                                </p>
                            </form>
                        </div>
                        <br />

                    </div>
                </div>


            </div>
            <!-- content-wrapper ends -->

        </div>
        <!-- page-body-wrapper ends -->

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- SCRIPT -->
    <?php include "layout/script.php"; ?>
</body>

</html>
<?php
}
?>
