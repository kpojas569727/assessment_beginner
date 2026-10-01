<?php
include "../db.php";

$booking_id = (int)$_GET['booking_id'];
$msg = "";

// get the booking
$result = mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id = $booking_id");
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    die("Booking not found.");
}

$total_cost = $booking['total_cost'];

// get total paid
$result = mysqli_query($conn, "SELECT SUM(amount_paid) AS paid FROM payments WHERE booking_id = $booking_id");
$row = mysqli_fetch_assoc($result);
$total_paid = $row['paid'];
if ($total_paid == null) {
    $total_paid = 0;
}

$balance = $total_cost - $total_paid;

if (isset($_POST['save'])) {
    $amount = (float)$_POST['amount_paid'];
    $method = mysqli_real_escape_string($conn, $_POST['method']);

    if ($amount <= 0) {
        $msg = "Amount must be more than 0.";
    } elseif (round($amount, 2) > round($balance, 2)) {
        $msg = "Amount is more than the balance.";
    } else {
        mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method) VALUES ($booking_id, $amount, '$method')");

        // update the numbers
        $total_paid = $total_paid + $amount;
        $balance = $total_cost - $total_paid;
        $msg = "Payment saved!";

        // if fully paid, change the status
        if (round($balance, 2) <= 0) {
            mysqli_query($conn, "UPDATE bookings SET status = 'PAID' WHERE booking_id = $booking_id");
        }
    }
}
?>
<!doctype html>
<html>
<head>
<title>Process Payment</title>
</head>
<body>

<h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>

<p><?php echo $msg; ?></p>

<p>Total Cost: ₱<?php echo number_format($total_cost, 2); ?></p>
<p>Total Paid: ₱<?php echo number_format($total_paid, 2); ?></p>
<p><b>Balance: ₱<?php echo number_format($balance, 2); ?></b></p>

<form method="POST">
    <p>Amount Paid<br>
    <input type="number" name="amount_paid" step="0.01">
    </p>

    <p>Method<br>
    <select name="method">
        <option value="CASH">CASH</option>
        <option value="GCASH">GCASH</option>
        <option value="CARD">CARD</option>
    </select>
    </p>

    <button type="submit" name="save">Save Payment</button>
</form>

</body>
</html>