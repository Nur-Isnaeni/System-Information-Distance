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
    <div class="container">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Cari Routes</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
                <a href="add-routes.php" class="btn btn-primary">Add Routes</a>
            </div> -->
            <div class="card-body">
                <form action="cari-routes.php" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">

                                <label for="">From</label>
                                <select name="rute_start" id="rute_start" class="form-control" required>
                                    <option disabled selected value="">Choose One!</option>
                                    <?php
                                    include 'connection.php';
                                    $query = mysqli_query($connect, 'SELECT DISTINCT(s.district_name), s.id FROM route r JOIN street s ON s.id = r.street_id');
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['district_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">To</label>
                                <select name="rute_finish" id="rute_finish" class="form-control" required>
                                    <option disabled selected value="">Choose One!</option>
                                    <?php
                                    include 'connection.php';
                                    $query = mysqli_query($connect, 'SELECT * FROM route');
                                    while ($data = mysqli_fetch_array($query)) { ?>
                                        <option value="<?= $data['district_address'] ?>"><?= $data['district'] ?> - <?= $data['district_address'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12" style="margin-top:30px">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="cari-routes.php" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <?php
                    if ($_SESSION['accses_level'] == 'admin') : ?>
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 100px !important;">Route Start</th>
                                    <th>Route Finish</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "connection.php";
                                // $sql = 'SELECT r.id,r.district,r.district_address,s.district_name,s.address,r.price
                                // FROM route r
                                // JOIN street s
                                // ON r.street_id = s.id';


                                if (isset($_GET['rute_start']) || isset($_GET['rute_finish'])) {
                                    // if (isset($_GET['rute_start'])) {
                                    //     $rute_start = $_GET['rute_start'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start'");
                                    // } elseif (isset($_GET['rute_finish'])) {
                                    //     $rute_finish = $_GET['rute_finish'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE id='$rute_finish'");
                                    // } elseif ($_GET['rute_start'] && $_GET['rute_finish']) {
                                    //     $rute_start = $_GET['rute_start'];
                                    //     $rute_finish = $_GET['rute_finish'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start' AND district_address='$rute_finish'");
                                    // }
                                    $rute_start = $_GET['rute_start'];
                                    $rute_finish = $_GET['rute_finish'];
                                    $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start' AND district_address='$rute_finish'");
                                } else {
                                    $query = mysqli_query($connect, 'SELECT * FROM route');
                                }

                                $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $nomor = 1;
                                foreach ($results as $data) {
                                ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <?php
                                        if ($data['street_id']) {
                                            $street_id = $data['street_id'];
                                            $query2 = mysqli_query($connect, "SELECT * FROM street WHERE id='$street_id'");
                                            $results2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
                                            foreach ($results2 as $data2) { ?>
                                                <td><?= $data2['district_name'] ?> <?= $data2['address'] ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                        <td><?= $data['district'] ?> - <?= $data['district_address'] ?></td>
                                        <td>Rp. <?= number_format($data['price'], 0, ",", ".") ?></td>
                                        <td style="padding: 5px !important;">

                                            <a href="edit-routes.php?id=<?php echo $data['id'] ?>" class="btn btn-warning btn-sm "> <span class="fas fa-fw fa-pen"></span></a>
                                            <a href="delete-routes.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Are You Sure ?')" class="btn btn-danger btn-sm "><span class="fas fa-fw fa-trash"></a>


                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    <?php endif; ?>
                    <?php if ($_SESSION['accses_level'] == 'users') : ?>
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th style="width: 100px !important;">Route Start</th>
                                    <th>Route Finish</th>
                                    <th>Price</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "connection.php";
                                // $sql = 'SELECT r.id,r.district,r.district_address,s.district_name,s.address,r.price
                                // FROM route r
                                // JOIN street s
                                // ON r.street_id = s.id';


                                if (isset($_GET['rute_start']) || isset($_GET['rute_finish'])) {
                                    // if (isset($_GET['rute_start'])) {
                                    //     $rute_start = $_GET['rute_start'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start'");
                                    // } elseif (isset($_GET['rute_finish'])) {
                                    //     $rute_finish = $_GET['rute_finish'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE id='$rute_finish'");
                                    // } elseif ($_GET['rute_start'] && $_GET['rute_finish']) {
                                    //     $rute_start = $_GET['rute_start'];
                                    //     $rute_finish = $_GET['rute_finish'];
                                    //     $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start' AND district_address='$rute_finish'");
                                    // }
                                    $rute_start = $_GET['rute_start'];
                                    $rute_finish = $_GET['rute_finish'];
                                    $query = mysqli_query($connect, "SELECT * FROM route WHERE street_id='$rute_start' AND district_address='$rute_finish'");
                                } else {
                                    $query = mysqli_query($connect, 'SELECT * FROM route');
                                }

                                $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $nomor = 1;
                                foreach ($results as $data) {
                                ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <?php
                                        if ($data['street_id']) {
                                            $street_id = $data['street_id'];
                                            $query2 = mysqli_query($connect, "SELECT * FROM street WHERE id='$street_id'");
                                            $results2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
                                            foreach ($results2 as $data2) { ?>
                                                <td><?= $data2['district_name'] ?> <?= $data2['address'] ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                        <td><?= $data['district'] ?> - <?= $data['district_address'] ?></td>
                                        <td>Rp. <?= number_format($data['price'], 0, ",", ".") ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
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
    <script>
        $(document).ready(function() {
            $('#rute_start').select2();
            $('#rute_finish').select2();
        });
    </script>
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

</body>

</html>