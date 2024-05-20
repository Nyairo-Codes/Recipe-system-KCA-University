<!-- search.php -->
<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST['search'];

    // Perform a basic search query
    $sql = "SELECT * FROM recipes WHERE title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
}
?>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Search Recipes</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search for recipes..." name="search" required>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="row">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="Recipe Image" style="height: 200px; object-fit: cover;">
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
                    echo '<div class="col-md-12">No recipes found.</div>';
                }
            }
            $conn->close();
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
