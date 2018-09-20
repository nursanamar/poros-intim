    <div class="container">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Form Tambah Peserta</span>
            </li>
        </ul>
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet box blue ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Form Tambah Peserta</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <?php echo form_open_multipart('Pendaftaran/tambahPeserta', array('class'=>'form-horizontal')); ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nim</label>
                                        <div class="col-md-9">
                                            <input type="text" name="nim" class="form-control" required placeholder="Enter text">
                                            <input type="hidden" name="id_cabang" value="<?php echo $this->uri->segment(3) ?>" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama</label>
                                        <div class="col-md-9">
                                            <input type="text" required name="nama" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Jurusan</label>
                                        <div class="col-md-9">
                                            <input type="text" required name="jurusan" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fakultas</label>
                                        <div class="col-md-9">
                                            <input type="text" required name="fakultas" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" class="col-md-3 control-label">Kartu Tanda Mahasiswa</label>
                                        <div class="col-md-9">
                                            <input type="file" name="ktm" required>
                                            <p>Hanya file dengan ekstensi .pdf</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" class="col-md-3 control-label">Surat Aktif Kuliah</label>
                                        <div class="col-md-9">
                                            <input type="file" name="surat_aktif" required>
                                            <p>Hanya file dengan ekstensi .pdf</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" class="col-md-3 control-label">Surat Rekomendasi Dari Pimpinan</label>
                                        <div class="col-md-9">
                                            <input type="file" name="rekomendasi" required>
                                             <p>Hanya file dengan ekstensi .pdf</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" class="col-md-3 control-label">Foto</label>
                                        <div class="col-md-9">
                                            <input type="file" accept="jpg" required name="foto">
                                            <p>Hanya file dengan ekstensi .jpg atau .png</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile" class="col-md-3 control-label">Bukti Dari Dikti</label>
                                        <div class="col-md-9">
                                            <input type="file" required name="dikti">
                                            <p>Hanya file dengan ekstensi .jpg atau .png</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" name="submit" class="btn green">Simpan</button>
                                            <?php echo anchor('Pendaftaran', 'Kembali', array('class'=>'btn default')) ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
</div>
