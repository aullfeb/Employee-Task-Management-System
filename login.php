<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form method="POST" action="app/login.php">
                <h1>Login</h1>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" style="color:red; margin-bottom:10px;">
                        <?php echo stripcslashes($_GET['error']); ?>
                    </div>
                <?php } ?>
                
                <div class="input-box">
                    <input type="text" name="user_name" placeholder="Username" required>
                    <i class='bx bx-user'></i> 
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bx-lock'></i> 
                </div>
                <input type="hidden" name="role" value="employee">                
                <!-- <div class="forgot-link">
                    <a href="#">Forgot Password?</a>
                </div> -->
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
<!-- 
        <div class="form-box register">
            <form method="POST" action="app/register.php">
                <h1>Employee Register</h1>
                <div class="input-box">
                    <input type="text" name="user_name" placeholder="Username" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <input type="hidden" name="role" value="employee">
                <button type="submit" class="btn-login">Register</button>
            </form>
        </div> -->

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Click the login button to get started.</p>
                <!-- <button class="btn register-btn">Register</button> -->
            </div>
            <!-- <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div> -->
        </div>
    </div>

    <script src="css/script.js"></script>
</body>
</html>
