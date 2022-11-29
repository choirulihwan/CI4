<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="card">
            <div class="card-header">
                <h6><?=$judul?></h6>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="old_pass" class="col-sm-2 col-form-label">Password lama</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?=($validation->hasError('old_pass') ? 'is-invalid' : '')?>" id="old_pass" name="old_pass"
                            placeholder="Input password lama"
                            required autofocus>
                        
                        <?php 
                        if ($validation->hasError('old_pass')):
                        ?>
                            <div class="invalid-feedback d-block">
                               <?=$validation->getError('old_pass');?>
                            </div> 
                        <?php 
                        endif; 
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?=($validation->hasError('pass') ? 'is-invalid' : '')?>" id="pass" name="pass"
                            placeholder="Input password baru"
                            required>
                        
                        <?php 
                        if ($validation->hasError('pass')):
                        ?>
                            <div class="invalid-feedback d-block">
                               <?=$validation->getError('pass');?>
                            </div> 
                        <?php 
                        endif; 
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm_pass" class="col-sm-2 col-form-label">Password Konfirmasi</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?=($validation->hasError('confirm_pass') ? 'is-invalid' : '')?>" id="confirm_pass" name="confirm_pass"
                            placeholder="Input password konfirmasi"
                            required>                        
                        <?php 
                        if ($validation->hasError('confirm_pass')):
                        ?>
                            <div class="invalid-feedback d-block">
                               <?=$validation->getError('confirm_pass');?>
                            </div> 
                        <?php 
                        endif; 
                        ?>
                        
                    </div>
                </div>
            </div>

            
            <div class="card-footer text-muted">
                <a href="<?=site_url('/')?>" class="btn btn-secondary pull-right"><i
                        class="fa fa-home"></i>Cancel</a>
                <button type="submit" class="btn btn-success pull-right mr-1"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>