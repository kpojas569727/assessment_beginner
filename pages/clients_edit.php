<?php
include "../db.php";

$id = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);

$message = "";

if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Client</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "../nav.php"; ?>

<h2 class="text-primary">Edit Client</h2>
<p class="text-danger"><?php echo $message; ?></p>

<form method="post">
  <label>Full Name*</label><br>
  <input type="text" name="full_name" value="<?php echo $client['full_name']; ?>" class="form-control"><br>

  <label>Email*</label><br>
  <input type="text" name="email" value="<?php echo $client['email']; ?>" class="form-control"><br>

  <label>Phone</label><br>
  <input type="text" name="phone" value="<?php echo $client['phone']; ?>" class="form-control"><br>

  <label>Address</label><br>
  <input type="text" name="address" value="<?php echo $client['address']; ?>" class="form-control"><br>

  <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>
</body>
</html>




<!-- <?php
include "../db.php";
 
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Client</title></head>
<body>
<?php include "../nav.php"; ?>
 
<h2>Edit Client</h2>
<p style="color:red;"><?php echo $message; ?></p>
 
<form method="post">
  <label>Full Name*</label><br>
  <input type="text" name="full_name" value="<?php echo $client['full_name']; ?>"><br><br>
 
  <label>Email*</label><br>
  <input type="text" name="email" value="<?php echo $client['email']; ?>"><br><br>
 
  <label>Phone</label><br>
  <input type="text" name="phone" value="<?php echo $client['phone']; ?>"><br><br>
 
  <label>Address</label><br>
  <input type="text" name="address" value="<?php echo $client['address']; ?>"><br><br>
 
  <button type="submit" name="update">Update</button>
</form>
</body>
</html> -->