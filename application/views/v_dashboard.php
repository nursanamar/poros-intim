<link href="<?php echo base_url() ?>template/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<div class="container">
    <!-- BEGIN PAGE BREADCRUMBS -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pilih Cabang Perlombaan</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMBS -->
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <h3>Silahkan Mencentang Cabang Perlombaan Yang Akan Diikuti Lalu Klik Simpan</h3>
                            </div>
                            <div class="portlet-body form">
                                <div class="tab-content">
                                    
                                        <div class="skin skin-line">
                                            <?php echo form_open('Dashboard/pilihCabang') ?>
                                                
                                                <?php foreach ($cabang as $nama => $list) { ?>
                                                    <div class="col-md-6">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="control-label"><?php echo $nama ?></label>
                                                                <div class="input-group">
                                                                    <!-- <div class="icheck-inline">  -->
                                                                        <select class="cabangSelect" multiple name="cabang[]">
                                                                        <?php
                                                                            foreach ($list as $item) { ?>
                                                                                <option <?php echo in_array($item['id_cabang'],$selected) ? "selected" : "" ?> value="<?php echo $item['id_cabang'] ?>"><?php echo $item['nama_cabang'] ?> </option>
                                                                                
                                                                                <?php        
                                                                            } 
                                                                            ?> 
                                                                        </select>
                                                                    <!-- </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               <?php } ?>
                                                
                                                <div class="row"></div>
                                                <div style="height:40px"></div>
                                                <div class="form-actions">
                                                    <button type="submit" name="submit" class="btn-sm btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
