<div class="card container p-5">
    <form id="update_profile_form" action="<?= base_url('dashboard/edit_profile/'.$user->id) ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="edit_nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit_nama" name="nama" value="<?= $user->nama ?>" required>
                </div>
                <!-- email -->
                <div class="mb-3">
                    <label for="edit_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit_email" name="email" value="<?= $user->email ?>"
                        required>
                </div>
                <!-- no hp -->
                <div class="mb-3">
                    <label for="edit_nohp" class="form-label">No Telp</label>
                    <input type="number" class="form-control" id="edit_nohp" name="nohp" min="0" max="9999999999999"
                        value="<?= $user->nohp ?>" required>
                </div>
                <!-- alamat -->
                <div class="mb-3">
                    <label for="edit_alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"
                        required><?= $user->alamat ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <!-- jenis kelamin -->
                <div class="mb-3">
                    <label for="edit_jk" class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="edit_jk" name="jk" required>
                        <option value="Laki-laki" <?= ($user->jk == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki
                        </option>
                        <option value="Perempuan" <?= ($user->jk == 'Perempuan') ? 'selected' : '' ?>>Perempuan
                        </option>
                    </select>
                </div>
                <!-- Jabatan -->
                <div class="mb-3">
                    <label for="edit_jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $user->jabatan ?>">
                </div>
                <!-- Role -->
                <div class="mb-3">
                    <label for="edit_role" class="form-label">Role</label>
                    <select class="form-control" id="edit_role" name="role" required disabled>
                        <option value="1" <?= ($user->role == 1) ? 'selected' : '' ?>>Super
                            Admin</option>
                        <option value="2" <?= ($user->role == 2) ? 'selected' : '' ?>>Admin
                        </option>
                        <option value="3" <?= ($user->role == 3) ? 'selected' : '' ?>>User
                        </option>
                    </select>
                </div>
                <!-- status -->
                <div class="mb-3">
                    <label for="edit_status" class="form-label">Status</label>
                    <select class="form-control" id="edit_status" name="status" required disabled>
                        <option value="0" <?= ($user->status == 0) ? 'selected' : '' ?>>Non
                            Aktif</option>
                        <option value="1" <?= ($user->status == 1) ? 'selected' : '' ?>>
                            Aktif</option>
                    </select>
                </div>
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary mt-3" id="update_profile_submit"><i class="fas fa-save"></i> Simpan
                Perubahan</button>
    </form>
</div>

<!-- script loading jquery -->
<script>
$(document).ready(function () {
  $('#update_profile_submit').click(function (event) {
    var form = $('#update_profile_form')[0]; // Get the form element

    if (!form.checkValidity()) {
      event.preventDefault(); // Prevent form submission if invalid
      form.reportValidity(); // Display default validation messages
    } else {
      // Form is valid, allow submission
      $(this).html('Loading...');
      $(this).attr('disabled', true);
      form.submit();
    }
  });
});

</script>