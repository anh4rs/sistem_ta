<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Pengajuan Seminar</h4>
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
                if($pengajuan_judul){
                    $title = "Judul anda telah diajukan";
                    ?>
                    <div class="panel panel-primary">
                    <?php
                }else if($acc){
                    $title = "Judul anda telah di ACC";
                    ?>
                    <div class="panel panel-success">
                    <?php
                }else{
                    $title = "Judul";
                    ?>
                    <div class="panel panel-default">
                    <?php
                }
                ?>
                    <div class="panel-heading">
                        <?=$title;?>
                        <div class="pull-right">
                            <?php
                            if(!$pengajuan_judul && !$acc){
                                if($ajukan_judul){
                                ?>
                                    <a href="<?=site_url();?>/pengajuanjuduls/pengajuan_judul" class="btn btn-success"><i class="fa fa-check-square"></i> Ajukan Judul</a>
                                <?php
                                }else{
                                ?>
                                    <a href="<?=site_url();?>/pengajuanjuduls/tambah_data" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
                                    <?php
                                }
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
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Respon</th>
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
                                            <td>
                                                <?php
                                                if($val['status'] == 0){
                                                    echo '<font style="color:red;">Judul ditolak</font>';
                                                }else if($val['status'] == 1){
                                                    echo "Ready";
                                                }else if($val['status'] == 2){
                                                    echo '<font style="color:blue;">Judul yang diajukan</font>';
                                                }else if($val['status'] == 3){
                                                    echo '<font style="color:green;">ACC</font>';
                                                }
                                                ?>
                                            </td>
                                            <td><?=$val['keterangan'];?></td>
                                            <td>
                                                <?php
                                                if($val['status'] == 1){
                                                    ?>
                                                    <a href="<?=site_url();?>/pengajuanjuduls/edit_form/<?=$val['id']?>" title="Edit" class="btn btn-xs btn-warning">
                                                        <i class="fa fa-pencil-square"></i>
                                                    </a>
                                                    <a href="<?=site_url();?>/pengajuanjuduls/hapus_data/<?=$val['id']?>" title="Hapus" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a href="<?=site_url();?>/pengajuanjuduls/detail_data/<?=$val['id']?>" title="Detail" class="btn btn-xs btn-info">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
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
    </div>
</div>