<!DOCTYPE html>
<html lang="en">
<head>
  <!-- META CHARSET -->
  <meta charset="utf-8">

  <!-- TITLE PAGE -->
  <title>Admin | <?php echo $this->config->item('app.site_name');?></title>

  <!-- META VIEW PORT -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- META VIEW PORT -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- LOGO -->
  <link rel="icon" href="<?php echo base_url('images/logo-header.png');?>" type="image/png">

  <!-- FONTAWESOME CSS -->
  <link href="<?php echo base_url('assets/admin/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- SBADMIN CSS -->
  <link href="<?php echo base_url('assets/admin/css/sb-admin-2.min.css');?>" rel="stylesheet">

  <!-- TOAST CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/user/assets/css/toastr.min.css');?>">
    
  <!-- DATERANGE PICKER CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/user/assets/css/daterangepicker.css');?>">

  <!-- SWITCHER CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/user/assets/css/switchery.min.css');?>"> 
  
  <!-- CSS STYLE UNTUK LOADING PAGE DAN LOADING MODAL -->
  <style>
      #loader-page{
         position:fixed;
         z-index:99999;
         top:0;
         left:0;
         bottom:0;
         right:0;
         background: white;
         transition: 1s 0.4s;
       }

       #loader-page-indikator{
          top:20%;
          left:45%;
          position:absolute;
       }   

     #loading-modal{
       display: none;
         position:fixed;
         z-index:999990;
         top:0;
         left:0;
         bottom:0;
         right:0;
         background: rgb(127,127,127,0.5);
     }

     #loading-modal > div{
      position: fixed;
      left:40%;
      top:30%;
      width:300px;      
      z-index: 999999 !important;  
     }  

      @media only screen and (max-width: 698px){
        #loader-page-indikator{
          left:30%;
        }

        #loading-modal > div{
          left:10%;    
        }
      }
  </style>

  <!-- CSS STYLE UNTUK PARSLEY ERRORS -->
  <style>
    .parsley-errors-list{
      color:red;
      list-style:none;
      padding:8px;
      opacity: 0.8;
    }
  </style>

  <!-- SEMUA CSS BUATAN SENDIRI -->
  <style>
  .no-border{
    border:0px solid red !important;
  }
  </style>

  <!-- JQUERY -->
  <script src="<?php echo base_url('assets/admin/vendor/jquery/jquery.min.js');?>"></script>
  <!-- BOOTSTRAP -->
  <script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- EASING -->
  <script src="<?php echo base_url('assets/admin/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
  <!-- JQUERY MASK -->
  <script src="<?php echo base_url('assets/user/assets/js/jquery.mask.min.js');?>"></script>
  <!-- TOASTR -->
  <script src="<?php echo base_url('assets/user/assets/js/toastr.min.js');?>"></script>
  <!-- SWEETALERT -->
  <script src="<?php echo base_url('assets/user/assets/js/sweetalert2.js');?>"></script>
  <!-- MOMENT -->
  <script src="<?php echo base_url('assets/user/assets/js/moment.js');?>"></script> 
  <!-- MOMENT WITH LOCALE -->
  <script src="<?php echo base_url('assets/user/assets/js/moment-with-locales.js');?>"></script>
  <!-- PARSLEY -->
  <script src="<?php echo base_url('assets/user/assets/js/parsley.min.js');?>"></script>
  <!-- PARSLEY I18N -->
  <script src="<?php echo base_url('assets/user/assets/js/i18n/id.js');?>"></script>
  <!-- DATERANGE PICKER -->
  <script src="<?php echo base_url('assets/user/assets/js/daterangepicker.js');?>"></script>
  <!-- SWITCHER -->
  <script src="<?php echo base_url('assets/user/assets/js/switchery.min.js');?>"></script>
  <!-- VIVUS -->
  <script src="<?php echo base_url('assets/user/assets/js/vivus.min.js');?>"></script>
</head>

<body id="page-top">

  <!-- LOADING MODAL -->
  <div 
    id="loading-modal">
      <div class="modal no-border">
        <div class="modal-dialog no-border">
          <div class="modal-content no-border">        
            <div class="modal-body no-border pt-5 pb-5">
              <div class="text-center no-border">
                <i class="fa fa-spinner fa-spin fa-5x text-gray"></i> 
              </div>                     
            </div>      
          </div>
        </div>
      </div>
   </div>
  <!-- LOADING MODAL -->

  <!-- LOADING PAGE -->
    <div 
      id="loader-page">                        
        <div 
          id="loader-page-indikator">
          <div class="text-center" style="margin:auto">
            <!-- 
              <i class="fa fa-spinner fa-spin fa-5x"></i> 
            -->

            <div id="svg-loading" 
              style="width:150px"></div> 
          </div>
          
          <div class="mt-2 text-center">
            <span style="font-size:20px;color:rgb(139,21,158,189)">
              Loading . . .
            </span>
          </div>         
        </div>
    </div>  
  <!-- LOADING PAGE -->


  <div id="wrapper">

    <!-- SIDEBAR -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" 
    id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" 
      href="<?php echo site_url();?>/admin">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">CampRent</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url();?>/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" 
        href="#" 
        data-toggle="collapse" 
        data-target="#collapseInvoice" 
        aria-expanded="true" 
        aria-controls="collapseInvoice">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Invoice</span>
      </a>
      <div id="collapseInvoice" 
        class="collapse" 
        aria-labelledby="headingInvoice" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Invoice</h6>
            <a class="collapse-item" href="<?php echo site_url();?>/admin/invoice">Kelola Invoice</a>
        </div>
      </div>
    </li>

     <li class="nav-item">
      <a class="nav-link collapsed" 
        href="#" 
        data-toggle="collapse" 
        data-target="#collapseManualPayment" 
        aria-expanded="true" 
        aria-controls="collapseManualPayment">
        <i class="fas fa-fw fa-money-check"></i>
        <span>Pembayaran Manual</span>
      </a>
      <div id="collapseManualPayment" 
        class="collapse" 
        aria-labelledby="headingManualPayment" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Pembayaran</h6>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/manual-payment">Kelola Pembayaran</a>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/manual-payment/validasi">Validasi Pembayaran</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" 
        data-toggle="collapse" 
        data-target="#collapseUser" 
        aria-expanded="true" 
        aria-controls="collapseUser">
        <i class="fas fa-fw fa-user"></i>
        <span>User</span>
      </a>

      <div id="collapseUser" 
        class="collapse" 
        aria-labelledby="headingUser" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola User</h6>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/user">Kelola User</a>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/user/blokir">Kelola User Blokir</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" 
        href="#" 
        data-toggle="collapse" 
        data-target="#collapseProduct" 
        aria-expanded="true" 
        aria-controls="collapseProduct">
        <i class="fas fa-fw fa-list"></i>
        <span>Product</span>
      </a>
      <div id="collapseProduct" 
        class="collapse" 
        aria-labelledby="headingProduct" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Product</h6>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/product">Kelola Product</a>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/product/nonaktif">Kelola Product Nonaktif</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" 
        href="#" 
        data-toggle="collapse" 
        data-target="#collapseKomentar" 
        aria-expanded="true" 
        aria-controls="collapseKomentar">
        <i class="fas fa-fw fa-reply"></i>
        <span>Komentar</span>
      </a>
      <div id="collapseKomentar" 
        class="collapse" 
        aria-labelledby="headingKomentar" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Komentar</h6>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/review">Kelola Komentar</a>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/review/negatif">Kelola Komentar Negatif</a>        
          <a class="collapse-item" href="<?php echo site_url();?>/admin/review/positif">Kelola Komentar Positif</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link 
        collapsed" 
        href="#" 
        data-toggle="collapse" 
        data-target="#collapseSetting" 
        aria-expanded="true" 
        aria-controls="collapseSetting">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setting</span>
      </a>
      <div id="collapseSetting" 
        class="collapse" 
        aria-labelledby="headingSetting" 
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kelola Setting</h6>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/setting/website">Setting Website</a>
          <a class="collapse-item" href="<?php echo site_url();?>/admin/setting/invoice">Setting Invoice</a>        
          <a class="collapse-item" href="<?php echo site_url();?>/admin/setting/order">Setting Order</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url();?>/admin/category">
        <span>Kategori</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url();?>/admin/info">
        <span>Info</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url();?>/admin/slider">
        <span>Slider</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="<?php echo site_url();?>/admin/cronjob">
        <span>Manual Cronjob</span>
      </a>
    </li>

    <div class="text-center d-none d-md-inline">  
      <button class="rounded-circle border-0" 
        id="sidebarToggle"
        onclick="cekSidebarAdminToggle()">
      </button>
    </div>
    </ul>

    <script>
    if(localStorage){
      var sidebarAdminToggle = localStorage.getItem('sidebarAdminToggle');

      if(sidebarAdminToggle){
        if(sidebarAdminToggle == 'hide'){
          document.getElementById('accordionSidebar').classList.add('toggled');
        }  
      }

      function cekSidebarAdminToggle(){
        if(document.getElementById('accordionSidebar').classList.length == 5){
          localStorage.setItem('sidebarAdminToggle','hide');
        }else{
          localStorage.setItem('sidebarAdminToggle','show');
        }
      }
    }
    </script>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" 
            class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" 
                href="#" 
                id="alertsDropdown" 
                role="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
              </a>

              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notification Admin
                </h6>

                <?php foreach($this->config->item('app.notif_admin') as $item){ ?>
                <a class="dropdown-item d-flex align-items-center" 
                  href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fa fa-bell text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">
                      <?php echo $item['created_at'];?>
                    </div>
                    <span class="font-weight-bold">
                      <?php echo ucfirst($item['content']);?>
                    </span>
                  </div>
                </a>
                <?php } ?>

                <?php if(!count($this->config->item('app.notif_admin'))){ ?>
                  <div class="text-gray-500 text-center mt-3 mb-3 p-3">
                    <div class="mt-2">
                      <i class="fa fa-bell fa-5x"></i>
                    </div>
                    <div class="mt-3">
                      <h5>Notif Kosong</h5>
                    </div>
                  </div>
                <?php } ?>      

                <?php if(count($this->config->item('app.notif_admin')) > 0) { ?>
                  <a class="dropdown-item text-center small text-gray-500" 
                    href="<?php echo site_url();?>/admin/notif-admin">
                    Tampilkan Semua
                  </a>
                <?php } ?>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block">
            </div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" 
                href="#" 
                id="userDropdown" 
                role="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php 
                    echo $this->LSession->user()['first_name']
                  ?>
                </span>

                <i class="fa fa-user-circle"></i>
              </a>

              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                aria-labelledby="userDropdown">
         
                <a class="dropdown-item" href="<?php echo site_url();?>/admin/log-admin">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Log Admin
                </a>

                <a class="dropdown-item" href="<?php echo site_url();?>">
                  <i class="fas fa-reply fa-sm fa-fw mr-2 text-gray-400"></i>
                  Kembali Ke User
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="<?php echo site_url();?>/logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- CONTENT -->  