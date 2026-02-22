

<?php
$json_file = 'users.json';
$message = "";

// Helper function to get users from JSON
function get_users($file) {
    if (!file_exists($file)) return [];
    $data = file_get_contents($file);
    return json_decode($data, true) ?: [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $users = get_users($json_file);

    // --- REGISTER LOGIC ---
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        $exists = false;

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $message = "<div class='error-msg'>Account already exists!</div>";
        } else {
            $newUser = [
                'full_name' => $_POST['full_name'],
                'email'     => $email,
                'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            $users[] = $newUser;
            file_put_contents($json_file, json_encode($users, JSON_PRETTY_PRINT));
            $message = "<div class='success-msg'>Account created successfully! Please login.</div>";
        }
    }

    // --- LOGIN LOGIC ---
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $found = false;

        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                header("Location: reservation.php?login=success");
                exit();
            }
        }

        if (!$found) {
            $message = "<div class='error-msg'>Invalid email or password.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - CHMSUOTEL</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #008a13;
            --primary-green-hover: #006b0f;
            --text-dark: #0f1b29;
            --text-light: #555;
            --bg-light: #f5f5f5;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Jost', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-sans);
            color: var(--text-dark);
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HEADER --- */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            height: 80px;
            padding: 0 5%;
            background: white;
            z-index: 1000;
        }

        .logo-text {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 5%;
            background-color: var(--bg-light);
        }

        .auth-card {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            text-align: center;
        }

        .tabs {
            display: flex;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
        }

        .tab {
            flex: 1;
            padding: 12px;
            cursor: pointer;
            font-weight: 500;
            color: #888;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .tab.active {
            color: var(--primary-green);
            border-bottom: 2px solid var(--primary-green);
        }

        form { display: none; flex-direction: column; text-align: left; }
        form.active { display: flex; }

        .form-group { margin-bottom: 20px; }
        label { 
            display: block; 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            margin-bottom: 8px; 
            font-weight: 600;
            letter-spacing: 1px;
        }

        input { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            font-family: var(--font-sans);
            font-size: 1rem;
        }

        input:focus { outline: none; border-color: var(--primary-green); }

        .btn {
            background: var(--primary-green);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn:hover { background: var(--primary-green-hover); }

        .error-msg, .success-msg {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            border: 1px solid;
        }
        .error-msg { color: #d9534f; background: #fdf7f7; border-color: #d9534f; }
        .success-msg { color: #28a745; background: #f4fff4; border-color: #28a745; }

        .toggle-text { margin-top: 25px; font-size: 0.85rem; color: #666; }
        .toggle-text span { color: var(--primary-green); cursor: pointer; font-weight: 500; }

        /* --- FOOTER --- */
        footer {
            background: #0f1b29;
            color: white;
            text-align: center;
            padding: 40px 5%;
        }

        footer p {
            font-size: 0.8rem;
            color: #aaa;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<header>
    <a href="menu.php" class="logo-text">CHMSUOTEL</a>
    <a href="menu.php" style="text-decoration: none; color: var(--text-light); font-size: 0.8rem; text-transform: uppercase;">← Back to Home</a>
</header>

<main class="main-content">
    <div class="auth-card">
        <?php echo $message; ?>

        <div class="tabs">
            <div class="tab active" id="loginTab" onclick="switchTab('login')">Login</div>
            <div class="tab" id="registerTab" onclick="switchTab('register')">Create Account</div>
        </div>

        <form id="loginForm" class="active" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login" class="btn">Sign In</button>
                  </form>

        <form id="registerForm" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="name@example.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" name="register" class="btn">Create Account</button>
        </form>

        <div class="toggle-text">
            <p id="footerText">Don't have an account? <span onclick="switchTab('register')">Sign Up</span></p>
        </div>
    </div>
</main>

<footer>
    <h3 style="font-family: var(--font-serif); font-size: 1.2rem;">CHMSUOTEL</h3>
    <p>&copy; 2024 CHMSUOTEL. All rights reserved.</p>
</footer>

<script>
    function switchTab(type) {
        const loginForm = document.getElementById('loginForm');
        const regForm = document.getElementById('registerForm');
        const loginTab = document.getElementById('loginTab');
        const regTab = document.getElementById('registerTab');
        const footerText = document.getElementById('footerText');

        if (type === 'register') {
            loginForm.classList.remove('active');
            regForm.classList.add('active');
            loginTab.classList.remove('active');
            regTab.classList.add('active');
            footerText.innerHTML = 'Already have an account? <span onclick="switchTab(\'login\')">Login</span>';
        } else {
            regForm.classList.remove('active');
            loginForm.classList.add('active');
            regTab.classList.remove('active');
            loginTab.classList.add('active');
            footerText.innerHTML = 'Don\'t have an account? <span onclick="switchTab(\'register\')">Sign Up</span>';
        }
    }
</script>

</body>
</html>