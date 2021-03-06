<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="60" >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ADMIN - Food Ordering System Gapakelama</title>
  <!-- Bootstrap core CSS-->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="<?= base_url() ?>assets/css/slider.css" rel="stylesheet"> -->
  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url() ?>assets/swal/dist/sweetalert.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/css/sb-admin.css" rel="stylesheet">
</head>

<style type="text/css">
/* The switch - the box around the slider */
.switch {
 position: relative;
 display: inline-block;
 width: 50px;
 height: 24px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
 position: absolute;
 cursor: pointer;
 top: 0;
 left: 0;
 right: 0;
 bottom: 0;
 background-color: #ccc;
 -webkit-transition: .4s;
 transition: .4s;
}

.slider:before {
 position: absolute;
 content: "";
 height: 16px;
 width: 16px;
 left: 4px;
 bottom: 4px;
 background-color: white;
 -webkit-transition: .4s;
 transition: .4s;
}

input:checked + .slider {
 background-color: #2196F3;
}

input:focus + .slider {
 box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
 -webkit-transform: translateX(26px);
 -ms-transform: translateX(26px);
 transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
 border-radius: 34px;
}

.slider.round:before {
 border-radius: 50%;
}
</style>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php
  $jumlahMeja = $listMeja->num_rows();?>
  <?php include 'template/nav_header.php'; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo site_url('dashboard_admin/index_admin')?>">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Admin</li>
      </ol>
      <!-- Icon Cards-->
      <div class="float-right">
        <label>Select All</label>
        <label class="switch">
            <input type="checkbox" name="checkboxListener2" checked>
          <span class="slider round"></span>
        </label>
      </div>
      <div class="text-center mb-4">
        <h1>Daftar Meja</h1>
      </div>
      <div class="container">
        <div class="row">
          <?php
          if($jumlahMeja > 0){
            foreach($listMeja->result() as $row){
              ?>
              <div class="card mb-3 mx-3" style="width: 18rem;">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <div class="float-left">
                        <h2 class="card-title"><?= $row->no_meja ?></h2>
                      </div>
                      <div class="float-right">
                        <label class="switch">
                          <?php if($row->digunakan=="false"){ ?>
                            <input type="checkbox" class="checkboxListener" name="checkboxListener" id="checkboxListener" data-status="0" value="<?= $row->no_meja ?>">

                          <?php } else { ?>
                            <input type="checkbox" class="checkboxListener" name="checkboxListener" id="checkboxListener" checked data-status="1" value="<?= $row->no_meja ?>">
                          <?php } ?>
                          <span class="slider round"></span>
                        </label>
                      </div>
                      <!-- endfloat right -->
                    </div>
                    <!-- end col -->

                  </div>
                  <!-- end row -->

                  <div class="row">
                    <div class="col text-center">
                      <!-- CARD PELAYAN -->
                      <div class="card border-success mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-success">ID 1</div>
                        <div class="card-body text-success">
                          <img class="img-fluid" style="height:10rem;" src="<?= base_url() ?>assets/image/gambar1.png" alt="">
                        </div>
                        <div class="card-footer bg-transparent border-success">Nama</div>
                      </div>
                      <!-- BUTTON DETAILS -->
                      <?php if($row->digunakan=="false"):?>
                      <button class="btn btn-sm btn-primary" style="width:4.4rem" type="button" name="button" disabled>Detail</button>
                      <button class="btn btn-sm btn-success" style="width:4.4rem" type="button" name="button" disabled>Progress</button>
                      <button class="btn btn-sm btn-info" style="width:4.4rem" type="button" name="button" disabled>History</button>
                    <?php else:?>
                      <button class="btn btn-sm btn-primary" style="width:4.4rem" type="button" name="button" >Detail</button>
                      <button class="btn btn-sm btn-success" style="width:4.4rem" type="button" name="button" >Progress</button>
                      <button class="btn btn-sm btn-info" style="width:4.4rem" type="button" name="button" >History</button>
                    <?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div> 
  <script>
  $(document).ready(function ()
  {
    $('input[name="checkboxListener"]').click(function() {
      var no_meja = $(this).val();
      var status = this.dataset.status
      var dataString = 'no_meja='+no_meja+'&status='+status;
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>dashboard_admin/ubah_status",
        data: dataString,
        cache: false,
        // dataType : 'json',
        success: function(){
          window.location.reload();
        }
      });
    });
  });
  </script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
