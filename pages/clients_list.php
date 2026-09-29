<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clients</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../nav.php"; ?>

<h2 class="text-primary">Clients</h2>
<p><a href="clients_add.php" class="btn btn-success btn-sm">+ Add Client</a></p>

<table class="table table-bordered table-striped">
  <tr class="table-primary">
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['client_id']; ?></td>
      <td><?php echo $row['full_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td>
        <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
      </td>
    </tr>
  <?php } ?>
</table>
</body>
</html>




<?php if (false): ?>
<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Clients</title></head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Clients</h2>
<p><a href="clients_add.php">+ Add Client</a></p>
 
<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['client_id']; ?></td>
      <td><?php echo $row['full_name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td>
        <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>">Edit</a>
      </td>
    </tr>
  <?php } ?>
</table>
</body>
</html>

<?php endif; ?>