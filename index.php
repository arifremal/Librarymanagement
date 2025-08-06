<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library management </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css
">
</head>
<body>
    <div class="container my-5">
    <h1>List of books</h1>
    <button type="button" hre="/librarymanagement/addbook"  class="btn btn-dark">Add book</button>
    <br>
    <table>
       <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Bio</th>
            <th>Edition</th>
            <th>Created at</th>
        </tr>
       </thead>
       <tbody>
        <td>10</td>
        <td>Arif</td>
        <td>ul</td>
        <td>men</td>
        <td>1</td>
        <td>18/05/2024</td>
        <td>
            <a class="btn btn-primary btn-sm" href="/">Edit</a>
            <a class="btn btn-danger btn-sm" href="/">Deleted</a>
        </td>
       </tbody>
    </table>

    </div>
    
</body>
</html>