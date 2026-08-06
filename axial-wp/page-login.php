<?php
/*
Template Name: Custom Backend Login
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Access - <?php bloginfo('name'); ?></title>
    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
        body.login-page-bg {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Sleek dark gradient background */
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            font-family: 'Outfit', sans-serif;
            position: relative;
            overflow: hidden;
        }
        
        /* Decorative ambient glow */
        .login-page-bg::before {
            content: '';
            position: absolute;
            width: 40vw;
            height: 40vw;
            background: radial-gradient(circle, rgba(243,156,18,0.15) 0%, rgba(0,0,0,0) 70%);
            top: -10vw;
            left: -10vw;
            border-radius: 50%;
            z-index: 1;
        }
        .login-page-bg::after {
            content: '';
            position: absolute;
            width: 30vw;
            height: 30vw;
            background: radial-gradient(circle, rgba(52,152,219,0.15) 0%, rgba(0,0,0,0) 70%);
            bottom: -5vw;
            right: -10vw;
            border-radius: 50%;
            z-index: 1;
        }

        .login-wrapper {
            z-index: 2;
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        /* Glassmorphism Panel */
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            text-align: center;
            color: #fff;
            animation: fadeIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .brand-logo-wrapper {
            margin-bottom: 20px;
        }
        
        .brand-logo-wrapper img {
            max-width: 80px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            border: 2px solid rgba(255,255,255,0.1);
        }

        .glass-panel h2 {
            margin-top: 0;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 32px;
            letter-spacing: -0.5px;
        }

        .glass-panel p.subtitle {
            color: rgba(255,255,255,0.6);
            margin-bottom: 35px;
            font-size: 15px;
        }

        .input-group {
            margin-bottom: 24px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255,255,255,0.8);
            letter-spacing: 0.5px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            background: rgba(255,255,255,0.08);
            color: #fff;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }

        .input-group input::placeholder {
            color: rgba(255,255,255,0.3);
        }

        .input-group input:focus {
            background: rgba(255,255,255,0.12);
            border-color: rgba(243,156,18,0.5);
            box-shadow: 0 0 0 4px rgba(243,156,18,0.1);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #f39c12 0%, #d35400 100%);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(211,84,0,0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(211,84,0,0.4);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .copyright {
            margin-top: 30px;
            font-size: 13px;
            color: rgba(255,255,255,0.3);
        }
    </style>
</head>
<body class="login-page-bg">

    <div class="login-wrapper">
        <div class="glass-panel">
            <div class="brand-logo-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="Logo">
            </div>
            <h2>System Access</h2>
            <p class="subtitle">Enter your credentials to continue</p>
            
            <form action="" method="POST">
                <div class="input-group">
                    <label for="employeeid">Employee ID / Username</label>
                    <input type="text" id="employeeid" name="employeeid" placeholder="e.g. EMP-001" required autocomplete="off">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login">Secure Login</button>
            </form>
            <div class="copyright">
                &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </div>
        </div>
    </div>

<?php wp_footer(); ?>
</body>
</html>
