<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Pengajuan Judul</h4>
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
                if($acc){
                    ?>
                    <div class="panel panel-success">
                    <?php
                }else{
                    ?>
                    <div class="panel panel-default">
                    <?php
                }
                ?>
                    <div class="panel-heading">
                        Pengajuan Judul dari <?=$nim_mhs;?> - <?=$nama_mhs;?>
                        <?php
                        if($acc){
                            echo "<div class='pull-right'><b>Judul Telah di ACC</b></div>";
                        }
                        ?>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Metode</th>
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
                                            <td><?=$nama_mhs;?></td>
                                            <td><?=$val['judul'];?></td>
                                            <td><?=$val['metode'];?></td>
                                            <td>
                                                <?php
                                                if($acc){
                                                    if($val['status'] == 3){
                                                        echo '<font style="color:green;">ACC</font>';
                                                        if($val['pembimbing'] == 0){
                                                            ?>
                                                            <a href="<?=site_url();?>/judulmahasiswas/form_pembimbing/<?=$val['id']?>" title="Tentukan Pembimbing" class="btn btn-xs btn-success">
                                                                <i class="fa fa-user"></i>
                                                            </a>
                                                        <?php
                                                        }else{
                                                            echo ' ('.$val['nama_dosen'].')';
                                                        }
                                                    }
                                                }else{
                                                    ?>
                                                    <a href="<?=site_url();?>/judulmahasiswas/detail_data/<?=$val['id']?>" title="Detail" class="btn btn-xs btn-info">
                                                        <i class="fa fa-info-circle"></i>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
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