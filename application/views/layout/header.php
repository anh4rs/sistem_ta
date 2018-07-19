<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Sistem Tugas Akhir Fakultas Ilmu Komputer UUI</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="<?=base_url();?>assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="<?=base_url();?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Sistem Tugas Akhir Fakultas Ilmu Komputer UUI</strong>
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->

    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        <li class="dropdown">
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->

    <?php
    if($this->session->userdata('jenis_user')){
    ?>
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <li><a href="<?=site_url();?>/dashboards">Dashboard</a></li>
                                <?php
                                if($jenis_user === "akademik"){
                                ?>
                                    <li><a href="<?=site_url();?>/judulmahasiswas">Judul Mahasiswa</a></li>
                                    <li><a href="<?=site_url();?>/penjadwalanseminars">Penjadwalan Seminar</a></li>
                                    <li><a href="<?=site_url();?>/penjadwalansidangs">Penjadwalan Sidang</a></li>
                                    <li><a href="<?=site_url();?>/penginputannilais">Penginputan Nilai</a></li>
                                <?php
                                }

                                if($jenis_user === "dosen"){
                                ?>
                                    <li><a href="<?=site_url();?>/databimbingans">Data Bimbingan</a></li>
                                    <li><a href="<?=site_url();?>/datapengujians">Data Pengujian</a></li>
                                <?php
                                }

                                if($jenis_user === "mahasiswa"){
                                ?>
                                    <li><a href="<?=site_url();?>/pengajuanjuduls">Pengajuan Judul</a></li>
                                    <li><a href="<?=site_url();?>/pengajuanseminars">Pengajuan Seminar</a></li>
                                    <li><a href="<?=site_url();?>/pengajuansidangs">Pengajuan Sidang</a></li>
                                    <li><a href="<?=site_url();?>/infonilais">Nilai</a></li>
                                <?php
                                }
                                ?>
                                <li><a href="<?=site_url();?>/logins/logout_user">Logout</a></li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- MENU SECTION END-->
    <?php
    }
    ?>