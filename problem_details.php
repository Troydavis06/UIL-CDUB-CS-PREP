<?php
@include 'config.php';

// Fetch the problem by its ID from the URL parameters
$id = $_GET['id'];
$category = $_GET['category'];
$difficulty = $_GET['difficulty'];

$query = "SELECT * FROM problems WHERE id = $id";
$result = mysqli_query($conn2, $query);
$problem = mysqli_fetch_assoc($result);

// Fetch the next and previous problems for navigation
$prev_query = "SELECT id FROM problems WHERE id < $id AND category = '$category' AND difficulty = '$difficulty' ORDER BY id DESC LIMIT 1";
$next_query = "SELECT id FROM problems WHERE id > $id AND category = '$category' AND difficulty = '$difficulty' ORDER BY id ASC LIMIT 1";

$prev_result = mysqli_query($conn2, $prev_query);
$next_result = mysqli_query($conn2, $next_query);

$prev_problem = mysqli_fetch_assoc($prev_result);
$next_problem = mysqli_fetch_assoc($next_result);

$feedback = ''; // Initialize feedback variable

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $selected_answer = $_POST['answer'];

    // Check if the selected answer is correct
    if ($selected_answer === $problem['correct_answer']) {
        $feedback = 'Correct! Well done!';
    } else {
        $feedback = 'Wrong answer. Try again!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem: <?php echo ucfirst($problem['category']); ?></title>
    <link rel="stylesheet" href="css/problem_details.css">
</head>
<body>

    <div class="question-container">
        <h1>Problem <?php echo $problem['id']; ?></h1>
        <div class="question-text">
            <p><?php echo $problem['question']; ?></p>
        </div>

        <form method="post">
            <div class="answers">
                <label><input type="radio" name="answer" value="a"> A) <?php echo $problem['answer_a']; ?></label><br>
                <label><input type="radio" name="answer" value="b"> B) <?php echo $problem['answer_b']; ?></label><br>
                <label><input type="radio" name="answer" value="c"> C) <?php echo $problem['answer_c']; ?></label><br>
                <label><input type="radio" name="answer" value="d"> D) <?php echo $problem['answer_d']; ?></label><br>
            </div>
            <button type="submit">Submit Answer</button>
        </form>

        <p><?php echo $feedback; ?></p>

        <!-- Nav buttons -->
        <div class="navigation">
            <?php if ($prev_problem): ?>
                <a href="problem_details.php?id=<?php echo $prev_problem['id']; ?>&category=<?php echo $category; ?>&difficulty=<?php echo $difficulty; ?>">Previous</a>
            <?php endif; ?>
            <?php if ($next_problem): ?>
                <a href="problem_details.php?id=<?php echo $next_problem['id']; ?>&category=<?php echo $category; ?>&difficulty=<?php echo $difficulty; ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
