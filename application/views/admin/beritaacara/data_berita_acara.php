<!-- Modal Add Berita Acara -->
<div class="modal fade" id="modalAddBeritaAcara" tabindex="-1" aria-labelledby="modalAddBeritaAcaraLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddBeritaAcaraLabel">Tambah Berita Acara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('beritaacara/create_berita_acara') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="add_jenis_bansos" class="form-label">Jenis Bansos</label>
                                <select class="form-control" id="add_jenis_bansos" name="jenis_bansos" required>
                                    <option value="" selected disabled>- Pilih Jenis Bansos -</option>
                                    <!-- Add options dynamically from database or use static options -->
                                    <!-- Example: -->
                                    <option value="PKH">PKH (Program Keluarga Harapan)</option>
                                    <option value="BPNT">BPNT (Bantuan Pangan Non Tunai)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_tahun" class="form-label">Tahun</label>
                                <select class="form-control" name="tahun" id="yearpicker" required>
                                    <option value="" selected disabled>- Pilih Tahun -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="add_provinsi" class="form-label">Provinsi</label>
                                <select class="form-control" id="add_provinsi" name="id_provinsi" required>
                                    <option value="" selected disabled>- Pilih Provinsi -</option>
                                    <?php foreach ($provinsi as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_kabupaten" class="form-label">Kabupaten</label>
                                <select class="form-control" id="add_kabupaten" name="id_kabupaten" required>
                                    <option value="" selected disabled>- Pilih Kabupaten -</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control" id="add_kecamatan" name="id_kecamatan" required>
                                    <option value="" selected disabled>- Pilih Kecamatan -</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="add_kelurahan" class="form-label">Kelurahan</label>
                                <select class="form-control" id="add_kelurahan" name="id_kelurahan" required>
                                    <option value="" selected disabled>- Pilih Kelurahan -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
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
                <th class="text-center" width="5%">No</th>
                <th>Jenis Bansos</th>
                <th>Tahun</th>
                <th>Provinsi</th>
                <th>Kabupaten/Kota</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th width="10%">Tgl. Dibuat</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- php foreach -->
            <?php $no=1; foreach ($data as $key => $value) { ?>
            <tr>
                <td class="align-middle text-center"><?= $no ?></td>
                <td class="align-middle"><?= $value->jenis_bansos ?></td>
                <td class="align-middle"><?= $value->tahun ?></td>
                <td class="align-middle text-capitalize"><?= $value->nama_provinsi ?></td>
                <td class="align-middle text-capitalize"><?= $value->nama_kabupaten ?></td>
                <td class="align-middle text-capitalize"><?= $value->nama_kecamatan ?></td>
                <td class="align-middle text-capitalize"><?= $value->nama_kelurahan ?></td>
                <!-- FORMAT TGL -->
                <td class="align-middle">
                    <?= date_format(date_create($value->created_at), "d-m-Y H:i:s") ?>
                </td>
                <td>
                    <!-- Edit Berita Acara -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-primary"
                    href="<?= base_url('beritaacara/edit_berita_acara/' . $value->id) ?>">
                        <i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"></i>
                    </a>

                    <!-- Delete Berita Acara -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="modal"
                        data-bs-target="#modalDeleteBeritaAcara<?= $value->id ?>">
                        <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Hapus"></i>
                    </a>

                    <!-- Modal Berita Acara -->
                    <div class="modal fade" id="modalDeleteBeritaAcara<?= $value->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteBeritaAcaraLabel">Hapus Berita Acara ID :
                                        <?= $value->id ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apa anda yakin ingin menghapus <b>Berita Acara</b> ini?<br>
                                        <span class="text-danger">Perhatian! Data yang sudah dihapus tidak dapat
                                            dikembalikan!</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href="<?= base_url('beritaacara/delete_berita_acara/' . $value->id) ?>"
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

<!-- AJAX Req -->
<script>
      // AJAX request for Kabupaten
      $(document).ready(function () {
        $('#add_provinsi').on('change', function () {
            var provinsiId = $(this).val();
            if (provinsiId) {
                // Make an AJAX request to fetch the related Kabupaten data
                $.ajax({
                    url: '<?= base_url('wilayah/get_kabupaten ') ?>',
                    type: 'POST',
                    data: {
                        provinsi_id: provinsiId
                    },
                    success: function (data) {
                        // reset kecamatan
                        $('#add_kecamatan').html(
                            '<option value="" selected disabled>- Pilih Kecamatan -</option>'
                        );
                        // reset kabupaten
                        $('#add_kelurahan').html(
                            '<option value="" selected disabled>- Pilih Kelurahan -</option>'
                        );
                        // Update the Kabupaten select input with the retrieved data
                        $('#add_kabupaten').html(data);
                    }
                });
            } else {
                // Clear the Kabupaten select input if no Provinsi is selected
                $('#add_kabupaten').html(
                    '<option value="" selected disabled>- Pilih Kabupaten -</option>');
            }
        });
    });

    // AJAX request for Kecamatan
    $(document).ready(function () {
        $('#add_kabupaten').on('change', function () {
            var kabupatenId = $(this).val();
            if (kabupatenId) {
                // Make an AJAX request to fetch the related Kecamatan data
                $.ajax({
                    url: '<?= base_url('wilayah/get_kecamatan ') ?>',
                    type: 'POST',
                    data: {
                        kabupaten_id: kabupatenId
                    },
                    success: function (data) {
                        // reset
                        $('#add_kelurahan').html(
                            '<option value="" selected disabled>- Pilih Kelurahan -</option>'
                        );
                        // Update the Kecamatan select input with the retrieved data
                        $('#add_kecamatan').html(data);
                    }
                });
            } else {
                // Clear the Kecamatan select input if no Kabupaten is selected
                $('#add_kecamatan').html(
                    '<option value="" selected disabled>- Pilih Kecamatan -</option>');
            }
        });
    });

    // AJAX request for Kelurahan
    $(document).ready(function () {
        $('#add_kecamatan').on('change', function () {
            var kecamatanId = $(this).val();
            if (kecamatanId) {
                // Make an AJAX request to fetch the related Kelurahan data
                $.ajax({
                    url: '<?= base_url('wilayah/get_kelurahan ') ?>',
                    type: 'POST',
                    data: {
                        kecamatan_id: kecamatanId
                    },
                    success: function (data) {
                        // Update the Kelurahan select input with the retrieved data
                        $('#add_kelurahan').html(data);
                    }
                });
            } else {
                // Clear the Kelurahan select input if no Kecamatan is selected
                $('#add_kelurahan').html('<option value="" selected disabled>- Pilih Kelurahan -</option>');
            }
        });
    });
</script>

<!-- get current year and previous years -->
<script type="text/javascript">
    $(document).ready(function () {
        var start = 1900;
        var end = new Date().getFullYear();
        var options = "";
        for (var year = end; year >= start; year--) {
            options += "<option>" + year + "</option>";
        }
        $('#yearpicker').html(options);
    });
</script>