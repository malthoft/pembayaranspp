  <!-- Navbar -->
  <nav class="main-header navbar navbar-light navbar-expand-md bg-body-tertiary" style="box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.10);">
    <div class="container">
      <a href="#" class="navbar-brand">
        <span class="brand-text font-weight-light">Aplikasi Pembayaran SPP</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <?php if ($_SESSION['level']=="admin") { ?>
          <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master Data</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="kelas.php" class="dropdown-item">Data Kelas</a></li>
              <li><a href="siswa.php" class="dropdown-item">Data Siswa</a></li>
              <li><a href="spp.php" class="dropdown-item">Data SPP</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="petugas.php" class="nav-link">Data Petugas</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pembayaran</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="transaksipembayaran.php" class="dropdown-item">Transaksi Pembayaran</a></li>
              <li><a href="historypembayaran.php" class="dropdown-item">History Pembayaran</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="laporan.php" class="nav-link">Laporan</a>
          </li>
        </ul>
        <?php }else {?>
          <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pembayaran</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="transaksipembayaran.php" class="dropdown-item">Transaksi Pembayaran</a></li>
              <li><a href="historypembayaran.php" class="dropdown-item">History Pembayaran</a></li>
            </ul>
          </li>
        </ul>
        <?php } ?>
        
      </div>
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="../logout.php">
            <i class="fas fa-sign-out-alt"> Logout</i>
          </a>
        </li>
      </ul>
    </div>
  </nav>