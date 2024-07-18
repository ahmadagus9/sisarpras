<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('index.php/admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Home</li>
        </ol>
    </section>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_gedung')->num_rows();
                            ?>
                        </h3>

                        <p>Total Gedung</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-bank"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/gedung') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_ruang')->num_rows();
                            ?>
                        </h3>

                        <p>Total Ruang</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-building"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/ruang') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_barang')->num_rows();
                            ?>
                        </h3>

                        <p>Total Barang</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-tv"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/barang') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php
                            echo $this->db->query('SELECT id FROM tb_user')->num_rows();
                            ?>
                        </h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <div class="fa fa-users"></div>
                    </div>
                    <a href="<?= base_url('index.php/admin/user') ?>" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>