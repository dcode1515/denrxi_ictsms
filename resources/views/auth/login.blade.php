<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR Region 11 - ICT Service Management System</title>
    <!-- Importing a clean font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Particle.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <style>
        /* 
         * DESIGN SYSTEM & VARIABLES 
         * Theme: Modern Government / ICT Tech
         */
        :root {
            --primary-color: #006400; /* DENR Forest Green */
            --primary-dark: #004d00;
            --primary-light: #2ecc71; /* ICT Teal/Green accent */
            --ict-blue: #0984e3;      /* Tech Blue */
            --ict-blue-dark: #0c2461;
            --dark-bg: #1e272e;
            --light-bg: #f5f6fa;
            --text-main: #2d3436;
            --text-muted: #636e72;
            --white: #ffffff;
            --danger: #e74c3c;
            --warning: #f1c40f;
            --success: #00b894;
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --glass: rgba(255, 255, 255, 0.95);
        }

        /* RESET & BASE STYLES */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; /* Prevent scroll on desktop */
            position: relative;
        }

        /* TOAST NOTIFICATIONS */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            min-width: 300px;
            padding: 1rem;
            background: var(--white);
            border-left: 5px solid var(--primary-color);
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideIn 0.3s ease forwards;
            font-size: 0.9rem;
        }

        .toast.error { border-left-color: var(--danger); }
        .toast.success { border-left-color: var(--success); }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            to { transform: translateX(100%); opacity: 0; }
        }

        /* VIEWS MANAGEMENT */
        .view-section {
            display: none;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .view-section.active {
            display: flex; /* Restore flex for login container */
            opacity: 1;
        }

        /* DASHBOARD VIEW SPECIFIC STYLES */
        #dashboard-view {
            flex-direction: column;
            background: var(--light-bg);
            overflow-y: auto;
        }
        
        /* We keep the main container logic for the login view */
        .login-container {
            display: flex;
            width: 100%;
            height: 100%;
            background: var(--white);
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        /* 
         * LEFT PANEL: Branding & Visuals 
         */
        .left-panel {
            flex: 1.2;
            background: linear-gradient(135deg, rgba(0, 50, 0, 0.9), rgba(9, 132, 227, 0.6)), 
                        url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2073&q=80') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            padding: 3rem;
            position: relative;
            text-align: center;
            z-index: 1;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0; /* Behind text */
        }

        .brand-content {
            position: relative;
            z-index: 2; /* Above particles */
            width: 100%;
            max-width: 600px;
        }

        .brand-logo {
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            font-weight: bold;
            font-size: 2rem;
            color: var(--primary-light);
            box-shadow: 0 0 20px rgba(46, 204, 113, 0.3);
        }

        .brand-logo i {
            font-size: 42px;
        }

        .brand-content h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .brand-content h2 {
            font-size: 1.2rem;
            font-weight: 400;
            color: var(--primary-light);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
        }

        .brand-quote {
            font-style: italic;
            opacity: 0.9;
            max-width: 80%;
            line-height: 1.6;
            margin: 0 auto 2rem auto;
            font-size: 1.1rem;
        }

        .developer-info {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            padding: 0 2rem;
        }

        .developer-info p {
            margin: 3px 0;
            line-height: 1.3;
        }

        .version-badge {
            display: inline-block;
            background: rgba(0, 100, 0, 0.3);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-top: 5px;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        /* 
         * RIGHT PANEL: Login Form 
         */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 4rem;
            position: relative;
            background-color: var(--white);
        }

        .right-panel::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(9, 132, 227, 0.05) 0%, transparent 70%);
            top: -50px;
            right: -50px;
            border-radius: 50%;
            z-index: 0;
        }

        .form-wrapper {
            position: relative;
            z-index: 1;
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
        }

        .login-header {
            margin-bottom: 2.5rem;
        }

        .login-header h3 {
            font-size: 1.8rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* INPUT GROUPS (Floating Labels) */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #dfe6e9;
            border-radius: var(--border-radius);
            font-size: 1rem;
            color: var(--text-main);
            background: transparent;
            transition: var(--transition);
            outline: none;
        }

        .input-field:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(46, 204, 113, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            width: 20px;
            height: 20px;
            transition: var(--transition);
            pointer-events: none;
        }

        .input-field:focus ~ .input-icon,
        .input-field:not(:placeholder-shown) ~ .input-icon {
            color: var(--primary-color);
        }

        .input-label {
            position: absolute;
            left: 3rem;
            top: 50%;
            transform: translateY(-50%);
            background: var(--white);
            padding: 0 0.5rem;
            color: var(--text-muted);
            font-size: 1rem;
            transition: var(--transition);
            pointer-events: none;
        }

        .input-field:focus ~ .input-label,
        .input-field:not(:placeholder-shown) ~ .input-label {
            top: 0;
            font-size: 0.8rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        /* ACTIONS */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: var(--text-muted);
        }

        .checkbox-container input {
            margin-right: 0.5rem;
            accent-color: var(--primary-color);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-link {
            color: var(--ict-blue);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .forgot-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* BUTTONS */
        .btn {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .login-btn {
            background: linear-gradient(90deg, var(--primary-color), var(--ict-blue));
            color: var(--white);
            box-shadow: 0 4px 15px rgba(0, 100, 0, 0.3);
            margin-bottom: 1rem;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 100, 0, 0.4);
            filter: brightness(1.1);
        }

        .register-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .register-link {
            color: var(--ict-blue);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        /* 
         * MODAL (Registration) 
         */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
            z-index: 100;
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.open {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: var(--white);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .modal-overlay.open .modal-content {
            transform: translateY(0);
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-muted);
        }

        .modal-title {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.5rem;
            border-bottom: 2px solid var(--light-bg);
            padding-bottom: 0.5rem;
        }

        /* 
         * DASHBOARD STYLES 
         */
        .dash-header {
            background: var(--white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #dfe6e9;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .dash-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 35px;
            height: 35px;
            background: var(--ict-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .dash-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .dash-sidebar {
            background: var(--white);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            height: fit-content;
        }

        .menu-item {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            margin-bottom: 0.5rem;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(46, 204, 113, 0.1);
            color: var(--primary-color);
            font-weight: 600;
        }

        .dash-main {
            background: var(--white);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--ict-blue);
        }

        .stat-card h4 { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem; }
        .stat-card .value { font-size: 1.8rem; font-weight: 700; color: var(--text-main); }

        /* Ticket List */
        .ticket-list {
            list-style: none;
        }

        .ticket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .ticket-item:last-child { border-bottom: none; }
        .ticket-item:hover { background: #fafafa; }

        .t-info h5 { color: var(--text-main); margin-bottom: 0.2rem; }
        .t-info span { font-size: 0.8rem; color: var(--text-muted); }
        
        .status-badge {
            padding: 0.25rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-open { background: rgba(241, 196, 15, 0.2); color: #d35400; }
        .status-pending { background: rgba(9, 132, 227, 0.1); color: var(--ict-blue); }
        .status-closed { background: rgba(46, 204, 113, 0.1); color: var(--success); }

        /* New Ticket Form */
        .new-ticket-form {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: none; /* Hidden by default */
        }
        
        .new-ticket-form.active { display: block; animation: fadeIn 0.4s ease; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ced6e0;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        
        .form-control:focus { outline: none; border-color: var(--ict-blue); }

        .btn-submit {
            background: var(--ict-blue);
            color: white;
            width: auto;
            padding: 0.8rem 2rem;
        }
        .btn-submit:hover { background: var(--ict-blue-dark); }

        .btn-cancel {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid #ced6e0;
            width: auto;
            padding: 0.8rem 2rem;
            margin-right: 1rem;
        }
        .btn-cancel:hover { background: #eee; }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .left-panel { display: none; }
            .dash-container { grid-template-columns: 1fr; }
        }
        @media (max-width: 480px) {
            .right-panel { padding: 1.5rem; }
            .form-row { grid-template-columns: 1fr; }
        }

        /* Security Notice */
        .security-notice {
            background: #f8f9fa;
            border-left: 4px solid var(--primary-color);
            padding: 1rem;
            margin-top: 2rem;
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .security-notice i {
            color: var(--primary-color);
            margin-right: 8px;
        }

    </style>
</head>
<body>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- VIEW 1: LOGIN / REGISTER -->
    <div id="login-view" class="view-section active">
        <div class="login-container">
            
            <!-- LEFT PANEL: Branding -->
            <section class="left-panel">
                <!-- Particle Canvas -->
                <div id="particles-js"></div>
                
                <div class="brand-content">
                    <div class="brand-logo">
                        <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="Logo" width="100">
                    </div>
                    <h1>DENR REGION 11</h1>
                    <h2>ICT Service Management System</h2>
                    <p class="brand-quote">"Mobilizing technology for sustainable environmental governance and efficient public service."</p>
                </div>
            </section>

            <!-- RIGHT PANEL: Forms -->
            <main class="right-panel">
               <div id = "app">
                <Login><Login>
                </div>
            </main>
        </div>
    </div>

   
   <script src="{{ asset('public/js/app.js') }}?v={{ config('app.version') }}"></script>
    <script>
        /* 
         * PARTICLES.JS CONFIGURATION 
         */
        document.addEventListener('DOMContentLoaded', () => {
            particlesJS('particles-js', {
                "particles": {
                    "number": { "value": 60, "density": { "enable": true, "value_area": 800 } },
                    "color": { "value": "#ffffff" },
                    "shape": { "type": "circle" },
                    "opacity": { "value": 0.5, "random": false },
                    "size": { "value": 3, "random": true },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#2ecc71", /* Green Links */
                        "opacity": 0.4,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": { "enable": true, "mode": "grab" },
                        "onclick": { "enable": true, "mode": "push" },
                        "resize": true
                    },
                    "modes": {
                        "grab": { "distance": 140, "line_linked": { "opacity": 1 } }
                    }
                },
                "retina_detect": true
            });

            // Auto-focus username field
            document.getElementById('username').focus();
        });

      
        
    </script>
</body>
</html>