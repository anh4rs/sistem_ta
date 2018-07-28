<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Pengajuan Sidang oleh Mahasiswa</h4>
            </div>
        </div>

        <a href="<?=site_url();?>/penjadwalansidangs/index_finish" class="btn btn-success"><i class="fa fa-star"></i> Data Mahasiswa yang telah sidang</a>

        <hr>
        
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Pengajuan Sidang Mahasiswa
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIM</th>
                                        <th>Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Pembimbing</th>
                                        <th>Pembimbing</th>
                                        <th>Pembimbing</th>
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
                                            <td><?=$val['nim'];?></td>
                                            <td><?=$val['nama_mhs'];?></td>
                                            <td><?=$val['judul'];?></td>
                                            <td><?=$val['nama_dosen'];?></td>
                                            <td><?=$val['penguji1'];?></td>
                                            <td><?=$val['penguji2'];?></td>
                                            <td>
                                                <?php
                                                if($val['status_pengajuan'] == 3){
                                                    echo '<font style="color:green;">Sidang telah di ACC</font>';
                                                }else{
                                                ?>
                                                <a href="<?=site_url();?>/penjadwalansidangs/tentukan_jadwal/<?=$val['id']?>" title="Detail" class="btn btn-xs btn-info">
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