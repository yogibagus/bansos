<div class="modal fade" id="modalAddMasterPenyaluran" tabindex="-1" aria-labelledby="modalAddMasterPenyaluranLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddMasterPenyaluranLabel">Tambah Master Penyaluran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('penyaluran/create_master_penyaluran') ?>" method="post">
                    <div class="row">
                        <div class="mb-3">
                            <label for="add_nama" class="form-label">Nama Master Penyaluran</label>
                            <input type="text" class="form-control" id="add_nama" name="nama" placeholder="Nama"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="add_nama" class="form-label">CO Magang </label>
                            <select class="form-select" aria-label="Default select example" name="id_user" required>
                                <option value='' selected disabled>Pilih CO Magang</option>
                                <option value="-1">Semua CO Magang</option>
                                <?php foreach ($user as $key => $value) { ?>
                                <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan <i class="fas fa-save    "></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card container p-5">
    <table class="table table-striped table-hover fw-bold" id="dataTables">
        <thead class="thead-inverse bg-dark text-white">
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>CO Magang</th>
                <th>Dibuat Oleh</th>
                <th width="15%">Tgl. Dibuat</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- php foreach -->
            <?php $no=1; foreach ($data as $key => $value) { ?>
            <tr>
                <td class="align-middle text-center"><?= $no ?></td>
                <td class="align-middle"><?= $value->nama ?></td>
                <td class="align-middle">
                    <?php if ($value->id_user == -1) { ?>
                    Semua CO Magang
                    <?php } else { 
                        if ($value->nama_user_assigned != null) {
                            echo $value->nama_user_assigned;
                        } else {
                            echo "<i>Unassigned</i>";
                        }
                    } ?>
                </td>
                <td class="align-middle"><?= $value->nama_user ?></td>
                <!-- FORMAT TGL -->
                <td class="align-middle">
                    <?= date_format(date_create($value->created_at), "d-m-Y H:i:s") ?>
                </td>
                <td>
                    <!-- Tambah Data Penyaluran -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-dark" id="btnTambahPenyaluran<?= $value->id ?>"
                        href="<?= base_url('penyaluran/data_bansos/' . $value->id) ?>">
                        <i class="fa fa-plus" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tambah Data Penyaluran"></i>
                    </a>

                    <!-- script to delete local storage checkedValues value->id -->
                    <script>
                        $(document).ready(function () {
                            $('#btnTambahPenyaluran<?= $value->id ?>').click(function () {
                                localStorage.removeItem('checkedValues<?= $value->id ?>');
                                console.log('removing checkedValues<?= $value->id ?>');
                            });
                        });
                    </script>

                    <!-- Detail Penyaluran -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-success">
                        <i class="fa fa-external-link" aria-hidden="true" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Detail Penyaluran"></i>
                    </a>

                    <!-- Edit Penyaluran -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEditMasterPenyaluran<?= $value->id ?>">
                        <i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"></i>
                    </a>

                    <!-- Modal Edit Penyaluran -->
                    <div class="modal fade" id="modalEditMasterPenyaluran<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditMasterPenyaluran">Edit Data Penyaluran -
                                        <?= $value->nama ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <?php if ($value->updated_at != null) { ?>
                                    <div class="alert alert-info" role="alert">
                                        <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong> Terakhir
                                        diupdate oleh <b><?= $value->nama_user_updated ?></b> pada
                                        <b><?= date_format(date_create($value->updated_at), "d-m-Y H:i:s") ?></b>
                                    </div>
                                    <?php } ?>
                                    <!-- form update -->
                                    <form action="<?= base_url('penyaluran/update_master_penyaluran/'.$value->id) ?>"
                                        method="post">
                                        <div class="mb-3">
                                            <label for="edit_nama" class="form-label">Nama Master Penyaluran</label>
                                            <input type="text" class="form-control" id="edit_nama" name="nama"
                                                value="<?= $value->nama ?>" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Penyaluran -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="modal"
                        data-bs-target="#modalDeleteMasterPenyaluran<?= $value->id ?>">
                        <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Hapus"></i>
                    </a>

                    <!-- Modal Delete Penyaluran -->
                    <div class="modal fade" id="modalDeleteMasterPenyaluran<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteBMasterPenyaluran">Hapus Penyaluran ID :
                                        <?= $value->id ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apa anda yakin ingin menghapus <b>Data Penyaluran</b> ini?<br>
                                        <span class="text-danger">Perhatian! Data yang sudah dihapus tidak dapat
                                            dikembalikan!</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href="<?= base_url('penyaluran/delete_master_penyaluran/' . $value->id) ?>"
                                        class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
</div>

<!-- config datatables -->
<script>
    $(document).ready(function () {
        $('#dataTables').DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    });
</script>