<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Agent Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f9fafb;
      font-family: Arial, sans-serif;
    }
    .sidebar {
      width: 260px;
      min-height: 100vh;
      background: #fff;
      border-right: 1px solid #e5e7eb;
      position: fixed;
      left: 0;
      top: 0;
      padding: 20px;
    }
    .content {
      margin-left: 280px;
      padding: 20px;
    }
    .nav-link.active {
      background: #dcfce7;
      border-radius: 8px;
      font-weight: bold;
      color: #16a34a !important;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="fw-bold mb-4">Garbage Bank</h4>

    <!-- Agent Info -->
    <div class="d-flex align-items-center mb-4">
      <img src="<?= $agent['avatar']; ?>" class="rounded-circle me-2" alt="agent" width="40" height="40">
      <div>
        <p class="mb-0 fw-semibold"><?= $agent['name']; ?></p>
        <small class="text-muted"><?= $agent['role']; ?></small>
      </div>
    </div>

    <!-- Navigation -->
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a href="<?= site_url('agent/dashboard'); ?>" class="nav-link <?= ($page=='dashboard')?'active text-success':'text-dark'; ?>">
          Dashboard
        </a>
      </li>
      <li class="nav-item mb-2">
        <a href="<?= site_url('agent/my_user'); ?>"  class="nav-link <?= ($page=='my_user')?'active text-success':'text-dark'; ?>">
          My Users
        </a>
      </li>
      <li class="nav-item mb-2">
        <a href="<?= site_url('agent/transactions'); ?>" class="nav-link <?= ($page=='transactions')?'active text-success':'text-dark'; ?>">
          Transactions
        </a>
      </li>
      <li class="nav-item mb-2">
        <a href="<?= site_url('agent/profile'); ?>" class="nav-link <?= ($page=='profile')?'active text-success':'text-dark'; ?>">
          Profile
        </a>
      </li>
      <li class="nav-item mt-4">
        <a href="<?= site_url('logout'); ?>" class="nav-link text-danger">Logout</a>
      </li>
    </ul>
  </div>

  <!-- Content -->
<div class="content">
  <?php 
    // Cek apakah ada variabel 'content' yang dikirim dari controller
    if (isset($content)) {
        $this->load->view($content);
    } else {
        echo "<p>Halaman tidak ditemukan.</p>";
    }
  ?>
</div>

</body>
</html>
