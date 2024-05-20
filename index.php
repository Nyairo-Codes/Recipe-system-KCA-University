<?php
include 'includes/header.php';
include 'includes/db.php';

// Redirect to login page if user is not connected
if (!isset($_SESSION["user_email"])) {
    header('Location: login.php');
    exit;
}

// Retrieve latest recipes for the homepage
$sql = "SELECT * FROM recipes ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container mt-5">
        <h3>Welcome to the Flavour Full plate</h3>

        <!-- Display latest recipes -->
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row['image']; ?>" class="card-img-top img-fluid" alt="Recipe Image" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <!-- Add a link to view the recipe details -->
                                <a href="view_recipe.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Recipe</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "No recipes found.";
            }
            ?>
        </div>

        <hr>

        <!-- Add a link to view all recipes -->
        <p class="text-center"><a href="recipes_page.php" class="btn btn-secondary">View All Recipes</a></p>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
