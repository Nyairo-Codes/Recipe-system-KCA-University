<?php
include 'includes/header.php';
include 'includes/db.php';

// Redirect to login page if user is not connected
if (!isset($_SESSION["user_email"])) {
    header('Location: login.php');
    exit;
}

// Check if a recipe ID is provided in the URL
if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    
    // Retrieve the details of the selected recipe
    $sql = "SELECT * FROM recipes WHERE id = $recipeId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $image = $row['image'];
        $created_at = $row['created_at'];
    } else {
        // Redirect to recipes.php if the recipe ID is not valid
        header('Location: recipes.php');
        exit;
    }
} else {
    // Redirect to recipes.php if no recipe ID is provided
    header('Location: recipes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mystyle.css">
    <title>Food Lovers - View Recipe</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Recipe Details</h3>

        <div class="card">
            <img src="<?php echo $image; ?>" class="card-img-top img-fluid" alt="Recipe Image" style="height: 300px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <p class="card-text"><?php echo $description; ?></p>
                <p class="card-text"><small class="text-muted">Created at: <?php echo $created_at; ?></small></p>
            </div>
        </div>

        <!-- Add a link to go back to recipes.php -->
        <p class="mt-3"><a href="recipes_page.php" class="btn btn-secondary">Back to Recipes</a></p>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
