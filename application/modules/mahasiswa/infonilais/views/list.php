<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Informasi Nilai</h4>
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

                <?php
                if(count($cek_judul_acc) <= 0){
                    echo "<h3><i>Anda belum memiliki judul penelitian</i></h3>";
                }else{
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Nilai Seminar
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="15%">Judul</th>
                                            <th width="12%">Pembimbing</th>
                                            <th width="12%">Penguji 1</th>
                                            <th width="12%">Penguji 2</th>
                                            <th width="8%">Nilai Pembimbing</th>
                                            <th width="8%">Nilai Penguji 1</th>
                                            <th width="8%">Nilai Penguji 2</th>
                                            <th width="10%">Akumulasi</th>
                                            <th width="5%">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($nilai_seminar > 0){
                                            foreach($nilai_seminar as $key => $val) {
                                                $avg_nilai = (30/100 * $val['nilai_pembimbing']) + ((70/100 * ($val['nilai_penguji1'] + $val['nilai_penguji2']))/2);

                                                if($avg_nilai >= 85 && $avg_nilai <= 100){
                                                    $grade = "A";
                                                }else if($avg_nilai >= 75 && $avg_nilai < 85){
                                                    $grade = "B";
                                                }else if($avg_nilai >= 60 && $avg_nilai < 75){
                                                    $grade = "C";
                                                }else if($avg_nilai >= 40 && $avg_nilai < 60){
                                                    $grade = "D";
                                                }else if($avg_nilai < 40){
                                                    $grade = "E";
                                                }
                                            ?>
                                            <tr>
                                                <td><?=$val['judul'];?></td>
                                                <td><?=$val['nama_dosen'];?></td>
                                                <td><?=$val['penguji1'];?></td>
                                                <td><?=$val['penguji2'];?></td>
                                                <td><?=$val['nilai_pembimbing'];?></td>
                                                <td><?=$val['nilai_penguji1'];?></td>
                                                <td><?=$val['nilai_penguji2'];?></td>
                                                <td><?=$avg_nilai;?></td>
                                                <td><?=$grade;?></td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                   <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Nilai Sidang
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="15%">Judul</th>
                                            <th width="12%">Pembimbing</th>
                                            <th width="12%">Penguji 1</th>
                                            <th width="12%">Penguji 2</th>
                                            <th width="8%">Nilai Pembimbing</th>
                                            <th width="8%">Nilai Penguji 1</th>
                                            <th width="8%">Nilai Penguji 2</th>
                                            <th width="10%">Akumulasi</th>
                                            <th width="5%">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($nilai_sidang > 0){
                                            foreach($nilai_sidang as $key => $val) {
                                                $avg_nilai = (30/100 * $val['nilai_pembimbing']) + (35/100 * $val['nilai_penguji1']) + (35/100 * $val['nilai_penguji2']);

                                                if($avg_nilai >= 85 && $avg_nilai <= 100){
                                                    $grade = "A";
                                                }else if($avg_nilai >= 75 && $avg_nilai < 85){
                                                    $grade = "B";
                                                }else if($avg_nilai >= 60 && $avg_nilai < 75){
                                                    $grade = "C";
                                                }else if($avg_nilai >= 40 && $avg_nilai < 60){
                                                    $grade = "D";
                                                }else if($avg_nilai < 40){
                                                    $grade = "E";
                                                }
                                            ?>
                                            <tr>
                                                <td><?=$val['judul'];?></td>
                                                <td><?=$val['nama_dosen'];?></td>
                                                <td><?=$val['penguji1'];?></td>
                                                <td><?=$val['penguji2'];?></td>
                                                <td><?=$val['nilai_pembimbing'];?></td>
                                                <td><?=$val['nilai_penguji1'];?></td>
                                                <td><?=$val['nilai_penguji2'];?></td>
                                                <td><?=$avg_nilai;?></td>
                                                <td><?=$grade;?></td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>