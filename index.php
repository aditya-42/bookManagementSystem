<?php
// Include the Book class
include 'Book.php';

// Start the session at the top
session_start();

$error = ''; // Variable to store the error message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    // Capture all form fields
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $year = trim($_POST['year']);

    // Validate form inputs
    if (empty($title) || empty($author) || empty($year)) {
        $error = 'All fields must be filled in.';
    } elseif (!is_numeric($year) || $year <= 0) {
        $error = 'Please enter a valid positive number for the year.';
    } else {
        // If inputs are valid, try to create a new Book object
        try {
            $book = new Book($title, $author, $year);
            
            // If the session array doesn't exist, create it
            if (!isset($_SESSION['books'])) {
                $_SESSION['books'] = [];
            }

            // Add the new book to the session array
            $_SESSION['books'][] = $book;
        } catch (Exception $e) {
            // Handle exception if book creation fails
            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Management System</title>
</head>
<body>
    <h1>Add a book</h1>
    
    <!-- FORM -->
    <form method="POST">
        <input type="text" placeholder="Book title" id="title" name="title"><br><br>
        <input type="text" placeholder="Author name" id="author" name="author"><br><br>
        <input type="number" placeholder="Publishing year" id="year" name="year"><br><br>
        <button type="submit" name="add_book">Add Book</button>
    </form>

    <!-- Display error if captured while submitting the form -->
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Display the list of books -->
    <?php if (isset($_SESSION['books']) && count($_SESSION['books']) > 0): ?>
        <h2 style="text-align: center;">Book List</h2>
        <table style="margin: 0 auto;">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
            </tr>
            <?php foreach ($_SESSION['books'] as $book): ?>
                <tr><?=$book->display()?></tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">Book list empty</p>
    <?php endif; ?>
</body>
</html>
