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
                        <h3 class="font-green-sharp">
                            <?php $tot = $this->db->get('peserta')->num_rows() ?>
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
                        <div class="status-title"> Total Peserta Yang Telah Mendaftar </div>
                        <div class="status-number"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>