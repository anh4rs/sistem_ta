<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Pengaturan Pengajuan Judul </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Status Pengajuan Judul
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?=site_url();?>/dashboards/set_pengaturan">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status Pengajuan Judul </label>
                                    <select name="opt_status" class="form-control">
                                        <option value="0">Tidak Aktif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-success" value="Simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>