<div id="alert"></div>

<div class="modal fade" id="modalAddDataPenyaluran" tabindex="-1" aria-labelledby="modalAddDataPenyaluranLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddDataPenyaluranLabel">Tambah Data Bansos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="alert alert-info" role="alert">
                        <strong>Perhatian!</strong> Pastikan data yang akan ditambahkan sudah benar.
                    </div>
                    <p>Apakah anda yakin ingin menambahkan data pada <b>Master Penyaluran</b> ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info" id="btn_send_data">Tambah Data <i
                            class="fas fa-paper-plane    "></i></button>
                </div>
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
                <form action="<?= base_url('penyaluran/detail_penyaluran/'.$id_master_penyaluran) ?>" method="post">
                    <input type="hidden" name="status" value="<?= $filter["status"] ?>">
                    <div class="row">
                        <!-- drop down status -->
                        <div class="col-md-3 col-sm-6 col-12">
                            <label for="">Status</label>
                            <select class="form-control form-control-sm" name="master_status" id="filter_status">
                                <option value="" selected disabled>- Status -</option>
                                <option value="0" <?= $filter_master["status"] == '0' ? 'selected' : '' ?>>Belum Tersalur
                                </option>
                                <option value="1" <?= $filter_master["status"] == '1' ? 'selected' : '' ?>>Tersalur</option>
                                <option value="2" <?= $filter_master["status"] == '2' ? 'selected' : '' ?>>Tidak Tersalur
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
    <div>
        <h5 class="mt-3">Total Data: <span id="total_data"><?= count($data) ?></span><br><span>Data Dipilih:<span id="total_checked">
                    0</span></span></h5>
    </div>
    <table class="table table-striped table-hover fw-bold" id="dataTables">
        <thead class="thead-inverse bg-dark text-white">
            <tr>
                <th width="5%" class="align-middle p-3">
                    <input type="checkbox" class="form-check-input" name="" id="checkAll">
                </th>
                <th width="5%" class="text-center">No</th>
                <th>Status</th>
                <th width="20%">Nama</th>
                <th>Norek</th>
                <th>NIK</th>
                <th>Tahun</th>
                <th>Jenis</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th width="10%">Tgl Submit</th>
                <th width="5%">Aksi</th>

            </tr>
        </thead>
        <tbody>
            <!-- php foreach -->
            <?php $no=1; foreach ($data as $key => $value) {?>
            <tr>
                <td class="align-middle p-3">
                    <input type="checkbox" class="form-check-input" name="" id="check<?= $value->id ?>"
                        value="<?= $value->id ?>">
                </td>
                <td class="align-middle text-center"><?= $no ?></td>
                <td class="align-middle">
                    <?php if ($value->status_penyaluran == 0) { ?>
                    <span class="badge badge-light">Belum Tersalur</span>
                    <?php } elseif ($value->status_penyaluran == 1) { ?>
                    <span class="badge badge-success">Tersalur</span>
                    <?php } elseif ($value->status_penyaluran == 2) { ?>
                    <span class="badge badge-danger">Tidak Tersalur</span>
                    <?php } ?>
                </td>
                <td class="align-middle"><?= $value->nama ?></td>
                <td class="align-middle"><?= $value->norek ?></td>
                <td class="align-middle"><?= $value->nik ?></td>
                <td class="align-middle"><?= $value->tahun ?></td>
                <td class="align-middle"><?= $value->jenis_bansos ?></td>
                <td class="align-middle"><?= $value->kabupaten ?></td>
                <td class="align-middle"><?= $value->kecamatan ?></td>
                <td class="align-middle"><?= $value->kelurahan ?></td>
                <!-- FORMAT TGL -->
                <td class="align-middle">
                    <?= date_format(date_create($value->created_at_penyaluran), "d-m-Y H:i:s") ?>
                </td>
                <td>
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
                                    <h5 class="modal-title" id="modalDeleteBMasterBansos">Hapus Data Penyaluran ID :
                                        <?= $value->id ?>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-primary" role="alert">
                                        <strong>Perhatian</strong> Pastikan data yang akan dihapus sudah benar.
                                    </div>
                                    <p>Apa anda yakin ingin menghapus data ini?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href="<?= base_url('penyaluran/delete_data_penyaluran/' . $value->id) ?>"
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
            // row 1 prevent sorting
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }],
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
            $('select[name="master_status"]').val('');
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

<!-- make a function to handle checkbox on click -->
<script>
    $(document).ready(function () {
        // call checkboxHandler
        checkboxHandler();

        // Retrieve previously stored values from local storage
        function checkboxHandler() {
            console.log("checkboxHandler()");
            var storedValues = localStorage.getItem('checkedValuesDetail<?= $id_master_penyaluran ?>');
            console.log("storedValues: " + storedValues);
            var checkedValuesDetail = [];

            // check if checkedAllValues exists in local storage
            var checkedAllValues = localStorage.getItem('checkAllValuesDetail<?= $id_master_penyaluran ?>');
            console.log("checkedAllValues: " + checkedAllValues);

            // check if checkedAllValues is true
            if (checkedAllValues == 'true' || checkedAllValues == true) {
                console.log("checkedAllValues == true");
                $('#checkAll').prop('checked', true);
                $('input[type="checkbox"]').prop('checked', true);
            }

            // Check if any previous checked values exist
            if (storedValues) {
                checkedValuesDetail = JSON.parse(storedValues);
                $.each(checkedValuesDetail, function (index, value) {
                    $('input[type="checkbox"][value="' + value + '"]').prop('checked', true);
                });
                updateCheckedValuesDetail(checkedValuesDetail);
            }

            // Event delegation for checkbox click
            $(document).on('click', 'input[type="checkbox"]', function () {
                console.log("checkbox clicked");
                // handle checkall
                if ($(this).attr('id') == 'checkAll') {
                    checkAllHandler(checkedValuesDetail);
                    return;
                }
                if ($(this).is(':checked')) {
                    $('#checkAll').prop('checked', false);
                    if (!checkedValuesDetail.includes($(this).val())) {
                        checkedValuesDetail.push($(this).val());
                    }
                } else {
                    var index = checkedValuesDetail.indexOf($(this).val());
                    if (index !== -1) {
                        checkedValuesDetail.splice(index, 1);
                    }
                }

                updateCheckedValuesDetail(checkedValuesDetail);

                // Save checked values to local storage
                localStorage.setItem('checkedValuesDetail<?= $id_master_penyaluran ?>', JSON.stringify(checkedValuesDetail));
            });

            // Log all checked checkbox values
            console.log($('input[type="checkbox"]:checked').map(function () {
                return this.value;
            }).get());
        }

        function updateCheckedValuesDetail(values) {
            $('#total_checked').html(" " + values.length);
            $('#checked_list').val(JSON.stringify(values));
            console.log(values);
        }

        // function to handle checkall
        function checkAllHandler(checkedValuesDetail) {
            // // delete local storage
            localStorage.removeItem('checkedValuesDetail<?= $id_master_penyaluran ?>');
            // check if checked
            if ($('#checkAll').is(':checked')) {
                // check all checkbox
                $('input[type="checkbox"]').prop('checked', true);
                // set to local storage checkedAllValues
                localStorage.setItem('checkAllValuesDetail<?= $id_master_penyaluran ?>', true);
                // get value from #total_data and set to #total_checked
                $('#total_checked').html(" " + $('#total_data').html());
            } else {
                // uncheck all checkbox
                $('input[type="checkbox"]').prop('checked', false);
                // set to local storage checkedAllValues
                localStorage.setItem('checkAllValuesDetail<?= $id_master_penyaluran ?>', false);
                // set to 0 #total_checked
                $('#total_checked').html(" 0");
            }
        }

        // handle pagination click
        $(document).on('page.dt', '#dataTables', function () {
            console.log("page.dt");
            // click the same page
            var page = $('#dataTables').DataTable().page();
            $('#dataTables').DataTable().page(page).draw('page');
            // call checkboxHandler()
            checkboxHandler();
            // call checkAllHandler()
            checkAllHandler();
        });
    });
</script>

<!-- send data to CO Magang -->
<script>
    $(document).ready(function () {
        // submit data
        $('#btn_send_data').click(function () {
            // get checked values
            var checkedValuesDetail = JSON.parse(localStorage.getItem('checkedValuesDetail<?= $id_master_penyaluran ?>'));
            console.log("checkedValuesDetail", checkedValuesDetail);

            // get checkedAllValues
            var checkedAllValues = localStorage.getItem('checkAllValuesDetail<?= $id_master_penyaluran ?>');
            console.log("checkedAllValues", checkedAllValues);

            // check if empty
            if ((checkedValuesDetail == '' || checkedValuesDetail == null) && (checkedAllValues == '' || checkedAllValues == null)) {
                // close modal
                $('#modalAddDataPenyaluran').modal('hide');
                // swall alert with button to reload page
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Tidak ada data yang dipilih',
                    icon: 'error',
                    confirmButtonText: 'Ok',
                    allowOutsideClick: false,
                })
                return false;
            }

            addData(1, checkedValuesDetail);
        });

        function addData(status, checkedValuesDetail) {
            // close all modal
            $('#modalAddDataPenyaluran').modal('hide');
            $.ajax({
                url: "<?= base_url('penyaluran/add_data_bansos/') ?>",
                type: "POST",
                data: {
                    checked_list: checkedValuesDetail,
                    id_master_penyaluran: <?=$id_master_penyaluran?> ,
                    check_all: localStorage.getItem('checkAllValuesDetail<?= $id_master_penyaluran ?>'),
                    filter: <?=json_encode($filter)?> ,
                },
                success: function (data) {
                    console.log(data);
                    // convert
                    data = JSON.parse(data);
                    // swall alert with button to reload page
                    if (data.status == true) {
                        // delete local storage
                        localStorage.removeItem('checkedValuesDetail<?= $id_master_penyaluran ?>');
                        localStorage.removeItem('checkAllValuesDetail<?= $id_master_penyaluran ?>');

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
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                            text: data.error,
                            showConfirmButton: false,
                            timer: 5000
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan!',
                        showConfirmButton: false
                    });
                    console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    });
</script>