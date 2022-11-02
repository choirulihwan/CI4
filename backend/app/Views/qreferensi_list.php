<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-3">

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills pull-right">
                <li class="nav-item">
                    <a title="Tambah pelajaran" href="<?=site_url('manref/new')?>" class="btn btn-success"><i
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
                    <div style="overflow-x:auto">
                    <table class="table table-striped" id="mytable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Group</th>
                                <th scope="col">No. Ref</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Label</th>
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
                                <td><?=$v['id_ref']?></td>
                                <td><?=$v['no_ref']?></td>
                                <td><?=$v['keterangan']?></td>
                                <td><?=$v['keterangan_label']?></td>
                                <td class="text-center">
                                    <a title="Edit" href="<?=site_url('manref/edit/'.$v['id'])?>"
                                        class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
                                    <a title="Delete" data-href="<?=site_url('manref/delete/'.$v['id'])?>"
                                        onclick="confirmToDelete(this)" class="btn btn-danger"><i
                                            class="fa fa-trash-o"></i>
                                    </a>
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
    $('#mytable').DataTable();
});

function confirmToDelete(el) {
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
</script>

<?= $this->endSection() ?>