<?php
@include 'config.php';

$category = $_GET['category'];
$difficulty = $_GET['difficulty'];

// Query for that category
$query = "SELECT * FROM problems WHERE category = '$category'";

// Modify the query if a specific difficulty is selected
if ($difficulty !== 'random') {
    $query .= " AND difficulty = '$difficulty'";
}

// Execute the query
$result = mysqli_query($conn2, $query);
$problems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems for <?php echo ($category); ?> (<?php echo ucfirst($difficulty); ?>)</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Problems for <?php echo ($category); ?> (<?php echo ucfirst($difficulty); ?>)</h1>

    <?php if (count($problems) > 0): ?>
        <ul class="problem-list">
            <?php foreach ($problems as $index => $problem): ?>
                <li>
                    <a href="problem_details.php?id=<?php echo $problem['id']; ?>&category=<?php echo $category; ?>&difficulty=<?php echo $difficulty; ?>">
                        Problem <?php echo $index + 1; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No problems found for this category and difficulty.</p>
    <?php endif; ?>
</body>
</html>
