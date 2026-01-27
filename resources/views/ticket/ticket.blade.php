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
    <!-- Flat Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
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
        .navbar {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 0.5rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 3px solid var(--denr-green);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: var(--denr-dark-green);
            transition: transform 0.3s;
        }
        
        .navbar-brand:hover {
            transform: translateY(-2px);
        }
        
        .navbar-brand img {
            height: 45px;
            margin-right: 12px;
            transition: transform 0.5s;
        }
        
        .navbar-brand:hover img {
            transform: rotate(10deg);
        }
        
        .nav-link {
            font-weight: 500;
            color: #555 !important;
            padding: 0.75rem 1.25rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            margin: 0 3px;
        }
        
        .nav-link:before {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 3px;
        }
        
        .nav-link:hover:before, .nav-link.active:before {
            width: 70%;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--denr-green) !important;
            background-color: rgba(40, 167, 69, 0.05);
            transform: translateY(-2px);
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
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
            font-size: 3rem;
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
            transform: translateY(-8px);
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
        
        /* Knowledge Base & FAQ Styles */
       
        
        .kb-category-card {
            height: 100%;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            border: none;
        }
        
        .kb-category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .kb-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
            color: var(--denr-green);
            font-size: 2rem;
        }
        
        .accordion-item {
            border: none;
            margin-bottom: 15px;
            border-radius: 10px !important;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .accordion-button {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            font-weight: 600;
            color: #333;
            padding: 1.25rem 1.5rem;
            border-radius: 10px !important;
            transition: all 0.3s;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
            color: white;
            box-shadow: none;
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }
        
        .accordion-button:after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
        
        .accordion-button:not(.collapsed):after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
        
        .accordion-body {
            padding: 1.5rem;
            background-color: white;
            line-height: 1.7;
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
        
        .input-icon-right {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 1.1rem;
            z-index: 5;
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
        
        /* File Upload */
        .file-upload-area {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 2.5rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: #fafafa;
        }
        
        .file-upload-area:hover {
            border-color: var(--denr-green);
            background-color: rgba(40, 167, 69, 0.02);
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
        
        /* Check Status Button */
        .check-status-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 50px;
            padding: 15px 25px;
            font-weight: 600;
        }
        
        /* Modal Styles */
        .modal-denr .modal-header {
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
            color: white;
            border-bottom: none;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
        }
        
        .modal-denr .modal-title {
            font-weight: 600;
        }
        
        .modal-denr .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .modal-denr .modal-body {
            padding: 2rem;
        }
        
        .modal-denr .modal-footer {
            border-top: 1px solid #eee;
            padding: 1.5rem;
        }
        
        .modal-denr .close-btn {
            color: white;
            opacity: 0.8;
            transition: all 0.3s;
        }
        
        .modal-denr .close-btn:hover {
            opacity: 1;
            transform: rotate(90deg);
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
            
            .footer-link:hover {
                transform: translateX(5px);
            }
            
            .check-status-btn {
                bottom: 20px;
                right: 20px;
                padding: 12px 20px;
                font-size: 0.9rem;
            }
            
            .modal-denr .modal-body {
                padding: 1.5rem;
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
            
            .btn-group-responsive {
                display: flex;
                flex-direction: column;
                width: 100%;
            }
        }
        
        /* Utility Classes */
        .rounded-lg {
            border-radius: 12px;
        }
        
        .shadow-sm {
            box-shadow: var(--card-shadow);
        }
        
        .text-denr {
            color: var(--denr-green);
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Knowledge Base Article Cards */
        .kb-article-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid #eee;
            height: 100%;
        }
        
        .kb-article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
        
        .kb-article-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
            color: var(--denr-green);
            font-size: 1.5rem;
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background-color: rgba(255,255,255,0.8);
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .breadcrumb-item.active {
            color: var(--denr-green);
            font-weight: 500;
        }
        
        /* Knowledge Base Articles Grid */
        .knowledge-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .knowledge-article {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s;
            border-left: 4px solid var(--denr-green);
        }
        
        .knowledge-article:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .article-icon {
            font-size: 2rem;
            color: var(--denr-green);
            margin-bottom: 1rem;
        }
        
        /* Search Bar */
        .search-container {
            max-width: 600px;
            margin: 0 auto 3rem;
        }
        
        .search-box {
            position: relative;
            width: 100%;
        }
        
        .search-box input {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-left: 3.5rem;
            border-radius: 50px;
            border: 2px solid #ddd;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }
        
        .search-box input:focus {
            border-color: var(--denr-green);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.1);
            outline: none;
        }
        
        .search-icon {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 1.2rem;
        }
        
        /* Tab Styles */
        .tab-container {
            margin-bottom: 2rem;
        }
        
        .tab-nav {
            display: flex;
            border-bottom: 2px solid #eee;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .tab-btn {
            padding: 0.75rem 1.5rem;
            background: none;
            border: none;
            font-weight: 500;
            color: #666;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
        }
        
        .tab-btn:hover {
            color: var(--denr-green);
        }
        
        .tab-btn.active {
            color: var(--denr-green);
        }
        
        .tab-btn.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--denr-green);
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .tab-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Print Styles */
        @media print {
            .navbar, .footer, .hero-buttons, .btn, .check-status-btn {
                display: none !important;
            }
            
            .hero-section {
                background: white !important;
                color: black !important;
                padding: 2rem 0 !important;
            }
            
            .hero-title {
                color: black !important;
                text-shadow: none !important;
            }
            
            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
        
        /* Spacing between sections */
        .section-spacing {
            margin-top: 5rem;
            margin-bottom: 5rem;
        }
        
        .subsection-spacing {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
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

/* Enhanced Toggler */
.enhanced-toggler {
    border: none;
    padding: 0.5rem;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
    transition: all 0.3s ease;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.enhanced-toggler:hover {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.2) 0%, rgba(13, 110, 253, 0.2) 100%);
    transform: rotate(90deg);
}

.enhanced-toggler:focus {
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
}

.toggler-icon {
    color: var(--denr-green);
    font-size: 1.2rem;
}

/* Enhanced Nav Links */
.nav-enhanced {
    gap: 5px;
}

.nav-link-enhanced {
    position: relative;
    display: flex;
    align-items: center;
    padding: 0.8rem 1.2rem !important;
    margin: 0 3px;
    border-radius: 10px;
    transition: all 0.3s ease;
    color: #555 !important;
    font-weight: 500;
    background: transparent;
    text-decoration: none;
}

.nav-link-enhanced:hover {
    color: var(--denr-green) !important;
    background: rgba(40, 167, 69, 0.05);
    transform: translateY(-2px);
}

.nav-link-enhanced.active {
    color: var(--denr-green) !important;
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
    font-weight: 600;
}

.nav-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    color: var(--denr-green);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.nav-link-enhanced:hover .nav-icon {
    transform: scale(1.1);
}

.nav-link-enhanced.active .nav-icon {
    color: white;
    background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
    border-radius: 8px;
    padding: 5px;
}

.nav-text {
    font-size: 0.95rem;
    white-space: nowrap;
}

/* Status Button Special Styling */
.nav-status {
    position: relative;
    overflow: hidden;
}

.nav-status:before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.7s ease;
}

.nav-status:hover:before {
    left: 100%;
}

.nav-status .nav-icon {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

/* Nav Indicator */
.nav-indicator {
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 3px;
    background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
    border-radius: 3px;
    transition: width 0.3s ease;
}

.nav-link-enhanced:hover .nav-indicator {
    width: 60%;
}

.nav-link-enhanced.active .nav-indicator {
    width: 80%;
    background: linear-gradient(to right, var(--denr-green), var(--denr-dark-green));
}

/* Active Line */
.nav-active-line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right, 
        transparent 0%, 
        var(--denr-green) 20%, 
        var(--denr-blue) 50%, 
        var(--denr-green) 80%, 
        transparent 100%);
    opacity: 0.5;
}

/* Mobile Responsive */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .nav-enhanced {
        gap: 5px;
    }
    
    .nav-link-enhanced {
        padding: 0.8rem 1rem !important;
        margin: 2px 0;
    }
    
    .logo-wrapper {
        width: 50px;
        height: 50px;
    }
    
    .nav-logo {
        width: 35px;
        height: 35px;
    }
    
    .main-title {
        font-size: 1.2rem;
    }
    
    .subtitle {
        font-size: 0.7rem;
    }
}

@media (max-width: 575.98px) {
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

/* Add to your existing root variables if not present */
:root {
    --denr-green: #1e7e34;
    --denr-light-green: #28a745;
    --denr-dark-green: #145a32;
    --denr-blue: #0d6efd;
    --denr-light-blue: #4dabf7;
}
    </style>
</head>
<body>
    <!-- Navigation Bar -->
            @include('ticket.navbar')
    <!-- Hero Section -->
            @include('ticket.section-top')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Submit Ticket Section -->
                    <div id = "app">
                        <Ticket><Ticket>
                    </div>
            <!-- End Submit Ticket Section -->
            <!-- Knowledge Base Section -->
                    @include('ticket.knowledgebase')
            <!-- End Knowledge Base Section -->
            <!-- FAQ Section -->
                @include('ticket.faq')
                <!-- End FAQ Section -->
        </div>
    </div>

   
    
    <!-- Footer -->
        @include('ticket.footer')

    <!-- Bootstrap JS (for accordion and modal functionality) -->
  
    <script src="{{ asset('public/js/app.js') }}"></script>
    
</body>
</html>