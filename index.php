<?php

session_start();


include "function.php";

$koneksi = new mysqli("localhost", "root", "", "db_aplikasisdm");

if ($_SESSION['admin'] || $_SESSION['user']) {



?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Aplikasi SDM</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- Shortcut Icon -->
        <link rel="shortcut icon" href="assets/img/kitty.ico" />
        <!-- datatable -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- css signature -->
        <style>
            #canvasDiv {
                position: right;
                border: 2px dashed grey;
                height: 300px;
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">IMAN</a>
                    <h3 style="color: white; background-color: #A70303" ;> Inventory Management </h3>
                </div>
                <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;">
                    <?php echo date('d-m-Y'); ?> &nbsp; <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <br>
                    <?php echo isset($msg) ? $msg : ''; ?>
                    <h2>HTML5 and PHP Signature Pad</h2>
                    <hr>
                    <div id="canvasDiv"></div>
                    <br>
                    <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
                    <button type="button" class="btn btn-success" id="btn-save">Save</button>
                </div>
            </nav>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <li class="text-center">
                            <img src="assets/img/kitty.ico" class="user-image img-responsive" />
                        </li>

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="?page=anggota"><i class="fa fa-users fa-2x"></i> Data Anggota</a>
                        </li>

                        <li>
                            <a href="?page=barangmasuk"><i class="fa fa-download fa-2x"></i> Barang & Surat Masuk</a>
                        </li>

                        <li>
                            <a href="?page=barangkeluar"><i class="fa fa-upload fa-2x"></i> Barang & Surat Keluar</a>
                        </li>

                        <li>
                            <a href="?page=historibarangmasuk"><i class="fa fa-history fa-2x"></i> Histori Barang & Surat Masuk</a>
                        </li>

                        <li>
                            <a href="?page=historibarangkeluar"><i class="fa fa-history fa-2x"></i> Histori Barang & Surat Keluar</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            $page = isset($_GET['page']) ? $_GET['page'] : '';
                            $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

                            if ($page == "barangmasuk") {
                                if ($aksi == "") {
                                    include "page/barangmasuk/barang.php";
                                } elseif ($aksi == "tambah") {
                                    include "page/barangmasuk/tambah.php";
                                } elseif ($aksi == "serahterima") {
                                    include "page/barangmasuk/serahterima.php";
                                } elseif ($aksi == "hapus") {
                                    include "page/barangmasuk/hapus.php";
                                }
                            } elseif ($page == "historibarangmasuk") {
                                if ($aksi == "") {
                                    include "page/historibarangmasuk/histori.php";
                                } elseif ($aksi == "view") {
                                    include "page/historibarangmasuk/view.php";
                                }
                            } elseif ($page == "barangkeluar") {
                                if ($aksi == "") {
                                    include "page/barangkeluar/barang.php";
                                } elseif ($aksi == "tambah") {
                                    include "page/barangkeluar/tambah.php";
                                } elseif ($aksi == "serahterima") {
                                    include "page/barangkeluar/serahterima.php";
                                } elseif ($aksi == "hapus") {
                                    include "page/barangkeluar/hapus.php";
                                }
                            } elseif ($page == "anggota") {
                                if ($aksi == "") {
                                    include "page/anggota/anggota.php";
                                } elseif ($aksi == "tambah") {
                                    include "page/anggota/tambah.php";
                                } elseif ($aksi == "ubah") {
                                    include "page/anggota/ubah.php";
                                } elseif ($aksi == "hapus") {
                                    include "page/anggota/hapus.php";
                                }
                            } elseif ($page == "historibarangmasuk") {
                                if ($aksi == "") {
                                    include "page/historibarangmasuk/histori.php";
                                }
                            } elseif ($page == "historibarangkeluar") {
                                if ($aksi == "") {
                                    include "page/historibarangkeluar/histori.php";
                                } elseif ($aksi == "view") {
                                    include "page/historibarangmasuk/view.php";
                                }
                            } elseif ($page == "") {

                                include "home.php";
                            }
                            ?>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->



        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable();
            });
        </script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>
        <!-- SCTIPIS SIGNATURE -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

    </body>

    </html>

<?php


} else {
    header("location:login.php");
}

?>