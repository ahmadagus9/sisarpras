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
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form method="get" action="<?php echo base_url('index.php/admin/report') ?>">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Filter Tanggal</label>
                                <div class="input-group">
                                    <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                                    <span class="input-group-addon">s/d</span>
                                    <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                                </div>
                            </div>
                            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

                            <?php
                            if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                                echo '<a href="' . base_url('index.php/admin/report') . '" class="btn btn-default">RESET</a>';
                            ?>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Filter Ruang</label>
                                <select name="ruang" class="form-control" style="max-height: 120px; overflow-y: auto;">
                                    <option value="">Pilih Ruang</option>
                                    <?php foreach ($ruang->result() as $a) { ?>
                                        <option value="<?= $a->id ?>" <?= @$_GET['ruang'] == $a->id ? 'selected' : '' ?>><?= $a->nama_ruang ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

                            <?php
                            if (isset($_GET['filter'])) // Jika user mengisi nama ruang, maka munculkan tombol untuk reset filter
                                echo '<a href="' . base_url('index.php/admin/report') . '" class="btn btn-default">RESET</a>';
                            ?>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Filter Keadaan</label>
                                <select name="keadaan" class="form-control" style="max-height: 120px; overflow-y: auto;">
                                    <option value="">Pilih Keadaan</option>
                                    <option value="baik" <?= @$_GET['keadaan'] == 'baik' ? 'selected' : '' ?>>Baik</option>
                                    <option value="rusak" <?= @$_GET['keadaan'] == 'rusak' ? 'selected' : '' ?>>Rusak</option>
                                    <option value="hilang" <?= @$_GET['keadaan'] == 'hilang' ? 'selected' : '' ?>>Hilang</option>
                                </select>
                            </div>
                            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

                            <?php
                            if (isset($_GET['filter'])) // Jika user mengisi nama keadaan, maka munculkan tombol untuk reset filter
                                echo '<a href="' . base_url('index.php/admin/report') . '" class="btn btn-default">RESET</a>';
                            ?>
                        </div>
                    </div>
                </form>
                <div class="table-responsive" style="margin-top: 10px;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No</th>
                                    <th style="width: 60px;">Tanggal Input</th>
                                    <th>Ruang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Keadaan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($transaksi)) { // Jika data tidak ada
                                    echo "<tr><td colspan='7'>Data tidak ada</td></tr>";
                                } else { // Jika jumlah data lebih dari 0 (Berarti data ada)
                                    $counter = 1;
                                    foreach ($transaksi as $data) { // Looping hasil data transaksi
                                        echo "<tr>";
                                        echo "<td style='width: 30px;'>" . $counter . "</td>";
                                        // Tambahkan kolom tanggal dengan format "tanggal-bulan-tahun"
                                        echo "<td style='width: 60px;'>" . date('d-m-Y', strtotime($data->tanggal)) . "</td>";
                                        
                                        $this->db->where('id', $data->id_ruang);
                                        foreach ($this->db->get('tb_ruang')->result() as $druang) {
                                            echo "<td>" . $druang->nama_ruang . "</td>";
                                        }
                                        echo "<td>" . $data->nama_barang . "</td>";
                                        echo "<td>" . $data->merk . "</td>";
                                        echo "<td>" . $data->keadaan . "</td>";
                                        echo "<td>" . $data->jumlah . "</td>";
                                        echo "</tr>";
                                        $counter++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Tombol Cetak dengan Warna Biru -->
                <button onclick="cetakData()" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px;" target="_blank" class="btn btn-info">
                    <i class="fa fa-print" style="margin-right: 5px;"></i> Cetak
                </button>

                <!-- Tombol Unduh dengan Warna Hijau -->
                <button onclick="unduhData()" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 5px;" target="_blank" class="btn btn-info">
                    <i class="fa fa-download" style="margin-right: 5px;"></i> Unduh
                </button>

                <!-- Pesan Setelah Cetak atau Unduh -->
                <div id="pesan"></div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>

                <script>
                function cetakData() {
                    var bodyContent = document.body.innerHTML;
                    var printContent = document.getElementById('dataTable').outerHTML;
                    
                    // Menambahkan logo aplikasi dan judul sebelum mencetak
                    var headerContent = `
                        <div style="text-align: center; margin-bottom: 20px;">
                            <img src="http://localhost/sarpras/assets/logo/logo2.png" alt="Logo Aplikasi" style="width: 100px;">
                            <h1 style="font-size: 24px; margin: 10px 0;">SI-SARPRAS SMPN 1 Bandar</h1>
                            <p style="font-size: 18px; margin: 5px 0;">Sistem Informasi Sarana Prasarana</p>
                            <h2 style="font-size: 20px; margin: 10px 0;">Rekap Data</h2>
                        </div>
                    `;
                    
                    document.body.innerHTML = headerContent + printContent;
                    
                    window.print();
                    
                    document.body.innerHTML = bodyContent;
                    
                }

                function unduhData() {
                    var tableContent = document.getElementById('dataTable');
                    
                    // Mengambil data dari tabel HTML
                    var wb = XLSX.utils.table_to_book(tableContent, { sheet: "Sheet 1", display: true });
                    
                    // Mengkonversi workbook ke file Excel
                    var wbout = XLSX.write(wb, { bookType: 'xlsx', bookSST: true, type: 'binary' });
                    
                    function s2ab(s) {
                        var buf = new ArrayBuffer(s.length);
                        var view = new Uint8Array(buf);
                        for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
                        return buf;
                    }
                    
                    // Membuat tautan unduh secara dinamis
                    var blob = new Blob([s2ab(wbout)], { type: "application/octet-stream" });
                    var url = URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'data_report.xlsx';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                }
                </script>
            </div>
        </div>
    </section>
</div>
