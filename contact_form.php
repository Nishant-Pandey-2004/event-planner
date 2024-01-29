<?php
$connection = mysqli_connect('localhost', 'root', '', 'contact_db');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$thankYouMessage = ''; 

if (isset($_POST['send'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $booking_for = isset($_POST['booking_for']) ? $_POST['booking_for'] : "";
    $advance_payment = isset($_POST['advance_payment']) ? $_POST['advance_payment'] : "";
    $payment_reference_id = isset($_POST['payment_reference_id']) ? $_POST['payment_reference_id'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";

    $name = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);
    $phone = mysqli_real_escape_string($connection, $phone);
    $address = mysqli_real_escape_string($connection, $address);
    $booking_for = mysqli_real_escape_string($connection, $booking_for);
    $advance_payment = mysqli_real_escape_string($connection, $advance_payment);
    $payment_reference_id = mysqli_real_escape_string($connection, $payment_reference_id);
    $message = mysqli_real_escape_string($connection, $message);

    $request = "INSERT INTO contact_form (name, email, phone, address, booking_for, advance_payment, payment_reference_id, message)
                VALUES ('$name', '$email', '$phone', '$address', '$booking_for', '$advance_payment', '$payment_reference_id', '$message')";

    if (mysqli_query($connection, $request)) {
        $thankYouMessage = 'Thank you for contacting us!';
    } else {
        echo 'Error: ' . $request . '<br>' . mysqli_error($connection);
    }
}


mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    <?php if (!empty($thankYouMessage)) { ?>
        <p><?php echo $thankYouMessage; ?></p>
    <?php } else { ?>
        <!-- Your form HTML goes here -->
        <form action="contact_form.php" method="post" class="contact-form">
            <!-- ... (Your form fields) ... -->
            <input type="submit" value="send message" class="btn" name="send">
        </form>
    <?php } ?>
</body>
</html>
