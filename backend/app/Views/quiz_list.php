<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-3">
    
    <div class="card">
        <form method="post" action="">
        <div class="card-header">
            Filter Pertanyaan
        </div>
        <div class="card-body">
            <h5 class="card-title"></h5>
            
                <div class="form-group row">
                    <label for="question" class="col-sm-2 col-form-label">Pelajaran</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category" id="category">
                            <?php 
                    $selected = '';
                    foreach($cat as $v): 
                            if($v['id'] == $cat_selected):
                                $selected = 'selected';
                            else:
                                $selected = '';
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
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kelas" id="kelas">
                    <?php 
                    $myconfig = new \Config\MyConfig();
                    $kelas = $myconfig->kelas;
                    
                    foreach($kelas as $v):
                        if($v['id'] == $kelas_selected):
                            $selected = 'selected';
                        else:
                            $selected = '';
                        endif;
                        
                    ?>
                            <option value="<?=$v['id']?>" <?=$selected?>><?=$v['nama']?></option>
                            <?php
                    endforeach;
                    ?>
                        </select>
                    </div>
                </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tampilkan</button>
        </div>
        </form>
    </div>
    

    <hr />
    <div class="card">
        <div class="card-header">
            <!-- Pertanyaan -->
            <ul class="nav nav-pills card-header-pills pull-right">               
                <li class="nav-item">
                    <a title="Tambah Pertanyaan" href="<?=site_url('manquiz/new/'.$cat_selected.'/'.$kelas_selected)?>" class="btn btn-success"><i
                            class="fa fa-plus"></i> Tambah</a>
                </li>                
            </ul>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-12 text-right"></div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <!-- <div style="overflow-x:auto"> -->
                    <table class="table table-striped nowrap" id="mytable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Jawaban</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                $no=0;
                foreach($data as $k => $v):
                    $no++;
                ?>
                            <tr>
                                <th scope="row"><?=$no?></th>
                                <td class="text-center">
                                    <a title="Edit" href="<?=site_url('manquiz/edit/'.$v['id'])?>"
                                        class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
                                    <a title="Delete" data-href="<?=site_url('manquiz/delete/'.$v['id'])?>"
                                        onclick="confirmToDelete(this)" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                                <td><?=$v['title']?></td>
                                <td class="text-center"><?=$v['answer']?></td>
                                
                            </tr>
                            <?php 
                endforeach;
                ?>
                        </tbody>
                    </table>
                    <!-- </div> -->                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="h2">Are you sure?</h2>
                <p>The data will be deleted and lost forever</p>
            </div>
            <div class="modal-footer">
                <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#mytable').DataTable({
        "scrollX": true
    });
});

function confirmToDelete(el) {
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
</script>

<?= $this->endSection() ?>