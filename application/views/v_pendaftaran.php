<div class="container">
    <!-- BEGIN PAGE BREADCRUMBS -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftarkan Mahasiswa Pada Setiap Cabang Yang Dipilih</span>
        </li>
    </ul>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h6 class="font-green-sharp">
                            <small class="font-green-sharp">Total Peserta Mendaftar</small><br>
                        </h6>
                        <h3 class="font-green-sharp">
                            <?php $tot = $this->db->get_where('peserta', array('id_ptkin'=>$this->session->userdata('id_ptkin')))->num_rows() ?>
                            <span data-counter="counterup" data-value="<?php echo $tot; ?>">0</span>
                            <small class="font-green-sharp">Orang <span class="glyphicon glyphicon-th-list"></span></small>
                        </h3>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-ok"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="status">
                        <div class="status-title"> Total Peserta </div>
                        <div class="status-number"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <?php 
            $in = "(".$cabang['id_cabang'].")";
            $pilihan = $this->db->query("SELECT * FROM cabang WHERE id_cabang IN $in"); 
            foreach ($pilihan->result() as $p) { 
                $jumpes = $this->db->get_where('peserta', array('id_cabang'=>$p->id_cabang))->num_rows();  
         ?>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h6 class="font-green-sharp">
                            <small class="font-green-sharp"><?php echo $p->nama_cabang?></small><br>
                        </h6>
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="<?php echo $jumpes; ?>">0</span>
                            <small class="font-green-sharp">Orang <span class="glyphicon glyphicon-th-list"></span></small>
                        </h3>
                        <small></small>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-ok"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="status">
                        <div class="status-title"> <?php echo $p->jenis ?> </div>
                        <div class="status-number"><?php echo anchor('Pendaftaran/lihatPendaftar/'.$p->id_cabang, 'Lihat Peserta'); ?> </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-red-haze">
                            <span data-counter="counterup" data-value="1349">0</span>
                        </h3>
                        <small>NEW FEEDBACKS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-like"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                            <span class="sr-only">85% change</span>
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> change </div>
                        <div class="status-number"> 85% </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-blue-sharp">
                            <span data-counter="counterup" data-value="567"></span>
                        </h3>
                        <small>NEW ORDERS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-basket"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                            <span class="sr-only">45% grow</span>
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> grow </div>
                        <div class="status-number"> 45% </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-purple-soft">
                            <span data-counter="counterup" data-value="276"></span>
                        </h3>
                        <small>NEW USERS</small>
                    </div>
                    <div class="icon">
                        <i class="icon-user"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                            <span class="sr-only">56% change</span>
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> change </div>
                        <div class="status-number"> 57% </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>