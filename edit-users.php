<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Distance</title>

    <!-- Custom fonts for this template -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">
    <?php include "navbar.php"; ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Users Edit
            </div>
            <div class="card-body">
                <?php include('connection.php'); ?>

                <?php
                $id = $_GET['id'];
                $query = mysqli_query($connect, "SELECT * FROM users WHERE id= '$id'");
                $result = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
                ?>
                <div class="card-body">
                    <form action="edit-users-update.php" method="post" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="id" value="<?= $result['name'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" value="<?= $result['email'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" value="<?= $result['phone'] ?>" class="form-control" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <input type="checkbox" id="ShowPass"> Show Password
                        </div>
                        <div class="form-group">
                            <label>Accses Level</label>
                            <select name="accses_level" id="accses_level" class="form-control" required>
                                <option <?= $result['accses_level'] == 'admin' ? 'selected' : '' ?> value="admin">Admin</option>
                                <option <?= $result['accses_level'] == 'user' ? 'selected' : '' ?> value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Photo</label><br>
                            <input type="hidden" name="old_photo">
                            <input type="file" name="photo" accept="image/*" id="photo" value="<?= $result['photo']; ?>">

                        </div>
                        <div class="form-group text-center" style="margin-bottom:0%;">
                            <img style="width: 30%;border: 0px solid; border: radius 10px;" id="viewer" src="image/<?= $result['photo']; ?>" alt="" />
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="users.php" class="btn btn-danger">Back</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Nur Isnaeni 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }
        $("#photo").change(function() {
            readURL(this);
        });
    </script>

</body>

</html>