<!-- check if $data->updated_at -->
<?php if ($data->updated_at != '0000-00-00 00:00:00' || empty($data->updated_at)) { ?>
<!-- alert -->
<div class="alert alert-info" role="alert">
    <i class="fas fa-info-circle"></i> Data ini terakhir diubah pada
    <b><?= date('d F Y H:i:s', strtotime($data->updated_at)) ?></b>.
</div>
<?php } ?>

<form action="<?= base_url('beritaacara/update_berita_acara/'.$data->id) ?>" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="add_jenis_bansos" class="form-label">Jenis Bansos</label>
                <select class="form-control" id="add_jenis_bansos" name="jenis_bansos" required>
                    <option value="" selected disabled>- Pilih Jenis Bansos -</option>
                    <!-- Add options dynamically from database or use static options -->
                    <!-- Example: -->
                    <option value="PKH" <?= ($data->jenis_bansos == 'PKH') ? 'selected' : '' ?>>PKH (Program Keluarga
                        Harapan)</option>
                    <option value="BPNT" <?= ($data->jenis_bansos == 'BPNT') ? 'selected' : '' ?>>BPNT (Bantuan Pangan
                        Non Tunai)</option>
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
                    <option value="<?= $value->id ?>" <?= ($data->id_provinsi == $value->id) ? 'selected' : '' ?>>
                        <?= $value->nama ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="add_kabupaten" class="form-label">Kabupaten</label>
                <select class="form-control" id="add_kabupaten" name="id_kabupaten" required>
                    <option value="" selected disabled>- Pilih Kabupaten -</option>
                    <?php foreach ($kabupaten as $key => $value) { ?>
                    <option value="<?= $value->id ?>" <?= ($data->id_kabupaten == $value->id) ? 'selected' : '' ?>>
                        <?= $value->nama ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="add_kecamatan" class="form-label">Kecamatan</label>
                <select class="form-control" id="add_kecamatan" name="id_kecamatan" required>
                    <option value="" selected disabled>- Pilih Kecamatan -</option>
                    <?php foreach ($kecamatan as $key => $value) { ?>
                    <option value="<?= $value->id ?>" <?= ($data->id_kecamatan == $value->id) ? 'selected' : '' ?>>
                        <?= $value->nama ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="add_kelurahan" class="form-label">Kelurahan</label>
                <select class="form-control" id="add_kelurahan" name="id_kelurahan" required>
                    <option value="" selected disabled>- Pilih Kelurahan -</option>
                    <?php foreach ($kelurahan as $key => $value) { ?>
                    <option value="<?= $value->id ?>" <?= ($data->id_kelurahan == $value->id) ? 'selected' : '' ?>>
                        <?= $value->nama ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <hr>

    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
</form>

<script>
    // $(document).ready(function () {
    //     $('#add_provinsi').on('change', function () {
    //         // reset kabupaten
    //         $('#add_kelurahan').html(
    //             '<option value="" selected disabled>- Pilih Kelurahan -</option>');
    //     });
    // });

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

                        console.log("tes");
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
                $('#add_kelurahan').html(
                    '<option value="" selected disabled>- Pilih Kelurahan -</option>');
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
            // add selected attribute to current year
            if (year == < ? = ($data - > tahun) ? $data - > tahun : 0 ? > ) {
                options += "<option value='" + year + "' selected>" + year + "</option>";
            } else {
                options += "<option value='" + year + "'>" + year + "</option>";
            }
        }
        $('#yearpicker').html(options);
    });
</script>