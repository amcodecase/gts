<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Hash the password using MD5
    $hashed_password = md5($password);

    // Prepare and execute SQL query to check for the user
    $query = "SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful, start session and redirect
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        header("Location: home.php?section=home"); // Redirect to home page
        exit();
    } else {
        // Incorrect email or password
        $error_message = "Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <style>
        @font-face {
            font-family: Poppins-Regular;
            src: url('../fonts/poppins/Poppins-Regular.ttf'); 
        }

        .wrap-login100 {
            width: 420px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            padding: 60px 50px 40px 50px;
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.1);
            height: 550px;
        }

        .limiter {
            width: 100%;
            margin: 0 auto;
        }

        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .login100-pic {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login100-form {
            width: 100%;
        }

        .input100 {
            font-family: Poppins-Regular;
            font-size: 16px;
            color: #333333;
            line-height: 1.2;
            display: block;
            width: 100%;
            background: #e6e6e6;
            height: 50px;
            border-radius: 25px;
            padding: 0 30px 0 68px;
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333;
        }

        .login100-form-btn {
            font-family: Poppins-Medium;
            font-size: 16px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;
            width: 100%;
            height: 50px;
            border-radius: 25px;
            background: #57b846;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 25px;
            transition: all 0.4s;
        }

        .login100-form-btn:hover {
            background: #333333;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 15px;
        }
    </style>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/icons8-username-96.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" action="index.php" method="POST">
                    <span class="login100-form-title">
                        Staff Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password" required id="password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <span class="input-icon" onclick="togglePassword()">
                            <i id="eye-icon" class="fa fa-eye" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Error Message -->
                    <?php if (isset($error_message)): ?>
                        <div class="error-message" id="error-message">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">Forgot</span>
                        <a class="txt2" href="#">Password?</a>
                        <label style="color: grey;">|</label>
                        <a class="txt2" href="#">Create Account</a>
                    </div>

                    <div class="text-center p-t-136">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
    <script src="js/main.js"></script>

</body>
</html>
