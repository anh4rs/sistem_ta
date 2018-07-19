<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Form Edit Judul </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Judul
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/pengajuanjuduls/ubah_data">
                            <?php
                            foreach ($result_detail as $key => $val) {
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul </label>
                                <input type="hidden" name="txt_id" value="<?=$val['id'];?>">
                                <input type="hidden" name="txt_id_detail" value="<?=$val['id_detail'];?>">
                                <input type="text" name="txt_judul" class="form-control" id="exampleInputEmail1" placeholder="Judul" value="<?=$val['judul'];?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_judul');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Ringkasan Masalah</label>
                                <textarea class="form-control" name="txt_ringkasan" rows="3" placeholder="Ringkasan Masalah"><?=$val['ringkas_masalah']; ?></textarea>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_ringkasan');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Metode</label>
                                <input type="text" name="txt_metode" class="form-control" id="exampleInputEmail1" placeholder="Metode" value="<?=$val['metode'];?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_metode');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi</label>
                                <textarea class="form-control" name="txt_deskripsi" rows="3" placeholder="Deskripsi"><?=$val['deskripsi'];?></textarea>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_deskripsi');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-success" value="Simpan">
                            </div>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>