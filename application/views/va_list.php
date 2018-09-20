

<div class="container">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Tabel Pendaftar</span>
        </li>
    </ul>
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <?php echo anchor('ADashboard/excelPeserta/'.$this->uri->segment(3), 'Export Excel', array('class'=>'btn btn-sm btn-primary')) ?>
                <div style="height: 25px"></div>
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">List Data Peserta</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                            <thead>
                                <tr class="">
                                    <th> No </th>
                                    <th> Nim </th>
                                    <th> Nama </th>
                                    <th> Jurusan </th>
                                    <th> Fakultas </th>
                                    <th> Cabang </th>
                                    <th> Jenis </th>
                                    <th> Dokumen </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1; 
                                    foreach ($peserta->result() as $p) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $p->nim; ?></td>
                                    <td><?php echo $p->nama; ?></td>
                                    <td><?php echo $p->jurusan; ?></td>
                                    <td><?php echo $p->fakultas; ?></td>
                                    <td><?php echo $p->nama_cabang; ?></td>
                                    <td><?php echo $p->jenis; ?></td>
                                    <td width="300px">
                                        <a href="<?php echo base_url() ?>assets/upload/ktm/<?php echo $p->ktm ?>" target="_blank" class="btn btn-xs btn-primary">Ktm</a>
                                        <a href="<?php echo base_url() ?>assets/upload/foto/<?php echo $p->foto ?>" target="_blank" class="btn btn-xs btn-success">Foto</a>
                                        <a href="<?php echo base_url() ?>assets/upload/rekomendasi/<?php echo $p->rekomendasi ?>" target="_blank" class="btn btn-xs btn-info">Rekomendasi</a>
                                        <a href="<?php echo base_url() ?>assets/upload/aktif/<?php echo $p->surat_aktif ?>" target="_blank" class="btn btn-xs btn-default">Surat Aktif</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                 ?>
                            	<!-- <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
