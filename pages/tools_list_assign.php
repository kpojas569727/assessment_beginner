<?php
include "../db.php";

$msg = "";

if (isset($_POST['assign'])) {
    $booking_id = (int)$_POST['booking_id'];
    $tool_id = (int)$_POST['tool_id'];
    $qty = (int)$_POST['qty_used'];

    // get the tool to check the stock
    $result = mysqli_query($conn, "SELECT * FROM tools WHERE tool_id = $tool_id");
    $tool = mysqli_fetch_assoc($result);

    if ($qty <= 0) {
        $msg = "Quantity must be at least 1.";
    } elseif ($qty > $tool['quantity_available']) {
        $msg = "Not enough tools available.";
    } else {
        mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used) VALUES ($booking_id, $tool_id, $qty)");
        mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id = $tool_id");
        $msg = "Tool assigned!";
    }
}

$tools = mysqli_query($conn, "SELECT * FROM tools");
$tools2 = mysqli_query($conn, "SELECT * FROM tools");
$bookings = mysqli_query($conn, "SELECT * FROM bookings");
?>
<!doctype html>
<html>
<head>
<title>Tools</title>
</head>
<body>

<h2>Tools / Inventory</h2>

<p><?php echo $msg; ?></p>

<h3>Available Tools</h3>
<table border="1" cellpadding="5">
<tr>
    <th>Name</th>
    <th>Total</th>
    <th>Available</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($tools)) { ?>
<tr>
    <td><?php echo htmlspecialchars($row['tool_name']); ?></td>
    <td><?php echo $row['quantity_total']; ?></td>
    <td><?php echo $row['quantity_available']; ?></td>
</tr>
<?php } ?>
</table>

<h3>Assign Tool to Booking</h3>
<form method="POST">
    <p>Booking ID<br>
    <select name="booking_id">
        <?php while ($b = mysqli_fetch_assoc($bookings)) { ?>
            <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
        <?php } ?>
    </select>
    </p>

    <p>Tool<br>
    <select name="tool_id">
        <?php while ($t = mysqli_fetch_assoc($tools2)) { ?>
            <option value="<?php echo $t['tool_id']; ?>">
                <?php echo htmlspecialchars($t['tool_name']); ?> (Avail: <?php echo $t['quantity_available']; ?>)
            </option>
        <?php } ?>
    </select>
    </p>

    <p>Qty Used<br>
    <input type="number" name="qty_used" value="1">
    </p>

    <button type="submit" name="assign">Assign</button>
</form>

</body>
</html>