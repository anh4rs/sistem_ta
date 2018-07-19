<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Form Penentuan Jadwal sidang </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Penentuan Jadwal Sidang
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/penjadwalansidangs/set_jadwal_sidang">
                            <?php
                            foreach ($result_detail as $key => $val) {
                            ?>
                            <div class="form-group">
                                <input type="hidden" name="txt_id" value="<?=$val['id'];?>">
                                <input type="hidden" name="txt_id_judul" value="<?=$val['judulid'];?>">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">NIM </label>
                                <p><?=$val['nim'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Mahasiswa </label>
                                <p><?=$val['nama_mhs'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul </label>
                                <p><?=$val['judul'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Pembimbing </label>
                                <p><?=$val['nama_dosen'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Penguji 1 </label>
                                <p><?=$val['penguji1'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Penguji 2 </label>
                                <p><?=$val['penguji2'];?></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label> <span style="font-style: italic;">Format penginputan tanggal (yyyy-mm-dd) contoh 2018-07-30</span>
                                <input type="text" name="txt_tanggal" class="form-control" id="exampleInputEmail1" placeholder="Tanggal : Contoh (2018-07-30)" value="<?= set_value('txt_tanggal'); ?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_tanggal');?>
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