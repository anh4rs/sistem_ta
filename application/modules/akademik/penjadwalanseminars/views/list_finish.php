<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Data Mahasiswa yang Telah Seminar</h4>
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

                <div class="panel panel-success">
                    <div class="panel-heading">
                        List Mahasiswa yang Telah Seminar
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIM</th>
                                        <th>Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Pembimbing</th>
                                        <th>Penguji 1</th>
                                        <th>Penguji 2</th>
                                        <th>Nilai</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if($result > 0){
                                        $no=1;
                                        foreach($result as $key => $val) {
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
                                            <td><?=$no;?></td>
                                            <td><?=$val['nim'];?></td>
                                            <td><?=$val['nama_mhs'];?></td>
                                            <td><?=$val['judul'];?></td>
                                            <td><?=$val['nama_dosen'];?></td>
                                            <td><?=$val['penguji1'];?></td>
                                            <td><?=$val['penguji2'];?></td>
                                            <td><?=$avg_nilai;?></td>
                                            <td><?=$grade;?></td>
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