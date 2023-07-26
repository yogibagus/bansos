<div class="modal fade" id="modalAddMasterBansos" tabindex="-1" aria-labelledby="modalAddMasterBansosLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddMasterBansosLabel">Tambah Master Bansos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('bansos/create_master_bansos') ?>" method="post">
                    <div class="row">
                        <div class="mb-3">
                            <label for="add_nama" class="form-label">Nama Master Bansos</label>
                            <input type="text" class="form-control" id="add_nama" name="nama" placeholder="Nama"
                                required>
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
                <th width="15%">Total Data Bansos</th>
                <th>Pending</th>
                <th>Tersalur</th>
                <th>Tidak Tersalur</th>
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
                <td class="align-middle text-center">
                    <span class="badge bg-primary text-light">
                        <?= $value->jumlah_bansos ?>
                    </span>
                </td>
                <td class="align-middle text-center">
                    <span class="badge bg-warning text-light">
                        <?= $value->jumlah_bansos_belum_tersalur ?>
                    </span>
                </td>
                <td class="align-middle text-center">
                    <span class="badge bg-success text-light">
                        <?= $value->jumlah_bansos_tersalur ?>
                    </span>
                </td>
                <td class="align-middle text-center">
                    <span class="badge bg-danger text-light">
                        <?= $value->jumlah_bansos_tidak_tersalur ?>
                    </span>
                </td>
                <td class="align-middle"><?= $value->nama_user ?></td>
                <!-- FORMAT TGL -->
                <td class="align-middle">
                    <?= date_format(date_create($value->created_at), "d-m-Y H:i:s") ?>
                </td>
                <td>
                    <!-- Import Data Bansos -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-success" data-bs-toggle="modal"
                        data-bs-target="#modalImportDataBansos<?= $value->id ?>">
                        <i class="fas fa-file-excel" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Import Data"></i>
                    </a>

                    <!--  Modal Import Data Bansos  -->
                    <div class="modal fade" id="modalImportDataBansos<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditMasterBansos">Import Data Bansos -
                                        <?= $value->nama ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- form upload excel -->
                                    <div class="alert alert-primary" role="alert">
                                        <strong>Perhatian!</strong> Pastikan file yang diupload adalah file excel
                                        (.xls/.xlsx) dan sesuai dengan format yang telah ditentukan.
                                    </div>
                                    <!-- Download format -->
                                    <div class="mb-3">
                                        <label for="download_format" class="form-label">Download Format:</label>
                                        <br>
                                        <a href="<?= base_url('bansos/download_format_bansos') ?>"
                                            class="btn btn-sm btn-primary">Download</a>
                                    </div>
                                    <!-- Import File -->
                                    <div class="mb-3">
                                        <label for="import_data_bansos" class="form-label">File Excel:</label>
                                        <input type="file" class="form-control" id="import_data_bansos<?= $value->id ?>"
                                            name="file" accept=".xls,.xlsx" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary"
                                            id="btn_import_data_bansos<?= $value->id ?>">Import</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ajax for import excel -->
                    <script>
                        $(document).ready(function () {
                            $('#btn_import_data_bansos<?= $value->id ?>').click(function (e) {
                                // close all modal
                                $('.modal').modal('hide');
                                // show loading
                                Swal.fire({
                                    title: 'Loading',
                                    html: 'Mohon menunggu, sedang mengimport data...',
                                    allowOutsideClick: false,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                    },
                                });

                                var formData = new FormData();
                                var file = $('#import_data_bansos<?= $value->id ?>')[0].files[0];
                                formData.append('file', file);
                                $.ajax({
                                    url: "<?= base_url('bansos/import_data_bansos/' . $value->id) ?>",
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function (data) {
                                        console.log(data);
                                        // convert
                                        data = JSON.parse(data);
                                        // data return array contain error, message, status
                                        if (data.status == true) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data.message,
                                                showConfirmButton: false,
                                                allowOutsideClick: false,
                                                timer: 1500
                                            }).then(function () {
                                                location.reload();
                                            });
                                        } else {
                                            console.log("tes", data);
                                            Swal.fire({
                                                icon: 'error',
                                                title: data.message,
                                                text: data.error,
                                                showConfirmButton: false,
                                                timer: 5000
                                            });
                                        }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Terjadi kesalahan!',
                                            showConfirmButton: false
                                        });
                                        console.log(xhr.status + "\n" + xhr.responseText +
                                            "\n" + thrownError);
                                    }
                                });
                            });
                        });
                    </script>


                    <!-- Edit Bansos -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEditMasterBansos<?= $value->id ?>">
                        <i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"></i>
                    </a>

                    <!-- Modal Edit Bansos -->
                    <div class="modal fade" id="modalEditMasterBansos<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditMasterBansos">Edit Data Bansos -
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
                                    <form action="<?= base_url('bansos/update_master_bansos/'.$value->id) ?>"
                                        method="post">
                                        <div class="mb-3">
                                            <label for="edit_nama" class="form-label">Nama Master Bansos</label>
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

                    <!-- Delete Bansos -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="modal"
                        data-bs-target="#modalDeleteMasterBansos<?= $value->id ?>">
                        <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Hapus"></i>
                    </a>

                    <!-- Modal Delete Bansos -->
                    <div class="modal fade" id="modalDeleteMasterBansos<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteBMasterBansos">Hapus Bansos ID :
                                        <?= $value->id ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apa anda yakin ingin menghapus <b>Data Bansos</b> ini?<br>
                                        <span class="text-danger">Perhatian! Data yang sudah dihapus tidak dapat
                                            dikembalikan!</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href="<?= base_url('bansos/delete_master_bansos/' . $value->id) ?>"
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