<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<?php 
$uri = service('uri'); 
if ($uri->getSegment(2) === 'edit'):
    $judul = 'Update';
else:
    $judul = 'Tambah';
endif;
?>
<div class="container mt-3">
    <form method="post" action="">
        <div class="card">
            <div class="card-header">
                <h6><?=$judul?> Referensi</h6>
            </div>

            <div class="card-body">

                <?php         
                if ($uri->getSegment(2) === 'edit'):
                ?>
                <input type="hidden" name="id" value="<?=$referensi['id'] ?>" />
                <?php 
                endif;
                ?>

                <div class="form-group row">
                    <label for="id_ref" class="col-sm-2 col-form-label">Kode Referensi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_ref" name="id_ref" maxlength="3"
                            placeholder="Input Kode Referensi"
                            value="<?=($uri->getSegment(2) === 'edit') ? $referensi['id_ref'] : '' ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no_ref" class="col-sm-2 col-form-label">No. Referensi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_ref" name="no_ref"
                            placeholder="Input No. Referensi"
                            value="<?=($uri->getSegment(2) === 'edit') ? $referensi['no_ref'] : '' ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Nama Referensi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Input keterangan"
                            value="<?=($uri->getSegment(2) === 'edit') ? $referensi['keterangan'] : '' ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan_label" class="col-sm-2 col-form-label">Keterangan Label</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan_label" name="keterangan_label"
                            placeholder="Input label"
                            value="<?=($uri->getSegment(2) === 'edit') ? $referensi['keterangan_label'] : '' ?>">
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <a href="<?=site_url('manref')?>" class="btn btn-secondary pull-right"><i
                        class="fa fa-home"></i> Cancel</a>
                <button type="submit" class="btn btn-success pull-right mr-1"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>