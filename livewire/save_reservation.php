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

    // Calculate total bill
    $room = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM rooms WHERE id='$room_id'"));
    $total_bill = $room['price'];
    $addons_selected = isset($_POST['addons']) ? $_POST['addons'] : [];
    foreach ($addons_selected as $addon_id) {
        $addon = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM addons WHERE id='$addon_id'"));
        $total_bill += $addon['price'];
    }

    $query = "INSERT INTO reservations (first_name, last_name, address, contact, checkin, checkout, room_id, total_bill)
              VALUES ('$fname', '$lname', '$address', '$contact', '$checkin', '$checkout', '$room_id', '$total_bill')";

    if (mysqli_query($conn, $query)) {
        $reservation_id = mysqli_insert_id($conn);
        // Save add-ons
        foreach ($addons_selected as $addon_id) {
            mysqli_query($conn, "INSERT INTO reservation_addons (reservation_id, addon_id) VALUES ('$reservation_id', '$addon_id')");
        }
        header('Location: thank_you.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
