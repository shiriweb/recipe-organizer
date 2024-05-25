<?php
include ('../../admin/class/recipe_class.php');
$recipeObj = new Recipe();
$datalist = $recipeObj->retrieve();
// Check if the form is submitted
if(isset($_GET['query'])) {
    // Get the search query from the form
    $query = $_GET['query'];

    // Perform the search (you would replace this with your own search logic)
    // For demonstration purposes, we're just displaying the search query here
    echo "<h2>Search Results for: $query</h2>";
    echo "<p>This is where you would display search results from your database.</p>";
} else {
    // If the form is not submitted, redirect back to the search page
    header("Location: search.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
</head>
<body>
    <h2>Search</h2>
    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Enter your search query">
        <button type="submit">Search</button>
    </form>
</body>
</html>