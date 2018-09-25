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
                            <span><?php echo $tot; ?></span>
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
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">List Data Peserta</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <canvas id="cabangChart"></canvas>
                </div>
            </div>
    
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">List Data Peserta</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <canvas id="ptkinChart"></canvas>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->
</div>

<script src="<?php echo base_url() ?>assets/global/scripts/Chart.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $.get("<?php echo site_url('ADashboard/seed') ?>",function(data){
             var cabangChart = new Chart($("#cabangChart"), {
                type: 'bar',
                data: {
                    labels: data.cabang.labels,
                    datasets: [{
                        data: data.cabang.data,
                        backgroundColor: data.cabang.colors
                    }]
                }
            })
            var ptkinChart = new Chart($("#ptkinChart"), {
                type: 'bar',
                data: {
                    labels: data.ptkin.labels,
                    datasets: [{
                        data: data.ptkin.data,
                        backgroundColor: data.ptkin.colors
                    }]
                }
            })
        })
       
    })
</script>
