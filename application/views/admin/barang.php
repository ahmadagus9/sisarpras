<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $title ?>
            <small><?= $subtitle ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?= $title ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData">
                    <div class="fa fa-plus"></div> Tambah Data
                </button>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>Ruang</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Tanggal</th>
                                <th>Keadaan</th>
                                <th>Jumlah</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang->result_array() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php
                                        $this->db->where('id', $row['id_ruang']);
                                        foreach ($this->db->get('tb_ruang')->result() as $druang) {
                                            echo $druang->nama_ruang;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td><?= $row['merk'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['keadaan'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#tampilGambar<?= $row['id'] ?>">
                                            <div class="fa fa-eye"></div> Lihat Gambar
                                        </button></td>
                                    <td>
                                        <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editData<?= $row['id'] ?>">
                                            <div class="fa fa-edit"></div> Edit
                                        </button>
                                        <a href="<?= base_url('index.php/admin/barang/delete/') . $row['id'] ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Data yang berhubungan akan terhapus juga!">
                                            <div class="fa fa-trash"></div> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tampil gambar-->
<?php foreach ($barang->result_array() as $row) { ?>
    <div class="modal fade" id="tampilGambar<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Gambar</h4>
                    </div>
                    <div class="box-body">
                        <img src="<?= base_url('assets/gambar/') . $row['gambar'] ?>" width="200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah <?= $title ?></h4>
            </div>
            <form action="<?= base_url('index.php/admin/barang/insert') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Ruang</label>
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                <select name="id_ruang" class="form-control" style="width: 100%" required>
                                    <option value="" disabled selected>-- Pilih ruang --</option>
                                    <?php foreach ($ruang->result() as $a) { ?>
                                        <option value="<?= $a->id ?>"><?= $a->nama_ruang  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" placeholder="Isi nama_barang" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" name="merk" class="form-control" placeholder="Isi merk" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>tanggal</label>
                                <input type="date" name="tanggal" class="form-control" placeholder="Isi Tanggal" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keadaan </label>
                                <select name="keadaan" class="form-control" required>
                                    <option value="">-- Pilih Keadaan --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>jumlah</label>
                                <input type="text" name="jumlah" class="form-control" placeholder="Isi jumlah" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gambar </label>
                                <input type="file" name="gambar" class="form-control-file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">
                        <div class="fa fa-trash"></div> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <div class="fa fa-save"></div> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<?php foreach ($barang->result() as $th) { ?>
    <div class="modal fade" id="editData<?= $th->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $title ?></h4>
                </div>
                <form action="<?= base_url('index.php/admin/barang/update/') . $th->id ?>" method="POST" enctype="multipart/form-data">
                    <div class=" modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <select name="id_ruang" class="form-control" required>
                                        <?php foreach ($ruang->result_array() as $a) {
                                        ?>
                                            <option <?php if ($a['id'] == $th->id_ruang) {
                                                        echo 'selected="selected"';
                                                    } ?> value="<?= $a['id'] ?>"><?php echo $a['nama_ruang'] ?> </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $th->nama_barang ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" name="merk" class="form-control" placeholder="Nama Merk" value="<?= $th->merk ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" placeholder="Nama tanggal" value="<?= $th->tanggal ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keadaan</label>
                                    <select name="keadaan" class="form-control" required>
                                        <option value="Baik" <?= $th->keadaan == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                        <option value="Rusak" <?= $th->keadaan == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                        <option value="Hilang" <?= $th->keadaan == 'Hilang' ? 'selected' : '' ?>>Hilang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" placeholder="Nama jumlah" value="<?= $th->jumlah ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <input type="file" name="gambar" class="form-control-file"> <br>
                                    <?php if ($th->gambar != '') { ?>
                                        <img src="<?= base_url('assets/gambar/') . $th->gambar ?>" alt="gambar Kosong" class="img-responsive" width="20%">
                                        <br>
                                        <a href="<?= base_url('index.php/admin/aplikasi/delete_gambar/') . $th->id ?>" class="btn btn-danger btn-xs tombol-yakin" data-isidata="Ingin menghapus gambar?">
                                            <div class="fa fa-trash fa-sm"></div> Delete gambar
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <div class="fa fa-trash"></div> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <div class="fa fa-save"></div> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>