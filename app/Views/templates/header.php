<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= esc($title) ?></title>
    <link href="<?= base_url().'assets/bootstrap-5.0.2/dist/css/bootstrap.min.css';?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="<?= base_url().'assets/datatables.min.css';?>" />
    <link rel="stylesheet" href="<?= base_url().'assets/select2-4.1.0/dist/css/select2.min.css';?>" />
    <link rel="stylesheet" href="<?= base_url().'assets/select2-bootstrap-5-theme-1.3.0/dist/select2-bootstrap-5-theme.min.css';?>" />
    <link rel="stylesheet" type="text/css" href="assets/sidebar.css"/>
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="<?= base_url().'assets/select2-bootstrap-5-theme-1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css';?>" />

    <!-- Scripts -->
    <script src="<?= base_url().'assets/jquery.min.js';?>"></script>
    <script src="<?= base_url().'assets/select2-4.1.0/dist/js/select2.min.js';?>"></script>
    <script src="<?= base_url().'assets/datatables.min.js';?>"></script>
    <script src="<?= base_url().'assets/datatables.bootstrap5.js';?>"></script>
    <script src="<?= base_url().'assets/terbilang.min.js';?>"></script>
    <script src="<?= base_url().'assets/reza.js';?>"></script>
    <script src="<?= base_url().'assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js';?>" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-sm-2 bg-warning">
                <div class="main-container d-flex">
                    <div class="sidebar" id="side_nav"> 
                        <div class="header-box">
                            <h1 class="fs-6"><span class="bg-white text-dark rounded shadow px-2 me-2">PEMBUKUAN</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <h1><?= esc($title) ?></h1>
            
                

