

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
            	<?php echo anchor('Pendaftaran/tambahPeserta/'.$this->uri->segment(3), 'Tambah Peserta', array("class"=>"btn btn-success")) ?>
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div style="height: 25px"></div>
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">List Data Mahasiswa Cabang Perlombaan <?php echo $cabang['nama_cabang'] ?></span>
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
                                    <th> Dokumen </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php 
                            		$no = 1;
                            		foreach ($peserta->result() as $p) {
                            			echo 
                        					"<tr>
                            					<td>$no</td>
                            					<td>$p->nim</td>
                            					<td>$p->nama</td>
                            					<td>$p->jurusan</td>
                            					<td>$p->fakultas</td>
                            					<td>
                            						<a href='".base_url()."assets/upload/ktm/".$p->ktm."' class='btn btn-xs btn-primary' target='_blank'>Ktm</a> 
                            						<a href='".base_url()."assets/upload/foto/".$p->foto."' class='btn btn-xs btn-default' target='_blank'>Foto</a>
                            						<a href='".base_url()."assets/upload/rekomendasi/".$p->rekomendasi."' class='btn btn-xs btn-info' target='_blank'>Rekomendasi</a>
                            						<a href='".base_url()."assets/upload/aktif/".$p->surat_aktif."' class='btn btn-xs btn-success' target='_blank'>Surat Aktif</a>
                                                    <a href='".base_url()."assets/upload/dikti/".$p->dikti."' class='btn btn-xs btn-warning' target='_blank'>Bukti Dikti</a>
                            					</td>
                            					<td>
                            						<a href='".base_url()."Pendaftaran/ubahPeserta/".$p->nim."' class='btn btn-sm btn-link'  title='Ubah data'><span class='glyphicon glyphicon-pencil'></span></a>";
                            	?>
													<a href="<?php echo base_url() ?>Pendaftaran/hapusPeserta/<?php echo $p->nim ?>" class='btn btn-sm btn-link' onclick="return confirm('Apakah anda yakin menghapus data ini?')" title='hapus data'><span class="glyphicon glyphicon-trash"></span></a>
								<?php 
                            			echo	"</td>
                            				</tr>";
                            				$no++;
                            		}
                            	 ?>
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
