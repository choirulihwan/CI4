<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <h2>List Pertanyaan</h2>
    </div>
    <hr/>
    <div class="row mb-2">
        <div class="col-sm-12 text-right"><a title="Tambah Pertanyaan" href="<?=site_url('manquiz/new')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a></div>
    </div>
    
    <div class="row">
    <div class="col-sm-12">
        <table class="table" id="mytable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>                    
                    <th scope="col">Pertanyaan</th>
                    <th scope="col">Jawaban</th>
                    <th scope="col"></th>                    
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
                    <td><?=$v['title']?></td>
                    <td class="text-center"><?=$v['answer']?></td>
                    <td class="text-center">
                        <a title="Edit" href="<?=site_url('manquiz/edit/'.$v['id'])?>" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
                        <a title="Delete" data-href="<?=site_url('manquiz/delete/'.$v['id'])?>" onclick="confirmToDelete(this)" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a>
                    </td>                    
                </tr>
                <?php 
                endforeach;
                ?>                
            </tbody>
        </table>
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
    $(document).ready(function () {
        $('#mytable').DataTable();
    }); 

    function confirmToDelete(el){
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

</script>

<?= $this->endSection() ?>