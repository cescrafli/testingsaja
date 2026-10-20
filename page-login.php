<?php
/**
 * Template Name: Employee Login
 */

session_start();

// Redirect logged-in users directly to dashboard without adding to history
if (isset($_SESSION['emp_id']) && isset($_SESSION['emp_role'])) {
    echo '<script>window.location.replace("' . home_url( '/employee-dashboard/' ) . '");</script>';
    exit;
}

$step = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'login';
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $wpdb;
    
    // 1. NORMAL LOGIN
    if (isset($_POST['emp_username']) && isset($_POST['emp_password'])) {
        $username = sanitize_text_field( $_POST['emp_username'] );
        $password = $_POST['emp_password'];

        $table_name = 'wp_employee';
        $query = $wpdb->prepare( "SELECT * FROM {$table_name} WHERE username = %s AND password = %s", $username, $password );
        $user = $wpdb->get_row( $query );

        if ( $user ) {
            if ( isset($user->status) && $user->status != 1 ) {
                $error_message = "Akun Anda telah dinonaktifkan. Silakan hubungi Administrator.";
            } else {
                $wpdb->query( $wpdb->prepare( "UPDATE {$table_name} SET last_login = NOW() WHERE username = %s", $username ) );
                
                $_SESSION['emp_id'] = isset($user->employee_id) ? $user->employee_id : $user->id;
                $_SESSION['emp_username'] = $user->username;
                $_SESSION['emp_role'] = $user->role;
                
                echo '<script>window.location.replace("' . home_url( '/employee-dashboard/' ) . '");</script>';
                exit;
            }
        } else {
            $error_message = "Username atau password salah.";
        }
    }
    
    // 2. REQUEST OTP
    if (isset($_POST['forgot_email'])) {
        $email = sanitize_email($_POST['forgot_email']);
        $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM wp_employee WHERE email = %s", $email));
        
        if ($user) {
            $otp = mt_rand(100000, 999999);
            $_SESSION['reset_otp'] = $otp;
            $_SESSION['reset_email'] = $email;
            
            $to = $email;
            $subject = 'Kode OTP Reset Password - Griya Djaya Sentosa';
            $message = "Kode OTP Anda untuk reset password adalah: " . $otp . "\n\nJangan berikan kode ini kepada siapapun.";
            $headers = array('Content-Type: text/plain; charset=UTF-8');
            
            wp_mail($to, $subject, $message, $headers);
            
            $step = 'otp';
            $success_message = "Kode OTP telah dikirim ke email Anda.";
        } else {
            $error_message = "Email tidak ditemukan di sistem kami.";
            $step = 'forgot';
        }
    }
    
    // 3. VERIFY OTP
    if (isset($_POST['verify_otp'])) {
        $entered_otp = sanitize_text_field($_POST['verify_otp']);
        if (isset($_SESSION['reset_otp']) && $entered_otp == $_SESSION['reset_otp']) {
            $step = 'reset';
        } else {
            $error_message = "Kode OTP salah atau tidak valid.";
            $step = 'otp';
        }
    }
    
    // 4. SET NEW PASSWORD
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $email = $_SESSION['reset_email'];
            $new_password = $_POST['new_password']; 
            
            $wpdb->update('wp_employee', array('password' => $new_password), array('email' => $email));
            
            unset($_SESSION['reset_otp']);
            unset($_SESSION['reset_email']);
            
            $success_message = "Password berhasil diubah. Silakan login kembali dengan password baru Anda.";
            $step = 'login';
        } else {
            $error_message = "Konfirmasi password tidak cocok.";
            $step = 'reset';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Karyawan | Griya Djaya Sentosa</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            /* Elegant White/Gold Theme Background */
            background-color: #faf8f5; 
            background-image: radial-gradient(circle at 10% 20%, rgba(212, 181, 114, 0.08) 0%, transparent 40%),
                              radial-gradient(circle at 90% 80%, rgba(212, 181, 114, 0.1) 0%, transparent 40%);
            color: #333;
            font-family: 'Outfit', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
        }

        .login-container {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 50px 40px;
            border-radius: 16px;
            /* Soft gold glow shadow */
            box-shadow: 0 20px 40px -10px rgba(212, 181, 114, 0.2), 0 0 1px rgba(212, 181, 114, 0.5);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .logo-area {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-bottom: 35px;
        }
        
        .logo-area img {
            width: 75px;
            height: auto;
            /* Gold filter */
            filter: invert(66%) sepia(21%) saturate(1005%) hue-rotate(5deg) brightness(95%) contrast(89%);
        }
        
        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            color: #a17c43;
            text-align: left;
            line-height: 1.1;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .page-desc {
            font-size: 14px;
            color: #666;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-input:focus {
            border-color: #d4b572;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(212, 181, 114, 0.15);
        }

        .submit-btn {
            width: 100%;
            padding: 15px 20px;
            background: linear-gradient(135deg, #d4b572 0%, #b89852 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-family: 'Playfair Display', serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px -5px rgba(212, 181, 114, 0.4);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -5px rgba(212, 181, 114, 0.5);
            background: linear-gradient(135deg, #debe7a 0%, #a17c43 100%);
        }
        
        .forgot-password, .back-link {
            color: #a17c43;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
            font-family: 'Outfit', sans-serif;
            display: inline-block;
            border-bottom: 1px solid transparent;
        }
        
        .forgot-password:hover, .back-link:hover {
            color: #8a6a34;
            border-bottom: 1px solid #8a6a34;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #888;
            font-weight: 400;
            letter-spacing: 0.5px;
        }
        
        .error-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .success-box {
            background: #fdfaf0;
            border: 1px solid #fce8b2;
            color: #b48c48;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 25px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-area">
            <img src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="Griya Djaya Sentosa">
            <div class="logo-text">Griya Djaya<br>Sentosa</div>
        </div>
        
        <?php if ( ! empty( $error_message ) ) : ?>
            <div class="error-box">
                <?php echo esc_html($error_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $success_message ) ) : ?>
            <div class="success-box">
                <?php echo esc_html($success_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($step === 'login'): ?>
            <!-- LOGIN FORM -->
            <h1 class="page-title">Portal Karyawan</h1>
            <p class="page-desc">Silakan masukkan username dan password Anda</p>
            
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" id="emp_username" name="emp_username" class="form-input" placeholder="Username" required autocomplete="off">
                </div>
                
                <div class="form-group">
                    <input type="password" id="emp_password" name="emp_password" class="form-input" placeholder="Password" required>
                </div>
                
                <button type="submit" class="submit-btn">Login ke Portal</button>
            </form>
            
            <a href="?action=forgot" class="forgot-password">Lupa Password?</a>
            
        <?php elseif ($step === 'forgot'): ?>
            <!-- FORGOT PASSWORD FORM -->
            <h1 class="page-title">Reset Password</h1>
            <p class="page-desc">Masukkan alamat email yang terdaftar untuk menerima kode OTP.</p>
            
            <form action="" method="POST">
                <div class="form-group">
                    <input type="email" name="forgot_email" class="form-input" placeholder="Alamat Email Anda" required autocomplete="off">
                </div>
                
                <button type="submit" class="submit-btn">Kirim OTP</button>
            </form>
            
            <a href="?action=login" class="back-link">Kembali ke Login</a>
            
        <?php elseif ($step === 'otp'): ?>
            <!-- OTP VERIFICATION FORM -->
            <h1 class="page-title">Verifikasi OTP</h1>
            <p class="page-desc">Masukkan 6 digit kode OTP yang telah kami kirimkan ke email Anda.</p>
            
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="verify_otp" class="form-input" placeholder="Kode OTP (Contoh: 123456)" required autocomplete="off" maxlength="6" style="text-align: center; letter-spacing: 2px; font-size: 18px; font-weight: bold;">
                </div>
                
                <button type="submit" class="submit-btn">Verifikasi Kode</button>
            </form>
            
            <a href="?action=login" class="back-link">Kembali ke Login</a>
            
        <?php elseif ($step === 'reset'): ?>
            <!-- NEW PASSWORD FORM -->
            <h1 class="page-title">Password Baru</h1>
            <p class="page-desc">Silakan masukkan password baru Anda.</p>
            
            <form action="" method="POST">
                <div class="form-group">
                    <input type="password" name="new_password" class="form-input" placeholder="Password Baru" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-input" placeholder="Ulangi Password Baru" required>
                </div>
                
                <button type="submit" class="submit-btn">Simpan Password Baru</button>
            </form>
        <?php endif; ?>
    </div>

    <div style="position: absolute; bottom: 30px; left: 30px; font-size: 11px; color: #9ca3af; opacity: 0.6;">&copy; cescrafli</div>
    <div class="footer">
        &copy; <?php echo date('Y'); ?> GRIYA DJAYA SENTOSA. All rights reserved.
    </div>
</body>
</html>
