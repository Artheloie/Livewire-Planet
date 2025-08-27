<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room_id = $_POST['room_id'];

    $query = "INSERT INTO reservations (first_name, last_name, address, contact, checkin, checkout, room_id)
              VALUES ('$fname', '$lname', '$address', '$contact', '$checkin', '$checkout', '$room_id')";

    if (mysqli_query($conn, $query)) {
        header('Location: thank_you.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
