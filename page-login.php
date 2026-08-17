<?php
/**
 * Template Name: Employee Login
 */

// Handle Form Submission
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['emp_username'] ) && isset( $_POST['emp_password'] ) ) {
    global $wpdb;
    $username = sanitize_text_field( $_POST['emp_username'] );
    $password = $_POST['emp_password']; // Menggunakan Plain Text seperti yang diminta

    // Nama tabel karyawan (spesifik wp_employee sesuai permintaan)
    $table_name = 'wp_employee';

    // Query untuk mencocokkan username dan password
    $query = $wpdb->prepare( "SELECT * FROM {$table_name} WHERE username = %s AND password = %s", $username, $password );
    $user = $wpdb->get_row( $query );

    if ( $user ) {
        // Jika Berhasil Login -> Redirect ke about.html
        wp_redirect( 'https://griyadjayasentosa.id/about.html' );
        exit;
    } else {
        // Jika Gagal Login -> Redirect ke services.html
        wp_redirect( 'https://griyadjayasentosa.id/services.html' );
        exit;
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
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            overflow: hidden;
            position: relative;
        }

        /* Background Elements - Menggunakan warna emas logo */
        .bg-shape {
            position: absolute;
            filter: blur(100px);
            opacity: 0.4;
            z-index: 0;
            animation: float 10s infinite ease-in-out alternate;
        }
        .shape-1 {
            width: 400px;
            height: 400px;
            background: #b69b32; /* Warna Emas dari logo rumah */
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        .shape-2 {
            width: 500px;
            height: 500px;
            background: #0DA574; /* Teal (Aksen) */
            border-radius: 50%;
            bottom: -150px;
            right: -100px;
            animation-delay: -5s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, 50px) scale(1.1); }
        }

        /* Glassmorphism Card (UI Sangat Premium) */
        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3.5rem 3rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header img {
            width: 70px;
            height: auto;
            margin-bottom: 1.25rem;
            filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.3));
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, #fff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-header p {
            color: #94a3b8;
            font-size: 0.95rem;
            font-weight: 300;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            color: #fff;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #b69b32;
            box-shadow: 0 0 0 4px rgba(182, 155, 50, 0.2);
            background: rgba(15, 23, 42, 0.8);
        }

        .form-input::placeholder {
            color: #475569;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #b69b32 0%, #8e7825 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1.1rem;
            font-size: 1.05rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(182, 155, 50, 0.3);
            margin-top: 1rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(182, 155, 50, 0.4);
        }

        .submit-btn:active {
            transform: translateY(1px);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2.5rem;
            font-size: 0.75rem;
            color: #475569;
            letter-spacing: 0.05em;
        }
        
        /* Hilangkan elemen bawaan WordPress jika ter-render secara kebetulan */
        #wpadminbar { display: none !important; }
        html { margin-top: 0 !important; }
    </style>
</head>
<body>
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    
    <div class="login-card">
        <div class="login-header">
            <!-- Menggunakan Logo Emas yang sudah dibuat -->
            <img src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="Logo Griya Djaya Sentosa">
            <h1>Portal Karyawan</h1>
            <p>Masukkan kredensial Anda untuk melanjutkan</p>
        </div>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="emp_username" class="form-label">Username</label>
                <input type="text" id="emp_username" name="emp_username" class="form-input" placeholder="contoh: budi_gds" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="emp_password" class="form-label">Password</label>
                <input type="password" id="emp_password" name="emp_password" class="form-input" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="submit-btn">Login ke Portal</button>
        </form>
        
        <div class="auth-footer">
            &copy; <?php echo date('Y'); ?> GRIYA DJAYA SENTOSA
        </div>
    </div>
</body>
</html>
