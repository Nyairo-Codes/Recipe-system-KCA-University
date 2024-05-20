<?php
require_once "includes/header.php";
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have your registration logic here...
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM tbl_users WHERE mail = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists, display an error message
        echo '<div class="alert alert-danger" role="alert">Error: Email is already registered!</div>';
    } else {
        // Email doesn't exist, perform the registration logic and database insertion here...
        $insertUserQuery = "INSERT INTO tbl_users (mail, password) VALUES ('$email', '$password')";

        if ($conn->query($insertUserQuery) === TRUE) {
            // After successful registration
            $successMessage = "Registration successful! Redirecting to login page...";
            echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 3000);
                  </script>';
        } else {
            // If there's an error with the database insertion
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }
    }
}
?>

<script>
    function checkForm(form) {
        if (form.password.value !== form.password2.value) {
            alert("Error: the passwords don't match!");
            form.password2.focus();
            return false;
        }
        return true;
    }
</script>

<div class="container mt-5">
    <h2>Register Page</h2>

    <form method="POST" action="" onsubmit="return checkForm(this);">
        <div class="col-8 col-md-6">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email" aria-describedby="emailHelp" required>
        </div>
        <div class="col-8 col-md-6">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" minlength="4" required>
        </div>
        <div class="col-8 col-md-6">
            <label for="exampleInputPassword2" class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" id="password2" name="password2" minlength="4" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" value="Add">Submit</button>
    </form>
</div>

<?php require_once "includes/footer.php"; ?>
