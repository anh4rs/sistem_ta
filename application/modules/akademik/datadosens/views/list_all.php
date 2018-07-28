<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Data Dosen</h4>
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Dosen
                        <div class="pull-right">
                            <a href="<?=site_url();?>/datadosens/tambah_data" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Nama Dosen</th>
                                        <th>Email</th>
                                        <th>No HP</th>
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
                                            <td><?=$val['nip'];?></td>
                                            <td><?=$val['nama_dosen'];?></td>
                                            <td><?=$val['email'];?></td>
                                            <td><?=$val['no_hp'];?></td>
                                            <td>
                                                <a href="<?=site_url();?>/datadosens/edit_form/<?=$val['id']?>" title="Edit" class="btn btn-xs btn-warning">
                                                    <i class="fa fa-pencil-square"></i>
                                                </a>
                                                <a href="<?=site_url();?>/datadosens/hapus_data/<?=$val['id']?>" title="Hapus" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash-o"></i>
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