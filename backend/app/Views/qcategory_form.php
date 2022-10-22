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
                <h6><?=$judul?> Mata pelajaran</h6>
            </div>

            <div class="card-body">

                <?php         
                if ($uri->getSegment(2) === 'edit'):
                ?>
                <input type="hidden" name="id" value="<?=$category['id'] ?>" />
                <?php 
                endif;
                ?>

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Nama Matapelajaran</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="category" name="category"
                            placeholder="Input Mata pelajaran"
                            value="<?=($uri->getSegment(2) === 'edit') ? $category['category'] : '' ?>" required>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted">
                <a href="<?=site_url('mancategory')?>" class="btn btn-secondary pull-right"><i
                        class="fa fa-home"></i>Cancel</a>
                <button type="submit" class="btn btn-success pull-right mr-1"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>