<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form action="login.php" method="post">
                <h1>Sign In</h1>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password"  placeholder="Password" required>
                <a href="#">Forget Your Password?</a>
                <button>Sign In</button>
                <button><a href="signup.html" role="button">Sign up</a></button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
     <script src="login.js"></script>

</body>

</html>