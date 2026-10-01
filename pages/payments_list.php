<?php
include "../db.php";

$bookings = mysqli_query($conn, "SELECT * FROM bookings");
?>
<!doctype html>
<html>
<head>
<title>Payments</title>
</head>
<body>

<h2>Payments</h2>

<table border="1" cellpadding="5">
<tr>
    <th>Booking</th>
    <th>Total Cost</th>
    <th>Total Paid</th>
    <th>Balance</th>
    <th>Action</th>
</tr>
<?php while ($b = mysqli_fetch_assoc($bookings)) {
    $id = $b['booking_id'];

    // add up the payments of this booking
    $result = mysqli_query($conn, "SELECT SUM(amount_paid) AS paid FROM payments WHERE booking_id = $id");
    $row = mysqli_fetch_assoc($result);
    $paid = $row['paid'];
    if ($paid == null) {
        $paid = 0;
    }

    $balance = $b['total_cost'] - $paid;
?>
<tr>
    <td>#<?php echo $id; ?></td>
    <td><?php echo number_format($b['total_cost'], 2); ?></td>
    <td><?php echo number_format($paid, 2); ?></td>
    <td><?php echo number_format($balance, 2); ?></td>
    <td><a href="payments_process.php?booking_id=<?php echo $id; ?>">Pay</a></td>
</tr>
<?php } ?>
</table>

</body>
</html>