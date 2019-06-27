<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$titulo?></title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?=base_url('assets/vendor/datatables/dataTables.bootstrap4.css')?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url('assets/css/sb-admin.css')?>" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="<?=base_url()?>">Portal de Votações</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>

    <!-- Navbar -->
   <?php $this->load->view('admin/elementos/navbar');?>

  </nav>

  <div id="wrapper">