<div id="alert"></div>
<!-- Modal Add Bansos -->
<div class="modal fade" id="modalAddBansos" tabindex="-1" aria-labelledby="modalAddBansosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddBansosLabel">Tambah Data Bansos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form add -->
                <form action="<?= base_url('bansos/create_bansos/') ?>" method="post">
                    <input type="hidden" name="id_master_bansos" value="<?= $filter["id_master_bansos"] ?>"
                        id="add_id_master_bansos">
                    <input type="hidden" name="current_status" value="<?= $filter["status"] ?>">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="edit_nama" class="form-label">Nama Penerima</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama"
                                    placeholder="Nama Penerima" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_nama" class="form-label">Master Bansos</label>
                                <select class="form-control" name="id_master_bansos" id="add_id_master_bansos" required>
                                    <option value="" selected disabled>- Master Bansos -</option>
                                    <?php foreach ($master_bansos as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"
                                        <?= $filter["id_master_bansos"] == $value->id ? 'selected' : '' ?>>
                                        <?= $value->nama ?>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="edit_nik" name="nik" placeholder="NIK"
                                    required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_norek" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="edit_norek" name="norek"
                                    placeholder="Nomor Rekening" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_tahun" class="form-label">Tahun</label>
                                <select class="form-control" name="tahun" id="edit_tahun" required>
                                    <option value="" selected disabled>- Pilih Tahun -</option>
                                    <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                    <option value="<?= $i ?>">
                                        <?= $i ?>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_jenis_bansos" class="form-label">Jenis
                                    Bansos</label>
                                <select class="form-control" name="jenis_bansos" id="edit_jenis_bansos" required>
                                    <option value="" selected disabled>- Pilih Jenis Bansos -
                                    </option>
                                    <option value="PKH">
                                        PKH</option>
                                    <option value="BPNT">
                                        BPNT</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_kabupaten" class="form-label">Kabupaten</label>
                                <input type="text" class="form-control" id="edit_kabupaten" name="kabupaten"
                                    placeholder="Kabupaten" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="edit_kecamatan" name="kecamatan"
                                    placeholder="Kecamatan" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="edit_kelurahan" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="edit_kelurahan" name="kelurahan"
                                    placeholder="Kelurahan" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan <i class="fas fa-save    "></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="card container p-5 mb-3">
    <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
        <div class="">
            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                data-bs-target="#kt_accordion_3_item_1">
                <span class="accordion-icon">
                    <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span></i>
                    <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span
                            class="path2"></span></i>
                </span>
                <h4 class="fs-3 fw-bold mb-0 ms-4">Filter Pencarian <i class="fa fa-search" aria-hidden="true"></i></h4>
            </div>

            <div id="kt_accordion_3_item_1" class="fs-6 ps-0 collapse" data-bs-parent="#kt_accordion_3">
                <form action="<?= base_url('bansos/all') ?>" method="post">
                    <input type="hidden" name="status" value="<?= $filter["status"] ?>">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Master Bansos</label>
                            <select class="form-control form-control-sm" name="id" id="filter_id_master_bansos">
                                <option value="" selected disabled>- Master Bansos -</option>
                                <?php foreach ($master_bansos as $key => $value) { ?>
                                <option value="<?= $value->id ?>"
                                    <?= $filter["id_master_bansos"] == $value->id ? 'selected' : '' ?>>
                                    <?= $value->nama ?>
                                    <?php } ?>
                            </select>
                        </div>
                        <!-- drop down status -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Status</label>
                            <select class="form-control form-control-sm" name="status_penyaluran" id="filter_status">
                                <option value="" selected disabled>- Status -</option>
                                <option value="0" <?= $filter_penyaluran["status"] == '0' ? 'selected' : '' ?>>Belum
                                    Tersalur
                                </option>
                                <option value="1" <?= $filter_penyaluran["status"] == '1' ? 'selected' : '' ?>>Tersalur
                                <option value="2" <?= $filter_penyaluran["status"] == '2' ? 'selected' : '' ?>>Tidak
                                    Tersalur
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Nama Penerima</label>
                            <input type="text" class="form-control form-control-sm" name="nama"
                                value="<?= $filter["nama"] ?>" placeholder="Nama Penerima">
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">NIK</label>
                            <input type="text" class="form-control form-control-sm" name="nik"
                                value="<?= $filter["nik"] ?>" placeholder="NIK">
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Nomor Rekening</label>
                            <input type="text" class="form-control form-control-sm" name="norek"
                                value="<?= $filter["norek"] ?>" placeholder="Nomor Rekening">
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Jenis Bansos</label>
                            <select class="form-control form-control-sm" name="jenis_bansos">
                                <option value="" selected disabled>- Jenis -</option>
                                <option value="PKH" <?= $filter["jenis_bansos"] == 'PKH' ? 'selected' : '' ?>>PKH
                                </option>
                                <option value="BPNT" <?= $filter["jenis_bansos"] == 'BPNT' ? 'selected' : '' ?>>BPNT
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Tahun</label>
                            <select class="form-control form-control-sm" name="tahun">
                                <option value="" selected disabled>- Tahun -</option>
                                <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                <option value="<?= $i ?>" <?= $filter["tahun"] == $i ? 'selected' : '' ?>>
                                    <?= $i ?>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Kabupaten</label>
                            <input type="text" class="form-control form-control-sm" name="kabupaten"
                                value="<?= $filter["kabupaten"] ?>" placeholder="Kabupaten/Kota">
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control form-control-sm" name="kecamatan"
                                value="<?= $filter["kecamatan"] ?>" placeholder="Kecamatan">
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control form-control-sm" name="kelurahan"
                                value="<?= $filter["kelurahan"] ?>" placeholder="Kelurahan">
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Cari <i class="fa fa-search"
                                aria-hidden="true"></i></button>
                        <button type="button" id="reset_filter" class="btn btn-sm btn-icon btn-light-primary"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Filter"><i
                                class="fa fa-refresh" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Debuging Only -->
<!-- <div class="card m-4">
    <div class="card-body">
        <h4 class="card-title">Test</h4>
        <p class="card-text">
            <?php print_r($data); ?>
            <hr>
            <?php print_r($filter); ?>
        </p>
    </div>
</div> -->

<div class="card container p-5">
    <table class="table table-striped table-hover fw-bold" id="dataTables">
        <thead class="thead-inverse bg-dark text-white">
            <tr>
                <th width="5%" class="text-center">No</th>
                <th>Status</th>
                <th width="20%">Nama</th>
                <th>Norek</th>
                <th>NIK</th>
                <th>Tahun</th>
                <th width="15%">Nama Bansos</th>
                <th>Jenis</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Tgl Submit</th>
                <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) { ?>
                    <th width="20%">Aksi</th>
                <?php } ?>

            </tr>
        </thead>
        <tbody>
            <!-- php foreach -->
            <?php $no=1; foreach ($data as $key => $value) {?>
            <tr>
                <td class="align-middle text-center"><?= $no ?></td>
                <th class="align-middle">
                    <?php if ($value->status_penyaluran == '0') { ?>
                    <span class="badge badge-warning">Belum Tersalur</span>
                    <?php } elseif ($value->status_penyaluran == '1') { ?>
                    <span class="badge badge-success">Tersalur</span>
                    <?php } elseif ($value->status_penyaluran == '2') { ?>
                    <span class="badge badge-danger">Tidak Tersalur</span>
                    <?php } ?>
                </th>
                <td class="align-middle"><?= $value->nama ?></td>
                <td class="align-middle"><?= $value->norek ?></td>
                <td class="align-middle"><?= $value->nik ?></td>
                <td class="align-middle"><?= $value->tahun ?></td>
                <td class="align-middle"><?= $value->nama_master_bansos ?></td>
                <td class="align-middle"><?= $value->jenis_bansos ?></td>
                <td class="align-middle"><?= $value->kabupaten ?></td>
                <td class="align-middle"><?= $value->kecamatan ?></td>
                <td class="align-middle"><?= $value->kelurahan ?></td>
                <!-- FORMAT TGL -->
                <td class="align-middle">
                    <?= date_format(date_create($value->created_at), "d-m-Y H:i:s") ?>
                </td>
                <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2) { ?>
                <td>
                    <!-- Edit Bansos -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEditMasterBansos<?= $value->id ?>">
                        <i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"></i>
                    </a>

                    <!-- Modal Edit Bansos -->
                    <div class="modal fade" id="modalEditMasterBansos<?= $value->id ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
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
                                    <form action="<?= base_url('bansos/update_bansos/'.$value->id) ?>" method="post">
                                        <input type="hidden" name="id_master_bansos"
                                            value="<?= $value->id_master_bansos ?>">
                                        <input type="hidden" name="current_status" value="<?= $value->status ?>">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="edit_nama" name="nama"
                                                        value="<?= $value->nama ?>" required>
                                                </div>
                                                <!-- select master bansos -->
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_nama" class="form-label">Master Bansos</label>
                                                    <select class="form-control" name="id_master_bansos"
                                                        id="edit_id_master_bansos" required disabled>
                                                        <option value="" selected disabled>- Master Bansos -</option>
                                                        <?php foreach ($master_bansos as $key => $value2) { ?>
                                                        <option value="<?= $value2->id ?>"
                                                            <?= $value->id_master_bansos == $value2->id ? 'selected' : '' ?>>
                                                            <?= $value2->nama ?>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_nik" class="form-label">NIK</label>
                                                    <input type="text" class="form-control" id="edit_nik" name="nik"
                                                        value="<?= $value->nik ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_norek" class="form-label">Nomor Rekening</label>
                                                    <input type="text" class="form-control" id="edit_norek" name="norek"
                                                        value="<?= $value->norek ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_tahun" class="form-label">Tahun</label>
                                                    <select class="form-control" name="tahun" id="edit_tahun">
                                                        <option value="" selected disabled>- Pilih Tahun -</option>
                                                        <?php for ($i = 2000; $i <= date('Y'); $i++) { ?>
                                                        <option value="<?= $i ?>"
                                                            <?= $value->tahun == $i ? 'selected' : '' ?>>
                                                            <?= $i ?>
                                                            <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_jenis_bansos" class="form-label">Jenis
                                                        Bansos</label>
                                                    <select class="form-control" name="jenis_bansos"
                                                        id="edit_jenis_bansos">
                                                        <option value="" selected disabled>- Pilih Jenis Bansos -
                                                        </option>
                                                        <option value="PKH"
                                                            <?= $value->jenis_bansos == 'PKH' ? 'selected' : '' ?>>
                                                            PKH</option>
                                                        <option value="BPNT"
                                                            <?= $value->jenis_bansos == 'BPNT' ? 'selected' : '' ?>>
                                                            BPNT</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_kabupaten" class="form-label">Kabupaten</label>
                                                    <input type="text" class="form-control" id="edit_kabupaten"
                                                        name="kabupaten" value="<?= $value->kabupaten ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_kecamatan" class="form-label">Kecamatan</label>
                                                    <input type="text" class="form-control" id="edit_kecamatan"
                                                        name="kecamatan" value="<?= $value->kecamatan ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_kelurahan" class="form-label">Kelurahan</label>
                                                    <input type="text" class="form-control" id="edit_kelurahan"
                                                        name="kelurahan" value="<?= $value->kelurahan ?>" required>
                                                </div>
                                                <?php if ($value->status != '1') { ?>
                                                <!-- Jika sudah di approve tidak bisa di rubah -->
                                                <div class="col-md-6 mb-2">
                                                    <label for="edit_status" class="form-label">Status</label>
                                                    <select class="form-control" name="status" id="edit_status">
                                                        <option value="" selected disabled>- Pilih Status -</option>
                                                        <option value="0"
                                                            <?= $value->status == '0' ? 'selected' : '' ?>>Belum
                                                            Tersalur</option>
                                                        <option value="1"
                                                            <?= $value->status == '1' ? 'selected' : '' ?>>Tersalur
                                                        </option>
                                                        <option value="2"
                                                            <?= $value->status == '2' ? 'selected' : '' ?>>Tidak
                                                            Tersalur</option>
                                                    </select>
                                                </div>
                                                <?php } ?>
                                            </div>
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
                <?php } ?>
            </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
</div>

<!-- config datatables -->
<script>
    $(document).ready(function () {
        $('#dataTables').DataTable({
        });
    });
</script>

<!-- jquery reset_filter -->
<script>
    $(document).ready(function () {
        $('#reset_filter').click(function () {
            $('input[name="nama"]').val('');
            $('input[name="nik"]').val('');
            $('input[name="norek"]').val('');
            $('select[name="status"]').val('');
            $('select[name="id"]').val('');
            $('select[name="tahun"]').val('');
            $('select[name="jenis_bansos"]').val('');
            $('input[name="kabupaten"]').val('');
            $('input[name="kecamatan"]').val('');
            $('input[name="kelurahan"]').val('');
        });
    });
</script>

<!-- log id kt_accordion_3 when clicked -->
<script>
    $(document).ready(function () {
        // Check if accordion state exists in local storage
        var accordionState = localStorage.getItem('accordionState');
        if (accordionState !== null && accordionState == "expanded") {
            // Restore accordion state
            $('#kt_accordion_3_item_1').addClass('show');
            $('.accordion-header').removeClass('collapsed');
        }
        console.log("accordionState: " + accordionState);
        // Handle accordion click event
        $('.accordion-header').on('click', function () {
            setTimeout(function () {
                if ($('#kt_accordion_3_item_1').hasClass('show')) {
                    accordionState = "expanded"
                } else {
                    accordionState = "collapsed"
                }
                // Store accordion state in local storage
                localStorage.setItem('accordionState', accordionState);
                // get local storage accordionState
                var accordionState = localStorage.getItem('accordionState');
                console.log("accordionState: " + accordionState);
            }, 500);

        });
    });
</script>