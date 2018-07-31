<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Form Penentuan Jadwal Seminar </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Penentuan Jadwal Seminar
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/penjadwalanseminars/set_jadwal_seminar">
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
                                <select name="opt_penguji1" class="form-control">
                                    <option value="">-- pilih penguji 1 --</option>
                                    <?php
                                    foreach ($list_dosen as $key => $val_dosen) {
                                        ?>
                                        <option value="<?=$val_dosen['id']?>"><?=$val_dosen['nama_dosen']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('opt_penguji1');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Penguji 2 </label>
                                <select name="opt_penguji2" class="form-control">
                                    <option value="">-- pilih penguji 2 --</option>
                                    <?php
                                    foreach ($list_dosen as $key => $val_dosen) {
                                        ?>
                                        <option value="<?=$val_dosen['id']?>"><?=$val_dosen['nama_dosen']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('opt_penguji2');?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal dan Jam</label> <span style="font-style: italic;">Format penginputan tanggal dan jam (yyyy-mm-dd HH:mm:ss) contoh 2018-07-30 09:00:00</span>
                                <input type="text" name="txt_tanggal" class="form-control" id="exampleInputEmail1" placeholder="Tanggal dan Jam : Contoh (2018-07-30 09:00:00)" value="<?= set_value('txt_tanggal'); ?>"/>
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