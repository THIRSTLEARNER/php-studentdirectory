
<?php

include "Db.php";

$sql = "SELECT * FROM students";

$result = mysqli_query($conn, $sql);

if (!$result) {

    die(
        "Error retrieving students: "
        . mysqli_error($conn)
    );

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h2 mb-1">Student Directory</h1>
                <p class="text-secondary mb-0">Manage student names and contact details.</p>
            </div>
            <a class="btn btn-primary" href="add.php">Add Student</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td class="ps-4 text-secondary"><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td class="fw-medium"><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="text-end pe-4 text-nowrap">
                                            <a class="btn btn-sm btn-outline-secondary" href="edit.php?id=<?php echo urlencode($row['id']); ?>">Edit</a>
                                            <a
                                                class="btn btn-sm btn-outline-danger ms-1"
                                                href="delete.php?id=<?php echo urlencode($row['id']); ?>"
                                                onclick="return confirm('Are you sure you want to delete this student?')"
                                            >Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="py-5 text-center text-secondary">No students yet. Add a student to get started.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>