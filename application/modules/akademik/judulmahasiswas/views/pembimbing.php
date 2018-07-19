<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Form Penentu Pembimbing </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Judul
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/judulmahasiswas/set_pembimbing">
                            <?php
                            foreach ($result_detail as $key => $val) {
                            ?>
                            <div class="form-group">
                                <input type="hidden" name="txt_id" value="<?=$val['id'];?>">
                                <input type="hidden" name="txt_id_mhs" value="<?=$val['mhsid'];?>">
                            </div>

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

                            <div class="form-group">
                                <label for="exampleInputEmail1">Pembimbing </label>
                                <select name="opt_pembimbing" class="form-control">
                                    <option value="">-- pilih pembimbing --</option>
                                    <?php
                                    foreach ($list_dosen as $key => $val_dosen) {
                                        ?>
                                        <option value="<?=$val_dosen['id']?>"><?=$val_dosen['nama_dosen']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('opt_pembimbing');?>
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