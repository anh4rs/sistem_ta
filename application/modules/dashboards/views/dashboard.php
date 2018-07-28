<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Dashboard</h4>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h3>Selamat Datang pada Sistem Tugas Akhir Fakultas Ilmu Komputer Universitas Ubudiyah Indonesia</h3>
                </center>

                <hr>

                <?php
                foreach ($data_pengaturan as $key => $value) {
                    if($value['status'] == 0){
                        $class = "alert alert-danger";
                        $pesan = "Pengajuan judul belum dibuka oleh Akademik";
                    }else{
                        $class = "alert alert-info";
                        $pesan = "Pengajuan judul telah dibuka oleh Akademik";
                    }
                ?>
                <div class="<?=$class?>">
                    <strong><?=$value['nama_status']?></strong>
                    <br>
                    <?=$pesan;?>

                    <?php
                    if($jenis_user == "akademik"){
                    ?>
                    <div class="pull-right">
                        <a href="<?=site_url();?>/dashboards/pengaturan" class="btn btn-primary">Setting</a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>