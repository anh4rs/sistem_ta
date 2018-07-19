<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Form Penginputan Nilai Seminar </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Field Penginputan Nilai Seminar
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/penginputannilais/set_nilai_seminar">
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
                                <label for="exampleInputEmail1">Tanggal Seminar</label>
                                <p><?=$val['tanggal'];?></p>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Nilai Pembimbing</label>
                                <input type="text" name="txt_nilai_pembimbing" class="form-control" id="exampleInputEmail1" placeholder="Nilai Pembimbing" value="<?=$val['nilai_pembimbing'];?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_nilai_pembimbing');?>
                                </span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Nilai Penguji 1</label>
                                <input type="text" name="txt_nilai_penguji1" class="form-control" id="exampleInputEmail1" placeholder="Nilai Penguji 1" value="<?=$val['nilai_penguji1'];?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_nilai_penguji1');?>
                                </span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Nilai Penguji 2</label>
                                <input type="text" name="txt_nilai_penguji2" class="form-control" id="exampleInputEmail1" placeholder="Nilai Penguji 2" value="<?=$val['nilai_penguji2'];?>"/>
                                <span style="color: red; font-size: 11; font-style: italic;">
                                    <?=form_error('txt_nilai_penguji2');?>
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