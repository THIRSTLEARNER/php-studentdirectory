<?php

include "db.php";

$message = "";


// GET STUDENT ID

if (!isset($_GET['id'])) {

    die("Student ID is missing.");

}

$id = $_GET['id'];


// GET STUDENT DATA

$sql = "SELECT * FROM students WHERE id=$id";

$result = mysqli_query($conn, $sql);

if (!$result) {

    die(
        "Error retrieving student: "
        . mysqli_error($conn)
    );

}


if (mysqli_num_rows($result) == 0) {

    die("Student not found.");

}

$student = mysqli_fetch_assoc($result);


// UPDATE STUDENT

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE students
            SET name='$name',
                email='$email'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {

        header("Location: index.php");
        //echo "<script> alert('value Updated') </script>";
        exit();

    } else {

        $message =
            "Error updating student: "
            . mysqli_error($conn);

    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student | Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="mx-auto" style="max-width: 640px;">
            <a class="link-secondary text-decoration-none" href="index.php">&larr; Student Directory</a>
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body p-4 p-sm-5">
                    <h1 class="h2 mb-1">Edit Student</h1>
                    <p class="text-secondary mb-4">Update the student's contact details.</p>

                    <?php if ($message != "") { ?>
                        <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name" value="<?php echo htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email" value="<?php echo htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="update">Save Changes</button>
                        <a class="btn btn-outline-secondary ms-2" href="index.php">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>