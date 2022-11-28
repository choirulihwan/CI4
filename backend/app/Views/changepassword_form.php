<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-3">
    <form method="post" action="">
        <div class="card">
            <div class="card-header">
                <h6><?=$judul?></h6>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="old_pass" class="col-sm-2 col-form-label">Password lama</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="old_pass" name="old_pass"
                            placeholder="Input password lama"
                            required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="old_pass" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="pass" name="pass"
                            placeholder="Input password baru"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm_pass" class="col-sm-2 col-form-label">Password Konfirmasi</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_pass" name="confirm_pass"
                            placeholder="Input password konfirmasi"
                            required>
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