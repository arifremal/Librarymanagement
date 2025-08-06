<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare a delete statement
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Book deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting book: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
header("Location: index.php");
exit();
?>