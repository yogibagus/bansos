<!-- Modal Add User -->
<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddUserLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('user/create_user') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="add_nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="add_nama" name="nama" placeholder="Nama"
                                    required>
                            </div>
                            <!-- email -->
                            <div class="mb-3">
                                <label for="add_email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="add_email" placeholder="Email" name="email"
                                    required>
                            </div>
                            <!-- no hp -->
                            <div class="mb-3">
                                <label for="add_nohp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="add_nohp" placeholder="No Hp" name="nohp"
                                    required>
                            </div>
                            <!-- alamat -->
                            <div class="mb-3">
                                <label for="add_alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="add_alamat" placeholder="Alamat" name="alamat"
                                    rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- jenis kelamin -->
                            <div class="mb-3">
                                <label for="add_jk" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="add_jk" name="jk" required>
                                    <option value="" selected disabled>- Pilih Jenis Kelamin -</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <!-- Jabatan -->
                            <div class="mb-3">
                                <label for="add_jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" placeholder="Jabatan" id="add_jabatan"
                                    name="jabatan">
                            </div>
                            <!-- Role -->
                            <div class="mb-3">
                                <label for="add_role" class="form-label">Role</label>
                                <select class="form-control" id="add_role" name="role" required>
                                    <option value="" selected disabled>- Pilih Role -</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <!-- status -->
                            <div class="mb-3">
                                <label for="add_status" class="form-label">Status</label>
                                <select class="form-control" id="add_status" name="status" required>
                                    <option value="" selected disabled>- Pilih Status -</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
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
                <th width="20%">Nama</th>
                <th width="20%">Email</th>
                <th>No Telp</th>
                <th>Roles</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- php foreach -->
            <?php $no=1; foreach ($users as $key => $value) { ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td class="align-middle"><?= $value->nama ?></td>
                <td class="align-middle"><?= $value->email ?></td>
                <td class="align-middle"><?= $value->nohp ?></td>
                <td class="align-middle">
                    <?php if ($value->role == 1) { ?>
                    <span class="badge badge-danger">Super Admin</span>
                    <?php } else if ($value->role == 2) { ?>
                    <span class="badge badge-warning">Admin</span>
                    <?php } else if ($value->role == 3) { ?>
                    <span class="badge badge-primary">User</span>
                    <?php } ?>
                </td>
                <td class="align-middle">
                    <?php if ($value->status == 0) { ?>
                    <span class="badge badge-danger">Non Aktif</span>
                    <?php } else if ($value->status == 1) { ?>
                    <span class="badge badge-success">Aktif</span>
                    <?php } ?>
                </td>
                <td class="align-middle">
                    <!-- Detail User -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-dark" data-bs-toggle="modal"
                        data-bs-target="#modalDetailUser<?= $value->id ?>">
                        <i class="fa fa-eye" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Lihat detail"></i>
                    </a>
                    <!-- Modal Detail User -->
                    <div class="modal fade" id="modalDetailUser<?= $value->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDetailUserLabel">Detail User - <?= $value->nama ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama"
                                                    value="<?= $value->nama ?>" readonly>
                                            </div>
                                            <!-- email -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email"
                                                    value="<?= $value->email ?>" readonly>
                                            </div>
                                            <!-- no hp -->
                                            <div class="mb-3">
                                                <label for="nohp" class="form-label">No Telp</label>
                                                <input type="text" class="form-control" id="nohp"
                                                    value="<?= $value->nohp ?>" readonly>
                                            </div>
                                            <!-- alamat -->
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" rows="3"
                                                    readonly><?= $value->alamat ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- jenis kelamin -->
                                            <div class="mb-3">
                                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control text-capitalize" id="jk"
                                                    value="<?= $value->jk ?>" readonly>
                                            </div>
                                            <!-- Jabatan -->
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" id="jabatan"
                                                    value="<?= $value->jabatan ?>" readonly>
                                            </div>
                                            <!-- Role -->
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <? if ($value->role == 1) { ?>
                                                <input type="text" class="form-control" id="role" value="Super Admin"
                                                    readonly>
                                                <? } else if ($value->role == 2) { ?>
                                                <input type="text" class="form-control" id="role" value="Admin" readonly>
                                                <? } else if ($value->role == 3) { ?>
                                                <input type="text" class="form-control" id="role" value="User" readonly>
                                                <? } ?>
                                            </div>
                                            <!-- status -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <? if ($value->status == 0) { ?>
                                                <input type="text" class="form-control" id="status" value="Non Aktif"
                                                    readonly>
                                                <? } else if ($value->status == 1) { ?>
                                                <input type="text" class="form-control" id="status" value="Aktif" readonly>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Edit User -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="modal"
                        data-bs-target="#modalEditUser<?= $value->id ?>">
                        <i class="fa fa-edit" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"></i>
                    </a>
    
                    <!-- Modal Edit User -->
                    <div class="modal fade" id="modalEditUser<?= $value->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content bg-light">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEditUserLabel">Edit User - <?= $value->nama ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url('user/update_user/'.$value->id) ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="edit_nama" name="nama"
                                                        value="<?= $value->nama ?>" required>
                                                </div>
                                                <!-- email -->
                                                <div class="mb-3">
                                                    <label for="edit_email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="edit_email" name="email"
                                                        value="<?= $value->email ?>" required>
                                                </div>
                                                <!-- no hp -->
                                                <div class="mb-3">
                                                    <label for="edit_nohp" class="form-label">No Telp</label>
                                                    <input type="number" class="form-control" id="edit_nohp" name="nohp"
                                                        min="0" max="9999999999999" value="<?= $value->nohp ?>" required>
                                                </div>
                                                <!-- alamat -->
                                                <div class="mb-3">
                                                    <label for="edit_alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"
                                                        required><?= $value->alamat ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- jenis kelamin -->
                                                <div class="mb-3">
                                                    <label for="edit_jk" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" id="edit_jk" name="jk" required>
                                                        <option value="Laki-laki"
                                                            <?= ($value->jk == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki
                                                        </option>
                                                        <option value="Perempuan"
                                                            <?= ($value->jk == 'Perempuan') ? 'selected' : '' ?>>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                                <!-- Jabatan -->
                                                <div class="mb-3">
                                                    <label for="edit_jabatan" class="form-label">Jabatan</label>
                                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                                        value="<?= $value->jabatan ?>">
                                                </div>
                                                <!-- Role -->
                                                <div class="mb-3">
                                                    <label for="edit_role" class="form-label">Role</label>
                                                    <select class="form-control" id="edit_role" name="role" required>
                                                        <option value="1" <?= ($value->role == 1) ? 'selected' : '' ?>>Super
                                                            Admin</option>
                                                        <option value="2" <?= ($value->role == 2) ? 'selected' : '' ?>>Admin
                                                        </option>
                                                        <option value="3" <?= ($value->role == 3) ? 'selected' : '' ?>>User
                                                        </option>
                                                    </select>
                                                </div>
                                                <!-- status -->
                                                <div class="mb-3">
                                                    <label for="edit_status" class="form-label">Status</label required>
                                                    <select class="form-control" id="edit_status" name="status">
                                                        <option value="0" <?= ($value->status == 0) ? 'selected' : '' ?>>Non
                                                            Aktif</option>
                                                        <option value="1" <?= ($value->status == 1) ? 'selected' : '' ?>>
                                                            Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <!-- Delete User -->
                    <a type="button" class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="modal"
                        data-bs-target="#modalDeleteUser<?= $value->id ?>">
                        <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Delete"></i>
                    </a>
    
                    <!-- Modal Delete User -->
                    <div class="modal fade" id="modalDeleteUser<?= $value->id ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteUserLabel">Delete User - <?= $value->nama ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apa anda yakin ingin menghapus user ini?<br>
                                        <span class="text-danger">Perhatian! Data yang sudah dihapus tidak dapat
                                            dikembalikan!</span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a href="<?= base_url('user/delete_user/' . $value->id) ?>"
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