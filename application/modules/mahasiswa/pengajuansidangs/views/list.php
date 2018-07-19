<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Pengajuan Sidang</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">

                <!-- Session Flash Data Pesan Error -->
                <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Berhasil,</strong> <?=$this->session->flashdata('success');?>
                </div>
                <?php elseif($this->session->flashdata('warning')): ?>
                <div class="alert alert-danger">
                    <button class="close" data-dismiss="alert">x</button>
                    <strong>Gagal,</strong> <?=$this->session->flashdata('warning');?>
                </div>
                <?php endif; ?>
                <!-- End Session Data Pesan Error -->

                <?php
                if(count($cek_judul_acc) <= 0){
                    echo "<h3><i>Anda belum memiliki judul penelitian</i></h3>";
                }else if(count($cek_hasil_seminar) <= 0){
                    echo "<h3><i>Anda belum melakukan seminar atau nilai seminar anda tidak mencukupi</i></h3>";
                }else{
                    foreach ($cek_judul_acc as $key => $value) {
                        $judul_id = $value['id'];
                    }
                ?>

                <?php
                if($status == 2){
                    $title = "Pengajuan sidang anda telah diajukan";
                    ?>
                    <div class="panel panel-primary">
                    <?php
                }else if($status == 3){
                    $title = "Pengajuan sidang anda telah di ACC";
                    ?>
                    <div class="panel panel-success">
                    <?php
                }else if($status == 1){
                    $title = "Pengajuan sidang anda ditolak";
                    ?>
                    <div class="panel panel-danger">
                    <?php
                }else{
                    $title = "Pengajuan sidang";
                    ?>
                    <div class="panel panel-default">
                    <?php
                }
                ?>
                    <div class="panel-heading">
                        <?=$title;?>
                        <div class="pull-right">
                            <?php
                            if($status == 0 || $status == 1){
                            ?>
                                <a href="<?=site_url();?>/pengajuansidangs/pengajuan_sidang/<?=$judul_id?>" class="btn btn-success"><i class="fa fa-check-square"></i> Ajukan sidang</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Metode</th>
                                        <th>Ringkas Masalah</th>
                                        <th>Deskripsi</th>
                                        <th>Pembimbing</th>
                                        <th>Penguji 1</th>
                                        <th>Penguji 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($result > 0){
                                        $no=1;
                                        foreach($result as $key => $val) {
                                        ?>
                                        <tr>
                                            <td><?=$no;?></td>
                                            <td><?=$val['judul'];?></td>
                                            <td><?=$val['metode'];?></td>
                                            <td><?=$val['ringkas_masalah'];?></td>
                                            <td><?=$val['deskripsi'];?></td>
                                            <td><?=$val['nama_dosen'];?></td>
                                            <td><?=$val['penguji1'];?></td>
                                            <td><?=$val['penguji2'];?></td>
                                        </tr>
                                        <?php
                                        $no++;
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if($status == 3 && count($detail_sidang > 0)){
        ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    Jadwal sidang Anda
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Pembimbing</th>
                                    <th>Penguji 1</th>
                                    <th>Penguji 2</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if($detail_sidang > 0){
                                    $no=1;
                                    foreach($detail_sidang as $key => $val) {
                                    ?>
                                    <tr>
                                        <td><?=$val['tanggal'];?></td>
                                        <td><?=$val['judul'];?></td>
                                        <td><?=$val['nama_dosen'];?></td>
                                        <td><?=$val['penguji1'];?></td>
                                        <td><?=$val['penguji2'];?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
    </div>
</div>