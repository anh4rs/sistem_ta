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
                        <form method="POST" action="<?=site_url();?>/datadosens/ubah_data">
                            <?php
                            foreach ($result_detail as $key => $val) {
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NIP </label>
                                    <input type="hidden" name="txt_id" value="<?=$val['id'];?>">
                                    <input type="text" name="txt_nip" class="form-control" id="exampleInputEmail1" placeholder="NIP" value="<?=$val['nip'];?>" readonly/>
                                    <span style="color: red; font-size: 11; font-style: italic;">
                                        <?=form_error('txt_nip');?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Dosen</label>
                                    <input type="text" name="txt_nama_dosen" class="form-control" id="exampleInputEmail1" placeholder="Nama Dosen" value="<?=$val['nama_dosen'];?>"/>
                                    <span style="color: red; font-size: 11; font-style: italic;">
                                        <?=form_error('txt_nama_dosen');?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="txt_email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?=$val['email'];?>"/>
                                    <span style="color: red; font-size: 11; font-style: italic;">
                                        <?=form_error('txt_email');?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">No Hp</label>
                                    <input type="text" name="txt_nohp" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?=$val['no_hp'];?>"/>
                                    <span style="color: red; font-size: 11; font-style: italic;">
                                        <?=form_error('txt_nohp');?>
                                    </span>
                                </div>
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