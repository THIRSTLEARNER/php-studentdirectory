<?php

include "db.php";

$message = "";

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, email)
            VALUES ('$name', '$email')";

    if (mysqli_query($conn, $sql)) {

        header("Location: index.php");
        exit();

    } else {

        $message =
            "Error adding student: "
            . mysqli_error($conn);

    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student | Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="mx-auto" style="max-width: 640px;">
            <a class="link-secondary text-decoration-none" href="index.php">&larr; Student Directory</a>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body p-4 p-sm-5">
                    <h1 class="h2 mb-1">Add Student</h1>
                    <p class="text-secondary mb-4">Enter the student's contact details.</p>

                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="add">Add Student</button>
                        <a class="btn btn-outline-secondary ms-2" href="index.php">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>