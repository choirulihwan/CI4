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
        <h2><?=$judul?> Pertanyaan</h2>
    </div>
    <hr/>
    <form method="post" action="">
        <?php 
        if ($uri->getSegment(2) === 'edit'):            
        ?>  
            <input type="hidden" name="id" value="<?=$question['id'] ?>" />
        <?php 
        endif;
        ?>
        
        <div class="form-group row">
            <label for="question" class="col-sm-2 col-form-label">Mata Pelajaran</label>
            <div class="col-sm-10">
                <select class="form-control" name="category" id="category">
                    <?php 
                    $selected = '';
                    foreach($cat as $v):  
                        if ($uri->getSegment(2) === 'edit'):                      
                            if($v['id'] == $question['id_category']):
                                $selected = 'selected';
                            else:
                                $selected = '';
                            endif;
                        endif;
                    ?>
                        <option value="<?=$v['id']?>" <?=$selected?>><?=$v['category']?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="question" class="col-sm-2 col-form-label">Pertanyaan</label>
            <div class="col-sm-10">
                <!-- <input type="text" class="form-control" id="question" name="question" placeholder="Input Pertanyaan" value="<?=($uri->getSegment(2) === 'edit') ? $question['title'] : '' ?>" required> -->
                <textarea name="question" id="question" rows="10" cols="80" required>
                <?=($uri->getSegment(2) === 'edit') ? $question['title'] : '' ?>
                </textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="question" class="col-sm-2 col-form-label">Pilihan Jawaban</label>
            <div class="col-sm-10">
                <input type="text" class="form-control mb-1" name="pilihan[]" placeholder="Pilihan a" value="<?=($uri->getSegment(2) === 'edit') ? $options[0]['title'] : ''?>">
                <input type="text" class="form-control mb-1" name="pilihan[]" placeholder="Pilihan b" value="<?=($uri->getSegment(2) === 'edit') ? $options[1]['title'] : ''?>">
                <input type="text" class="form-control" name="pilihan[]" placeholder="Pilihan c" value="<?=($uri->getSegment(2) === 'edit') ? $options[2]['title'] : ''?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Jawaban Benar</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="answer" name="answer" placeholder="Isi dengan [a, b, c, d]" value="<?=($uri->getSegment(2) === 'edit') ? $question['answer'] : ''?>" required>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                <a href="<?=site_url('manquiz')?>" class="btn btn-secondary"><i class="fa fa-home"></i> Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>    
    CKEDITOR.replace( 'question' );
</script>

<?= $this->endSection() ?>