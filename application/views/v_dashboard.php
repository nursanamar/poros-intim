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
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Ilmiah</label>
                                                            <div class="input-group">
                                                                <div class="icheck-inline">
                                                                    <?php 
                                                                        foreach ($ilmiah->result() as $i) {
                                                                    ?>
                                                                    <label>
                                                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-red" data-label="<?php echo $i->nama_cabang ?>" value="<?php echo $i->id_cabang ?>" name="cabang[]"> 
                                                                    </label>
                                                                    <?php        
                                                                        }
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Olahraga</label>
                                                            <div class="input-group">
                                                                <div class="icheck-inline">
                                                                    <?php 
                                                                        foreach ($olahraga->result() as $o) {
                                                                    ?>
                                                                    <label>
                                                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-green" data-label="<?php echo $o->nama_cabang ?>" value="<?php echo $o->id_cabang ?>" name="cabang[]"> 
                                                                    </label>
                                                                    <?php        
                                                                        }
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Seni</label>
                                                            <div class="input-group">
                                                                <div class="icheck-inline">
                                                                    <?php 
                                                                        foreach ($seni->result() as $s) {
                                                                    ?>
                                                                    <label>
                                                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-orange" data-label="<?php echo $s->nama_cabang ?>" value="<?php echo $s->id_cabang ?>" name="cabang[]"> 
                                                                    </label>
                                                                    <?php        
                                                                        }
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <label class="control-label">Riset</label>
                                                            <div class="input-group">
                                                                <div class="icheck-inline">
                                                                    <?php 
                                                                        foreach ($riset->result() as $r) {
                                                                    ?>
                                                                    <label>
                                                                        <input type="checkbox" class="icheck" data-checkbox="icheckbox_line-blue" data-label="<?php echo $r->nama_cabang ?>" value="<?php echo $r->id_cabang ?>" name="cabang[]"> 
                                                                    </label>
                                                                    <?php        
                                                                        }
                                                                     ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
