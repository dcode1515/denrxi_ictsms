<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR XI - ICT Helpdesk System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --denr-green: #1e7e34;
            --denr-light-green: #28a745;
            --denr-dark-green: #145a32;
            --denr-blue: #0d6efd;
            --denr-light-blue: #4dabf7;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.07), 0 4px 6px rgba(0, 0, 0, 0.05);
            --section-padding: 80px 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background-color: var(--light-bg);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #222;
        }
        
        /* Enhanced Navbar */
        .navbar-enhanced {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(30, 126, 52, 0.1);
            transition: all 0.3s ease;
        }

        .navbar-enhanced.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        /* Brand Container */
        .brand-container {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 5px 0;
        }

        /* Logo Wrapper */
        .logo-wrapper {
            position: relative;
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
            border-radius: 12px;
            padding: 5px;
            box-shadow: 0 4px 12px rgba(30, 126, 52, 0.2);
            transition: all 0.3s ease;
        }

        .logo-wrapper:hover {
            transform: translateY(-2px) rotate(3deg);
            box-shadow: 0 6px 20px rgba(30, 126, 52, 0.3);
        }

        .nav-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            transition: transform 0.5s ease;
        }

        .logo-wrapper:hover .nav-logo {
            transform: scale(1.1);
        }

        .logo-badge {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background: #ff6b35;
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Brand Text */
        .brand-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .main-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--denr-dark-green);
            line-height: 1.2;
            letter-spacing: -0.5px;
            transition: color 0.3s ease;
        }

        .brand-container:hover .main-title {
            color: var(--denr-green);
        }

        .subtitle {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6c757d;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 2px;
            opacity: 0.9;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(30, 126, 52, 0.9) 0%, rgba(20, 90, 50, 0.95) 100%);
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,160L48,165.3C96,171,192,181,288,170.7C384,160,480,128,576,138.7C672,149,768,203,864,218.7C960,235,1056,213,1152,181.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .hero-buttons {
            margin-top: 2rem;
            position: relative;
            z-index: 1;
        }
        
        /* Main Content */
        .main-content {
            padding-bottom: 3rem;
            flex: 1;
        }
        
        /* Card Design */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            border-top: 4px solid var(--denr-green);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .section-title {
            color: var(--denr-dark-green);
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
            border-radius: 2px;
        }
        
        /* Form Elements */
        .form-label {
            font-weight: 500;
            color: #444;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: all 0.2s;
            background-color: #fdfdfd;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--denr-green);
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        /* Enhanced Form Inputs with Icons */
        .form-group-icon {
            position: relative;
        }
        
        .form-control-icon {
            padding-left: 3rem !important;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--denr-green);
            font-size: 1.1rem;
            z-index: 5;
        }
        
        /* Button Styles */
        .btn-denr {
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 500;
            border: none;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-denr:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s;
        }
        
        .btn-denr:hover:before {
            left: 100%;
        }
        
        .btn-denr:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.2);
        }
        
        .btn-outline-denr {
            background-color: transparent;
            color: var(--denr-green);
            border: 2px solid var(--denr-green);
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-outline-denr:hover {
            background-color: rgba(40, 167, 69, 0.05);
            color: var(--denr-dark-green);
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(40, 167, 69, 0.1);
        }
        
        /* Results Section */
        .results-container {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .results-container.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Ticket Status Display */
        .ticket-status-display {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 2rem;
            margin-top: 2rem;
            border-left: 4px solid var(--denr-green);
        }
        
        .ticket-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .ticket-detail-item {
            background: white;
            padding: 1.25rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .ticket-detail-item strong {
            color: #555;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .status-badge.pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #e6b400;
        }
        
        .status-badge.in-progress {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        .status-badge.resolved {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--denr-green);
        }
        
        .status-badge.closed {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }
        
        /* Timeline for Ticket Progress */
        .timeline {
            position: relative;
            padding-left: 2rem;
            margin: 2rem 0;
        }
        
        .timeline:before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        
        .timeline-item:before {
            content: '';
            position: absolute;
            left: -1.9rem;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ddd;
            border: 3px solid white;
        }
        
        .timeline-item.active:before {
            background: var(--denr-green);
        }
        
        .timeline-item.completed:before {
            background: var(--denr-green);
        }
        
        .timeline-date {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .timeline-content {
            font-size: 0.95rem;
        }
        
        /* No Results State */
        .no-results {
            text-align: center;
            padding: 3rem 1rem;
        }
        
        .no-results i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        
        /* Loading Spinner */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
        }
        
        .loading-spinner.active {
            display: block;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ddd;
            padding: 4rem 0 2rem;
            margin-top: auto;
            position: relative;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
        }
        
        .footer-logo {
            height: 70px;
            margin-bottom: 1.5rem;
            filter: brightness(0) invert(1);
            transition: transform 0.5s;
        }
        
        .footer-logo:hover {
            transform: scale(1.05);
        }
        
        .footer-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 12px;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
        }
        
        .contact-info {
            color: #bbb;
            font-size: 0.95rem;
            line-height: 1.8;
        }
        
        .contact-info i {
            color: var(--denr-light-green);
            width: 20px;
            margin-right: 10px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .social-link:hover {
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-blue) 100%);
            transform: translateY(-5px) rotate(10deg);
        }
        
        .copyright {
            border-top: 1px solid #444;
            padding-top: 1.5rem;
            margin-top: 3rem;
            text-align: center;
            font-size: 0.85rem;
            color: #888;
        }
        
        .copyright a {
            color: var(--denr-light-green);
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .copyright a:hover {
            color: var(--denr-light-blue);
            text-decoration: underline;
        }
        
        /* Responsive Design */
        @media (max-width: 1199.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 991.98px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .nav-link {
                margin: 5px 0;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-section {
                padding: 4rem 0;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .btn-responsive {
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .footer {
                text-align: center;
            }
            
            .footer-title:after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .social-links {
                justify-content: center;
            }
            
            .ticket-details {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.8rem;
            }
            
            .hero-section {
                padding: 3rem 0;
            }
            
            .btn {
                min-width: 100%;
                padding: 0.75rem 1rem;
                margin-bottom: 0.5rem;
            }
            
            .brand-container {
                gap: 12px;
            }
            
            .logo-wrapper {
                width: 45px;
                height: 45px;
            }
            
            .nav-logo {
                width: 30px;
                height: 30px;
            }
            
            .main-title {
                font-size: 1.1rem;
            }
            
            .subtitle {
                font-size: 0.65rem;
            }
        }
        
        /* Utility Classes */
        .rounded-lg {
            border-radius: 12px;
        }
        
        .text-denr {
            color: var(--denr-green);
        }
        
        .hidden {
            display: none;
        }
        
        .visible {
            display: block;
        }
         .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ddd;
            padding: 4rem 0 2rem;
            margin-top: auto;
            position: relative;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
        }
        
        .footer-logo {
            height: 70px;
            margin-bottom: 1.5rem;
            filter: brightness(0) invert(1);
            transition: transform 0.5s;
        }
        
        .footer-logo:hover {
            transform: scale(1.05);
        }
        
        .footer-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 12px;
        }
        
        .footer-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
        }
        
        .footer-link {
            color: #bbb;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: all 0.2s;
            font-size: 0.95rem;
            position: relative;
            padding-left: 0;
        }
        
        .footer-link:before {
            content: '›';
            position: absolute;
            left: 0;
            opacity: 0;
            transition: all 0.3s;
            color: var(--denr-light-green);
        }
        
        .footer-link:hover {
            color: var(--denr-light-green);
            transform: translateX(10px);
            padding-left: 15px;
        }
        
        .footer-link:hover:before {
            opacity: 1;
        }
        
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-enhanced">
        <div class="container">
            <!-- Enhanced Brand Logo -->
            <a class="navbar-brand enhanced-brand" href="#">
                <div class="brand-container">
                    <div class="logo-wrapper">
                        <!-- Using a placeholder image - replace with your actual logo -->
                         <img src="{{ URL::asset('public/images/logo/denr.png') }}" alt="DENR Logo" class="nav-logo">
                        <div class="logo-badge">XI</div>
                    </div>
                    <div class="brand-text">
                        <div class="main-title">DENR Region XI</div>
                        <div class="subtitle">ICT Helpdesk System</div>
                    </div>
                </div>
            </a>
        </div>
    </nav>
   
      <br>
       <br>
     
    <main class="main-content">
        <div id = "app">
            <Tickettrack><Tickettract>
        </div>
    </main>
    
    <!-- Footer -->
            @include('ticket.footer')
    
   
   
</body>
</html>

    <script src="{{ asset('public/js/app.js') }}"></script>