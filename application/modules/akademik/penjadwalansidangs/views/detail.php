<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Detail Judul </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Judul
                    </div>
                    <div class="panel-body">
                        <?php
                        foreach ($result_detail as $key => $val) {
                        ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul </label>
                                <p><?=$val['judul'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Ringkasan Masalah</label>
                                <p><?=$val['ringkas_masalah'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Metode</label>
                                <p><?=$val['metode'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <p><?=$val['deskripsi'];?></p>
                            </div>
                            <?php
                            if($val['status'] == 3){
                                ?>
                                <hr>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pembimbing</label>
                                    <p><?=$val['pembimbing'];?></p>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penguji 1</label>
                                    <p><?=$val['penguji1'];?></p>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Penguji 2</label>
                                    <p><?=$val['penguji2'];?></p>
                                </div>
                                <?php
                            }


                            if($val['status'] == 3 || $val['status'] == 0){
                                ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keterangan</label>
                                    <p><?=$val['keterangan'];?></p>
                                </div>
                                <?php      
                            }
                        }
                        ?>
                        <a href="<?=site_url();?>/judulmahasiswas/respon_judul/<?=$val['id']?>/3/<?=$val['mhsid']?>" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i> ACC</a>
                        <a href="<?=site_url();?>/judulmahasiswas/respon_judul/<?=$val['id']?>/0/<?=$val['mhsid']?>" class="btn btn-danger"><i class="fa fa-thumbs-o-down "></i> Tolak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>