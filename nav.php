<?php // nav.php ?>
<div class="bg-black p-3">
  <div class="container d-flex align-items-center">
    <a href="/assessment_beginner/index.php" class="text-white me-auto text-decoration-none fs-1">Dashboard</a>
    <a href="/assessment_beginner/pages/clients_list.php" class="text-white me-3 text-decoration-none">Clients</a>
    <a href="/assessment_beginner/pages/services_list.php" class="text-white me-3 text-decoration-none">Services</a>
    <a href="/assessment_beginner/pages/bookings_list.php" class="text-white me-3 text-decoration-none">Bookings</a>
    <a href="/assessment_beginner/pages/tools_list_assign.php" class="text-white me-3 text-decoration-none">Tools</a>
    <a href="/assessment_beginner/pages/payments_list.php" class="text-white me-3 text-decoration-none">Payments</a>
    <a href="/assessment_beginner/login.php?logout=1" class="text-white me-3 text-decoration-none">Logout</a>
  </div>
</div>



<?php if (false): ?>
<?php // nav.php ?>
<div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:16px;">
  <a href="/assessment_beginner/index.php">Dashboard</a>
  <a href="/assessment_beginner/pages/clients_list.php">Clients</a>
  <a href="/assessment_beginner/pages/services_list.php">Services</a>
  <a href="/assessment_beginner/pages/bookings_list.php">Bookings</a>
  <a href="/assessment_beginner/pages/tools_list_assign.php">Tools</a>
  <a href="/assessment_beginner/pages/payments_list.php">Payments</a>
</div>
<hr>
<?php endif; ?>
