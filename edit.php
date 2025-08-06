<?php
require_once 'config.php';

$id = $_GET['id'] ?? 0;
$name = $author = $bio = "";
$edition = 1;
$success = $error = "";

// Fetch book data
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();

if (!$book) {
    header("Location: view_books.php");
    exit();
}

// Initialize form values
$name = $book['name'];
$author = $book['author'];
$bio = $book['bio'];
$edition = $book['edition'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $author = htmlspecialchars(trim($_POST['author']));
    $bio = htmlspecialchars(trim($_POST['bio']));
    $edition = intval($_POST['edition']);
    
    if (empty($name) || empty($author)) {
        $error = "Book title and author are required fields";
    } else {
        $stmt = $conn->prepare("UPDATE books SET name = ?, author = ?, bio = ?, edition = ? WHERE id = ?");
        $stmt->bind_param("sssii", $name, $author, $bio, $edition, $id);
        
        if ($stmt->execute()) {
            $success = "Book updated successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .card { border-radius: 15px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
        .form-title { color: #2c3e50; font-weight: 600; }
        .btn-submit { background-color: #3498db; border: none; transition: all 0.3s; }
        .btn-submit:hover { background-color: #2980b9; transform: translateY(-2px); }
        .form-control:focus { border-color: #3498db; box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25); }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="form-title"><i class="fas fa-edit me-2"></i>Edit Book</h2>
                            <p class="text-muted">Update the details of this book</p>
                        </div>
                        
                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>?id=<?= $id ?>" method="post">
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">Book Title</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-heading text-primary"></i></span>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                           placeholder="Enter book title" required value="<?= htmlspecialchars($name) ?>">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="author" class="form-label fw-semibold">Author</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user-pen text-primary"></i></span>
                                    <input type="text" class="form-control form-control-lg" id="author" name="author" 
                                           placeholder="Enter author name" required value="<?= htmlspecialchars($author) ?>">
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="bio" class="form-label fw-semibold">Description/Bio</label>
                                <textarea class="form-control form-control-lg" id="bio" name="bio" rows="4" 
                                          placeholder="Enter book description"><?= htmlspecialchars($bio) ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="edition" class="form-label fw-semibold">Edition</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-list-ol text-primary"></i></span>
                                    <input type="number" class="form-control form-control-lg" id="edition" name="edition" 
                                           min="1" value="<?= htmlspecialchars($edition) ?>">
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-submit btn-lg text-white py-3">
                                    <i class="fas fa-save me-2"></i>Update Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Book List
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>