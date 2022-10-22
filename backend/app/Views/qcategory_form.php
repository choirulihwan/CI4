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
<div class="container">
    <div class="row">
        <h2><?=$judul?> Mata pelajaran</h2>
    </div>
    <hr/>
    <form method="post" action="">
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
                <input type="text" class="form-control" id="category" name="category" placeholder="Input Mata pelajaran" value="<?=($uri->getSegment(2) === 'edit') ? $category['category'] : '' ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                <a href="<?=site_url('mancategory')?>" class="btn btn-secondary"><i class="fa fa-home"></i> Cancel</a>
            </div>
        </div>
    </form>
</div>


<?= $this->endSection() ?>