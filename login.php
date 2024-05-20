<?php require_once "includes/header.php"; ?>
<?php require_once "includes/db.php"; ?>

<?php
if (isset($_SESSION["user_email"])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['login_form'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $loginQuery = "SELECT mail, password FROM tbl_users WHERE LOWER(mail) = LOWER('$email');";
    $select = mysqli_query($conn, $loginQuery);

    if (!$select) {
        die(mysqli_error($conn));
    }

    if (mysqli_num_rows($select) > 0) {
        // Passwords are not encrypted, check if the provided password matches the one in the database
        $row = mysqli_fetch_assoc($select);
        $passwordFromDatabase = $row['password'];

        if ($password === $passwordFromDatabase) {
            session_start();
            if (isset($_POST['remember_me']) && $_POST['remember_me'] === "1") {
                setcookie("user_email", $email, time() + 60 * 60 * 24 * 7);
            }
            $_SESSION['user_email'] = $email;
            header('Location: index.php');
            exit;
        } else {
            echo '<div class="alert alert-danger col-8 col-md-6" role="alert">Incorrect email or password</div>';
        }
    } else {
        echo '<div class="alert alert-danger col-8 col-md-6" role="alert">Incorrect email or password</div>';
    }
}
?>

<main class="container mt-5">
    <h2>Please sign in</h2>

    <!-- Form of Login -->
    <form method="POST">
        <div class="col-8 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email" aria-describedby="emailHelp" required>
        </div>
        <div class="col-8 col-md-6">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" minlength="4" required>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="1" name="remember_me"> Remember me
            </label>
        </div>
        <button name='login_form' class="btn btn-primary" type="submit">Submit</button>
    </form>

    <!-- Link for forgetting password -->
    <div>
        <a href="forgot_pwd.php">Forgot Password?</a>
    </div>
</main>

<?php require_once "includes/footer.php"; ?>
