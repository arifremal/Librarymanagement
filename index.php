<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1>List of Books</h1>
        <button type="button" onclick="window.location.href='/create.php'" class="btn btn-dark">Add Book</button>
        <br><br>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Bio</th>
                    <th>Edition</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "library";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT * FROM books ORDER BY created_at DESC";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['bio']}</td>
                        <td>{$row['edition']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/librarymanagement/edit.php?id={$row['id']}'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/librarymanagement/delete.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>