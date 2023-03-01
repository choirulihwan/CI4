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
        <?php 
    if ($uri->getSegment(2) === 'edit'):            
    ?>
        <input type="hidden" name="id" value="<?=$question['id'] ?>" />
        <?php 
    endif;
    ?>

        <div class="card">
            <div class="card-header">
                <h6><?=$judul?> Pertanyaan</h6>
            </div>
            <div class="card-body">
            <div class="form-group row">
                    <label for="sekolah" class="col-sm-2 col-form-label">Sekolah</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="sekolah" id="sekolah">
                            <?php 
                    $sekolah_selected = '';
                    
                    foreach($sekolah as $v):  
                        if ($uri->getSegment(2) === 'edit'):                      
                            if($v->id == $question['sekolah']):
                                $sekolah_selected = 'selected';
                            else:
                                $sekolah_selected = '';
                            endif;
                        endif;
                    ?>
                            <option value="<?=$v->id?>" <?=$sekolah_selected?>><?=$v->keterangan?></option>
                            <?php
                    endforeach;
                    ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kelas" id="kelas">
                    <?php 
                    $myconfig = new \Config\MyConfig();
                    $kelas = $myconfig->kelas;
                    
                    $kelas_selected = '';
                    foreach($kelas as $v):  
                        if ($uri->getSegment(2) === 'edit'):                      
                            if($v['id'] == $question['kelas']):
                                $kelas_selected = 'selected';
                            else:
                                $kelas_selected = '';
                            endif;
                        elseif ($uri->getSegment(2) === 'new'):
                            if($v['id'] == $id_kelas):
                                $kelas_selected = 'selected';
                            else:
                                $kelas_selected = '';
                            endif; 
                        endif;
                    ?>
                            <option value="<?=$v['id']?>" <?=$kelas_selected?>><?=$v['nama']?></option>
                            <?php
                    endforeach;
                    ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="question" class="col-sm-2 col-form-label">Pelajaran</label>
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
                        elseif ($uri->getSegment(2) === 'new'):
                            if($v['id'] == $id_cat):
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
                    <label for="question" class="col-sm-2 col-form-label">Jenis pertanyaan</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="jns" id="jns">
                    <?php 
                    $jns_selected = '';
                    $arr_jns = ['1' => 'Pilihan Ganda', '2' => 'Isian'];
                    
                    foreach($arr_jns as $k => $v):  
                        if ($uri->getSegment(2) === 'edit'):                      
                            if($k == trim($question['jns_pertanyaan'])):
                                $jns_selected = 'selected';
                            else:
                                $jns_selected = '';
                            endif;
                        endif;
                    ?>
                            <option value="<?=$k?>" <?=$jns_selected?>><?=$v?></option>
                            <?php
                    endforeach;
                    ?>
                        </select>
                    </div>
                </div>

                    <div class="form-group row">
                        <label for="question" class="col-sm-2 col-form-label">Pilihan Jawaban</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control mb-1" name="pilihan[]" placeholder="Pilihan a"
                                value="<?=(($uri->getSegment(2) === 'edit') && ($question['jns_pertanyaan'] === '1')) ? str_replace('"', '&quot;', str_replace('<', '&lt;', str_replace('>', '&gt;', $options[0]['title']))) : ''?>">
                            <input type="text" class="form-control mb-1" name="pilihan[]" placeholder="Pilihan b"
                                value="<?=(($uri->getSegment(2) === 'edit') && ($question['jns_pertanyaan'] === '1')) ? str_replace('"', '&quot;', str_replace('<', '&lt;', str_replace('>', '&gt;', $options[1]['title']))) : ''?>">
                            <input type="text" class="form-control mb-1" name="pilihan[]" placeholder="Pilihan c"
                                value="<?=(($uri->getSegment(2) === 'edit') && ($question['jns_pertanyaan'] === '1')) ? str_replace('"', '&quot;', str_replace('<', '&lt;', str_replace('>', '&gt;', $options[2]['title']))) : ''?>">
                            <input type="text" class="form-control" name="pilihan[]" placeholder="Pilihan d"
                                value="<?=(($uri->getSegment(2) === 'edit') && (count($options) == 4) && ($question['jns_pertanyaan'] === '1')) ? str_replace('"', '&quot;', str_replace('<', '&lt;', str_replace('>', '&gt;', $options[3]['title']))) : ''?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jawaban Benar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="answer" name="answer"
                                placeholder="Isi dengan [a, b, c, d] atau keterangan jika pertanyaan berupa isian"
                                value="<?=($uri->getSegment(2) === 'edit') ? $question['answer'] : ''?>" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?=site_url('manquiz')?>" class="btn btn-secondary pull-right"><i class="fa fa-home"></i>
                        Cancel</a>
                    <button type="submit" class="btn btn-success pull-right mr-1"><i class="fa fa-save"></i>
                        Save</button>
                </div>
            </div>
    </form>
</div>

<script>
CKEDITOR.replace('question');
</script>

<?= $this->endSection() ?>