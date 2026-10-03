<?php

include "db.php";


// CHECK ID

if (!isset($_GET['id'])) {

    http_response_code(400);
    $error = "Student ID is missing.";

} else {

    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    }

    http_response_code(500);
    $error = "Error deleting student: " . mysqli_error($conn);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Student | Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="mx-auto" style="max-width: 640px;">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-sm-5">
                    <h1 class="h2 mb-3">Unable to Delete Student</h1>
                    <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
                    <a class="btn btn-primary" href="index.php">Back to Student Directory</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>