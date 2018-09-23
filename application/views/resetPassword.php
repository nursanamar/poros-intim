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
                                <span class="caption-subject font-dark sbold uppercase">Reset password</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <form onsubmit="check()" action="<?php echo site_url('ADashboard/passReset') ?>" class="form-horizontal" method="POST">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password Baru</label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" class="form-control" required placeholder="Enter text">
                                            <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Konfirmasi Password Baru</label>
                                        <div class="col-md-9">
                                            <span id="alert" style="display: none;color: red;">Password tidak sama</span>
                                            <input onchange="check()" type="password" required name="confirmPass" class="form-control" placeholder="Enter text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" name="submit" class="btn green">Simpan</button>
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

<script>

    function check(e){
        let pass = $('input[name=password]').val();
        let confirm = $('input[name=confirmPass]').val();
        if(!(pass === confirm)){
            $("button[name=submit]").attr('disabled','true');
            $("#alert").show();
        }else{
            $("button[name=submit]").removeAttr('disabled');
            $("#alert").hide();            
        }
    }

</script>
