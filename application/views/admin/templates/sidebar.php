  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets') ?>/profil/<?= $this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/dashboard') ?>">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <li <?= $this->uri->segment(2) == 'gedung' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/gedung') ?>">
            <i class="fa fa-university"></i> <span>Data Gedung</span>
          </a>
        </li>
        <li <?= $this->uri->segment(2) == 'ruang' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/ruang') ?>">
            <i class="fa fa-building"></i> <span>Data Ruang</span>
          </a>
        </li>
        <li <?= $this->uri->segment(2) == 'barang' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/barang') ?>">
            <i class="fa fa-tv"></i> <span>Data Barang</span>
          </a>
        </li>
        <li <?= $this->uri->segment(2) == 'report' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/report') ?>">
            <i class="fa fa-briefcase"></i> <span>Laporan Aset</span>
          </a>
        </li>
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <li class="treeview <?= $this->uri->segment(2) == 'user' ||
                                $this->uri->segment(2) == 'aplikasi' ||
                                $this->uri->segment(2) == 'log' || $this->uri->segment(2) == '' ? "active" : '' ?>">
            <a href="#">
              <i class="fa fa-cogs"></i> <span>Pengaturan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?= $this->uri->segment(2) == 'user' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
              <li <?= $this->uri->segment(2) == 'aplikasi' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>
              <li <?= $this->uri->segment(2) == 'log' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a></li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('level') == 'Manager') { ?>
          <li class="treeview <?= $this->uri->segment(2) == 'user' ||
                                $this->uri->segment(2) == 'aplikasi' ||
                                $this->uri->segment(2) == 'log' || $this->uri->segment(2) == '' ? "active" : '' ?>">
            <a href="#">
              <i class="fa fa-cogs"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?= $this->uri->segment(2) == 'user' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/user') ?>"><i class="fa fa-circle-o"></i> Manajemen User</a></li>
              <li <?= $this->uri->segment(2) == 'aplikasi' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/aplikasi') ?>"><i class="fa fa-circle-o"></i> Tentang Aplikasi</a></li>
              <li <?= $this->uri->segment(2) == 'log' || $this->uri->segment(2) == '' ? "active" : '' ?>><a href="<?= base_url('index.php/admin/log') ?>"><i class="fa fa-circle-o"></i> Log Status</a></li>
            </ul>
          </li>
        <?php } ?>
        <li <?= $this->uri->segment(2) == 'profil' || $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
          <a href="<?= base_url('index.php/admin/profil') ?>">
            <i class="fa fa-user"></i> <span>Profil</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          </a>
        </li>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->