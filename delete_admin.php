<?php
include './config/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request.");
}

// Count total admins
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM admin_users");
$row = mysqli_fetch_assoc($result);
$totalAdmins = $row['total'];

if ($totalAdmins <= 1) {
    echo "<script>alert('Cannot delete the last remaining admin!'); window.location.href='AdminUsers.php';</script>";
    exit;
}

// Delete admin
$delete = "DELETE FROM admin_users WHERE id=$id";

if (mysqli_query($conn, $delete)) {
    echo "<script>alert('Admin deleted successfully!'); window.location.href='AdminUsers.php';</script>";
} else {
    echo "<script>alert('Error deleting admin.'); window.location.href='AdminUsers.php';</script>";
}
?>
