<!-- recipes_page.php -->
<?php
include 'includes/header.php';
include 'includes/db.php';

// Retrieve all recipes for the recipes page
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container mt-5">
        <h3>Recipes</h3>

        <!-- Display recipes -->
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
                                <a href="#" class="btn btn-primary">View Recipe</a>
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

        <?php
        // If the user is not logged in, provide a message or a prompt to log in
        if (!isset($_SESSION["user_email"])) {
            ?>
            <div class="mt-4">
                <p>Please <a href="login.php">login</a> to add your own recipes or save your favorite recipes!</p>
            </div>
        <?php } ?>

    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
