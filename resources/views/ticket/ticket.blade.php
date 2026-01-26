<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR XI - ICT Helpdesk</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --denr-green: #1e7e34;
            --denr-light-green: #28a745;
            --denr-dark-green: #145a32;
            --denr-blue: #0d6efd;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.07), 0 4px 6px rgba(0, 0, 0, 0.05);
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
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: #222;
        }
        
        /* Navbar */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: var(--denr-dark-green);
        }
        
        .navbar-brand img {
            height: 40px;
            margin-right: 12px;
        }
        
        .nav-link {
            font-weight: 500;
            color: #555 !important;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--denr-green) !important;
            background-color: rgba(40, 167, 69, 0.05);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(30, 126, 52, 0.9) 0%, rgba(20, 90, 50, 0.95) 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Main Content */
        .main-content {
            padding-bottom: 3rem;
            flex: 1;
        }
        
        /* Card Design */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .card-header {
            background-color: white;
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
            border-bottom: 2px solid rgba(40, 167, 69, 0.2);
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
            border-radius: 8px;
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
            background-color: var(--denr-green);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: all 0.2s;
        }
        
        .btn-denr:hover {
            background-color: var(--denr-dark-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-outline-denr {
            background-color: transparent;
            color: var(--denr-green);
            border: 1px solid var(--denr-green);
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-outline-denr:hover {
            background-color: rgba(40, 167, 69, 0.05);
            color: var(--denr-dark-green);
        }
        
        /* File Upload */
        .file-upload-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
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
        
        .file-item {
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #eee;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ddd;
            padding: 3rem 0 1.5rem;
            margin-top: auto;
        }
        
        .footer-logo {
            height: 60px;
            margin-bottom: 1.5rem;
            filter: brightness(0) invert(1);
        }
        
        .footer-title {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
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
        }
        
        .footer-link:hover {
            color: var(--denr-light-green);
            transform: translateX(5px);
        }
        
        .contact-info {
            color: #bbb;
            font-size: 0.95rem;
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
            background-color: var(--denr-green);
            transform: translateY(-5px);
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
        }
        
        /* Ticket Preview */
        .ticket-preview {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 2rem;
            margin-top: 2rem;
            display: none;
        }
        
        .preview-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .preview-label {
            font-weight: 500;
            color: #666;
            font-size: 0.9rem;
        }
        
        /* Success Modal */
        .success-modal .modal-content,
        .status-modal .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }
        
        .success-modal .modal-header,
        .status-modal .modal-header {
            background: linear-gradient(135deg, var(--denr-green) 0%, var(--denr-dark-green) 100%);
            color: white;
            border: none;
            padding: 1.5rem 2rem;
        }
        
        .success-modal .modal-body,
        .status-modal .modal-body {
            padding: 2.5rem 2rem;
        }
        
        .success-modal .ticket-number {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border: 2px dashed var(--denr-green);
        }
        
        .success-modal .ticket-number h3 {
            color: var(--denr-dark-green);
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.2) 0%, rgba(13, 110, 253, 0.2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        
        .success-icon i {
            font-size: 2.5rem;
            color: var(--denr-green);
        }
        
        /* Status Modal Specific Styles */
        .status-tab {
            margin-bottom: 1.5rem;
        }
        
        .status-tab .nav-link {
            color: #666;
            border: 1px solid #dee2e6;
            margin-right: 10px;
        }
        
        .status-tab .nav-link.active {
            background-color: var(--denr-green);
            color: white;
            border-color: var(--denr-green);
        }
        
        .status-result {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            display: none;
        }
        
        .ticket-status {
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #e6b400;
        }
        
        .status-in-progress {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        .status-resolved {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--denr-green);
        }
        
        .status-closed {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .navbar-nav {
                text-align: center;
                margin-top: 1rem;
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
        /* Responsive button adjustments */
@media (max-width: 767.98px) {
    .btn-responsive {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .btn-group-responsive {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
}

/* Ensure buttons don't get too small */
.btn {
    min-width: 140px;
    white-space: nowrap;
}

@media (max-width: 575.98px) {
    .btn {
        min-width: 120px;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .btn i {
        font-size: 0.9rem;
    }
}

/* Prevent button text from wrapping */
.btn span {
    white-space: nowrap;
}
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Seal_of_the_Department_of_Environment_and_Natural_Resources.svg/1200px-Seal_of_the_Department_of_Environment_and_Natural_Resources.svg.png" alt="DENR Logo">
                <div>
                    <div>DENR Region XI</div>
                    <small class="text-muted" style="font-size: 0.85rem; font-weight: 400;">ICT Helpdesk System</small>
                </div>
            </a>
            
           
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="text-center">
                <h1 class="hero-title">ICT Helpdesk Ticketing System</h1>
                <p class="hero-subtitle">Submit, track, and manage your ICT concerns with the Department of Environment and Natural Resources - Region XI</p>
                <div class="mt-4">
                    <a href="#submitTicket" class="btn btn-light me-2" style="padding: 0.75rem 2rem; border-radius: 8px;">
                        <i class="fas fa-plus-circle me-1"></i> Submit New Ticket
                    </a>
                    <button class="btn btn-outline-light" style="padding: 0.75rem 2rem; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#statusModal">
                        <i class="fas fa-search me-1"></i> Check Ticket Status
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Statistics Cards -->
                    

                    <!-- Ticket Form -->
                    <div class="card mb-5" id="submitTicket">
                        <div class="card-header">
                            <h4 class="section-title mb-0">
                                <i class="fas fa-ticket-alt me-2 text-denr"></i>
                                New Helpdesk Ticket
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="ticketForm">
                                <!-- Ticket Details -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="ticketType" class="form-label required-field">Ticket Type</label>
                                        <select class="form-select" id="ticketType" required>
                                            <option value="" selected disabled>Select issue type</option>
                                            <option value="hardware">Hardware Issue</option>
                                            <option value="software">Software Issue</option>
                                            <option value="network">Network/Internet</option>
                                            <option value="email">Email Account</option>
                                            <option value="system">System Access</option>
                                            <option value="other">Other Concern</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="priority" class="form-label">Priority Level</label>
                                        <select class="form-select" id="priority">
                                            <option value="low">Low Priority</option>
                                            <option value="medium" selected>Medium Priority</option>
                                            <option value="high">High Priority</option>
                                            <option value="urgent">Urgent Priority</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Personal Information -->
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label required-field">Full Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label required-field">Position</label>
                                        <input type="text" class="form-control" id="position" placeholder="Enter your position" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="office" class="form-label required-field">Office/Division</label>
                                        <select class="form-select" id="office" required>
                                            <option value="" selected disabled>Select your office</option>
                                            <option value="rd">Office of the Regional Director</option>
                                            <option value="ard">Office of the Assistant Regional Director</option>
                                            <option value="finance">Finance and Administrative Division</option>
                                            <option value="technical">Technical Services Division</option>
                                            <option value="conservation">Conservation and Development Division</option>
                                            <option value="other">Other Office/Unit</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label required-field">Email Address</label>
                                        <input type="email" class="form-control" id="email" placeholder="name@denr.gov.ph" required>
                                    </div>
                                </div>
                                
                                <!-- Issue Description -->
                                <div class="mb-4">
                                    <label for="concern" class="form-label required-field">Issue Description</label>
                                    <textarea class="form-control" id="concern" rows="5" placeholder="Please describe your ICT concern in detail..." required maxlength="1000"></textarea>
                                    <div class="text-muted small mt-1" id="charCount">0/1000 characters</div>
                                </div>
                                
                                <!-- File Upload -->
                                <div class="mb-4">
                                    <label class="form-label">Attachments (Optional)</label>
                                    <div class="file-upload-area" id="fileUploadArea">
                                        <div class="mb-3">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                        </div>
                                        <h5>Drop files here or click to upload</h5>
                                        <p class="text-muted small">Maximum file size: 5MB. Supported formats: JPG, PNG, PDF, DOC</p>
                                        <input type="file" id="fileInput" style="display: none;" multiple>
                                    </div>
                                    <div id="fileList" class="mt-3"></div>
                                </div>
                                
                                <!-- Preview Section -->
                                <div class="ticket-preview" id="ticketPreview">
                                    <h5 class="mb-3">Ticket Preview</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="preview-item">
                                                <div class="preview-label">Ticket Type</div>
                                                <div class="preview-value" id="previewType"></div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-label">Priority</div>
                                                <div class="preview-value" id="previewPriority"></div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-label">Full Name</div>
                                                <div class="preview-value" id="previewName"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="preview-item">
                                                <div class="preview-label">Office/Division</div>
                                                <div class="preview-value" id="previewOffice"></div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-label">Email</div>
                                                <div class="preview-value" id="previewEmail"></div>
                                            </div>
                                            <div class="preview-item">
                                                <div class="preview-label">Attachments</div>
                                                <div class="preview-value" id="previewFiles">No files attached</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-item">
                                        <div class="preview-label">Issue Description</div>
                                        <div class="preview-value" id="previewConcern" style="white-space: pre-line;"></div>
                                    </div>
                                </div>
                                
                                <!-- Agreement -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="agreement" required>
                                    <label class="form-check-label" for="agreement">
                                        I confirm that the information provided is accurate and I understand that false reports may be subject to appropriate action.
                                    </label>
                                </div>
                                
                                <!-- Form Buttons -->
                               <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <button type="button" id="previewBtn" class="btn btn-outline-denr">
                                        <i class="fas fa-eye me-1"></i> Preview Ticket
                                    </button>
                                </div>
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="fas fa-eraser me-1"></i> Clear Form
                                    </button>
                                    <button type="submit" class="btn btn-denr">
                                        <i class="fas fa-paper-plane me-1"></i> Submit Ticket
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Seal_of_the_Department_of_Environment_and_Natural_Resources.svg/1200px-Seal_of_the_Department_of_Environment_and_Natural_Resources.svg.png" alt="DENR Logo" class="footer-logo">
                    <h4 class="text-white mb-3">DENR Region XI</h4>
                    <p class="contact-info">
                        <i class="fas fa-map-marker-alt"></i> DENR Regional Office XI,<br>
                        <span style="margin-left: 30px;">Davao City, Philippines</span>
                    </p>
                    <p class="contact-info"><i class="fas fa-phone"></i> (082) 224-1578</p>
                    <p class="contact-info"><i class="fas fa-envelope"></i> ict.helpdesk@denrxi.gov.ph</p>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" title="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="#" class="social-link" title="Website">
                            <i class="fas fa-globe"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Home</a>
                    <a href="#submitTicket" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Submit Ticket</a>
                    <a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#statusModal"><i class="fas fa-chevron-right me-2"></i> Check Ticket Status</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Knowledge Base</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i> Download Forms</a>
                    <a href="#" class="footer-link"><i class="fas fa-chevron-right me-2"></i> ICT Policies</a>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title">Service Hours</h5>
                    <p class="contact-info">
                        <i class="fas fa-clock"></i> Monday - Friday<br>
                        <span style="margin-left: 30px;">8:00 AM - 5:00 PM</span>
                    </p>
                    <p class="contact-info">
                        <i class="fas fa-calendar"></i> Weekends & Holidays<br>
                        <span style="margin-left: 30px;">Emergency Support Only</span>
                    </p>
                    <div class="mt-4">
                        <h6 class="text-white mb-3">Emergency Contact</h6>
                        <p class="contact-info">
                            <i class="fas fa-phone-volume text-danger"></i> 
                            <strong>Hotline: (082) 224-9999</strong><br>
                            <small style="margin-left: 30px;">For critical system outages only</small>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 Department of Environment and Natural Resources - Region XI. All rights reserved.</p>
                <p class="mb-0">
                    <a href="#">Privacy Policy</a> | 
                    <a href="#">Terms of Service</a> | 
                    <a href="#">Accessibility Statement</a> | 
                    <a href="#">Site Map</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Success Modal -->
    <div class="modal fade success-modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Ticket Submitted Successfully
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="mb-3 text-center">Thank You For Your Submission!</h4>
                    <p class="text-center">Your ICT concern has been logged into our system. Our technical team will review your ticket and contact you shortly.</p>
                    
                    <div class="ticket-number animate-pulse">
                        <p class="text-muted mb-2 text-center">Your Ticket Reference Number:</p>
                        <h3 class="text-center" id="ticketNumberDisplay">DENR-2023-XXXXX</h3>
                    </div>
                    
                    <div class="mt-4">
                        <div class="alert alert-light" style="background-color: rgba(0,0,0,0.03); border: none;">
                            <div class="d-flex align-items-center">
                                <div class="me-3 text-denr">
                                    <i class="fas fa-info-circle fa-lg"></i>
                                </div>
                                <div class="small">
                                    <strong>Important:</strong> You will receive a confirmation email within 15 minutes. Please keep your ticket number for reference.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-denr px-4" id="printTicketBtn">
                        <i class="fas fa-print me-2"></i> Print Ticket
                    </button>
                    <button type="button" class="btn btn-outline-denr px-4" data-bs-dismiss="modal">
                        <i class="fas fa-check me-2"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Check Status Modal -->
    <div class="modal fade status-modal" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">
                        <i class="fas fa-search me-2"></i>Check Ticket Status
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs for search methods -->
                    <ul class="nav nav-pills status-tab" id="searchTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="ticket-tab" data-bs-toggle="pill" data-bs-target="#ticketTab" type="button">
                                <i class="fas fa-ticket-alt me-1"></i> By Ticket Number
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="email-tab" data-bs-toggle="pill" data-bs-target="#emailTab" type="button">
                                <i class="fas fa-envelope me-1"></i> By Email Address
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="searchTabContent">
                        <!-- Ticket Number Search -->
                        <div class="tab-pane fade show active" id="ticketTab" role="tabpanel">
                            <div class="mb-3">
                                <label for="ticketNumberInput" class="form-label">Ticket Number</label>
                                <input type="text" class="form-control" id="ticketNumberInput" placeholder="Enter ticket number (e.g., DENR-2023-12345)">
                                <div class="form-text">Enter the ticket number you received after submission.</div>
                            </div>
                            <button class="btn btn-denr w-100" id="searchByTicketBtn">
                                <i class="fas fa-search me-2"></i> Search Ticket
                            </button>
                        </div>
                        
                        <!-- Email Address Search -->
                        <div class="tab-pane fade" id="emailTab" role="tabpanel">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Enter your email address">
                                <div class="form-text">Enter the email address used when submitting the ticket.</div>
                            </div>
                            <button class="btn btn-denr w-100" id="searchByEmailBtn">
                                <i class="fas fa-search me-2"></i> Search by Email
                            </button>
                        </div>
                    </div>
                    
                    <!-- Search Results -->
                    <div class="status-result" id="statusResult">
                        <h5 class="mb-3">Ticket Status</h5>
                        <div class="ticket-status" id="ticketStatusBadge">Pending</div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Ticket Number:</strong></p>
                                <p id="resultTicketNumber">DENR-2023-12345</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Submitted By:</strong></p>
                                <p id="resultSubmittedBy">Juan Dela Cruz</p>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Date Submitted:</strong></p>
                                <p id="resultDate">October 15, 2023</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Last Updated:</strong></p>
                                <p id="resultLastUpdate">October 16, 2023</p>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <p class="mb-1"><strong>Issue Description:</strong></p>
                            <p id="resultDescription" class="mb-0">Network connectivity issues in Room 305. Unable to access shared drives.</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="mb-1"><strong>Assigned Technician:</strong></p>
                            <p id="resultTechnician">John Smith (ICT Support)</p>
                        </div>
                        
                        <div class="mb-0">
                            <p class="mb-1"><strong>Latest Update:</strong></p>
                            <p id="resultUpdate" class="mb-0">Technician has been assigned and will visit your location tomorrow morning.</p>
                        </div>
                    </div>
                    
                    <!-- No Results Message -->
                    <div class="alert alert-warning mt-3 d-none" id="noResultsAlert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        No ticket found with the provided information. Please check your details and try again.
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize variables
        let files = [];
        
        // File upload functionality
        document.getElementById('fileUploadArea').addEventListener('click', function() {
            document.getElementById('fileInput').click();
        });
        
        // Drag and drop functionality
        const fileUploadArea = document.getElementById('fileUploadArea');
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--denr-green)';
        });
        
        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ccc';
        });
        
        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ccc';
            
            const droppedFiles = e.dataTransfer.files;
            document.getElementById('fileInput').files = droppedFiles;
            
            // Trigger change event
            const event = new Event('change');
            document.getElementById('fileInput').dispatchEvent(event);
        });
        
        // Handle file selection
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileList = document.getElementById('fileList');
            
            // Clear previous list
            fileList.innerHTML = '';
            files = [];
            
            // Display each selected file
            for (let i = 0; i < e.target.files.length; i++) {
                const file = e.target.files[i];
                
                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds the 5MB size limit and will not be uploaded.`);
                    continue;
                }
                
                // Check maximum number of files
                if (files.length >= 5) {
                    alert("Maximum of 5 files allowed. Only the first 5 files will be uploaded.");
                    break;
                }
                
                files.push(file);
                
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                
                // Determine file icon
                let fileIcon = 'fa-file';
                let fileColor = 'text-primary';
                if (file.type.startsWith('image/')) {
                    fileIcon = 'fa-file-image';
                    fileColor = 'text-success';
                } else if (file.type.includes('pdf')) {
                    fileIcon = 'fa-file-pdf';
                    fileColor = 'text-danger';
                } else if (file.type.includes('word') || file.type.includes('document')) {
                    fileIcon = 'fa-file-word';
                    fileColor = 'text-primary';
                }
                
                fileItem.innerHTML = `
                    <div>
                        <i class="fas ${fileIcon} ${fileColor} me-2"></i>
                        <span>${file.name}</span>
                        <small class="text-muted ms-2">(${(file.size / 1024).toFixed(1)} KB)</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-file" data-index="${files.length - 1}">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                fileList.appendChild(fileItem);
            }
            
            // Update file input
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            document.getElementById('fileInput').files = dataTransfer.files;
            
            // Add event listeners to remove buttons
            document.querySelectorAll('.remove-file').forEach(button => {
                button.addEventListener('click', function() {
                    const index = this.getAttribute('data-index');
                    removeFile(index);
                });
            });
            
            updatePreview();
        });
        
        function removeFile(index) {
            files.splice(index, 1);
            
            // Update file input
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            document.getElementById('fileInput').files = dataTransfer.files;
            
            // Update file list display
            const fileList = document.getElementById('fileList');
            if (files.length === 0) {
                fileList.innerHTML = '';
            } else {
                // Trigger change event to update display
                const event = new Event('change');
                document.getElementById('fileInput').dispatchEvent(event);
            }
            
            updatePreview();
        }
        
        // Character counter for concern textarea
        const concernTextarea = document.getElementById('concern');
        const charCount = document.getElementById('charCount');
        
        concernTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/1000 characters`;
            
            updatePreview();
        });
        
        // Preview button functionality
        document.getElementById('previewBtn').addEventListener('click', function() {
            // Validate required fields before showing preview
            const requiredFields = document.querySelectorAll('#ticketForm [required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                alert('Please fill in all required fields before previewing.');
                return;
            }
            
            // Show preview
            document.getElementById('ticketPreview').style.display = 'block';
            this.scrollIntoView({ behavior: 'smooth' });
        });
        
        // Update preview function
        function updatePreview() {
            // Get form values
            const ticketType = document.getElementById('ticketType');
            const priority = document.getElementById('priority');
            const name = document.getElementById('name').value;
            const position = document.getElementById('position').value;
            const office = document.getElementById('office');
            const email = document.getElementById('email').value;
            const concern = document.getElementById('concern').value;
            const fileCount = files.length;
            
            // Update preview elements
            document.getElementById('previewType').textContent = ticketType.options[ticketType.selectedIndex]?.text || 'Not specified';
            document.getElementById('previewPriority').textContent = priority.options[priority.selectedIndex]?.text || 'Not specified';
            document.getElementById('previewName').textContent = name || 'Not specified';
            document.getElementById('previewOffice').textContent = office.options[office.selectedIndex]?.text || 'Not specified';
            document.getElementById('previewEmail').textContent = email || 'Not specified';
            document.getElementById('previewConcern').textContent = concern || 'Not specified';
            document.getElementById('previewFiles').textContent = fileCount > 0 ? `${fileCount} file(s) attached` : 'No files attached';
        }
        
        // Form submission
        document.getElementById('ticketForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate required fields
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!document.getElementById('agreement').checked) {
                alert('Please confirm that the information provided is accurate.');
                document.getElementById('agreement').focus();
                return;
            }
            
            if (!isValid) {
                alert('Please fill in all required fields marked with *.');
                return;
            }
            
            // Generate ticket number
            const ticketNumber = 'DENR-' + new Date().getFullYear() + '-' + Math.floor(10000 + Math.random() * 90000);
            
            // Update modal with ticket number
            document.getElementById('ticketNumberDisplay').textContent = ticketNumber;
            
            // Show success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                backdrop: 'static',
                keyboard: false
            });
            successModal.show();
            
            // Reset form after successful submission
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function () {
                document.getElementById('ticketForm').reset();
                document.getElementById('fileList').innerHTML = '';
                document.getElementById('ticketPreview').style.display = 'none';
                document.getElementById('charCount').textContent = '0/1000 characters';
                files = [];
            });
        });
        
        // Form reset
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            // Clear file list
            document.getElementById('fileList').innerHTML = '';
            document.getElementById('ticketPreview').style.display = 'none';
            document.getElementById('charCount').textContent = '0/1000 characters';
            files = [];
        });
        
        // Initialize form listeners for preview
        const formInputs = document.querySelectorAll('#ticketForm input, #ticketForm select, #ticketForm textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });
        
        // Print Ticket button functionality
        document.getElementById('printTicketBtn').addEventListener('click', function() {
            const ticketNumber = document.getElementById('ticketNumberDisplay').textContent;
            const printContent = `
                <html>
                <head>
                    <title>DENR Ticket - ${ticketNumber}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
                        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #28a745; padding-bottom: 20px; }
                        .ticket-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
                        .ticket-number { font-size: 24px; font-weight: bold; color: #28a745; }
                        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 0.9rem; }
                        @media print {
                            body { padding: 0; }
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Seal_of_the_Department_of_Environment_and_Natural_Resources.svg/1200px-Seal_of_the_Department_of_Environment_and_Natural_Resources.svg.png" alt="DENR Logo" style="height: 60px; margin-bottom: 10px;">
                        <h2>Department of Environment and Natural Resources</h2>
                        <h3>Region XI - ICT Helpdesk</h3>
                        <h4>Ticket Confirmation</h4>
                    </div>
                    <div class="ticket-info">
                        <p><strong>Ticket Number:</strong> <span class="ticket-number">${ticketNumber}</span></p>
                        <p><strong>Date Submitted:</strong> ${new Date().toLocaleDateString()}</p>
                        <p><strong>Time Submitted:</strong> ${new Date().toLocaleTimeString()}</p>
                        <p><strong>Status:</strong> <span style="color: #e6b400; font-weight: bold;">PENDING REVIEW</span></p>
                    </div>
                    <p>Please keep this reference number for follow-up inquiries. You can check your ticket status anytime using our online system.</p>
                    <div class="footer">
                        <p>Department of Environment and Natural Resources - Region XI</p>
                        <p>ICT Service Management System | © 2023 DENR Region XI</p>
                    </div>
                    <div class="no-print" style="text-align: center; margin-top: 20px;">
                        <button onclick="window.print()" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Print This Page
                        </button>
                    </div>
                </body>
                </html>
            `;
            
            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.focus();
        });
        
        // Check Status Modal Functionality
        document.getElementById('searchByTicketBtn').addEventListener('click', function() {
            const ticketNumber = document.getElementById('ticketNumberInput').value.trim();
            
            if (!ticketNumber) {
                alert('Please enter a ticket number.');
                return;
            }
            
            // Simulate search (in a real system, this would be an API call)
            simulateTicketSearch(ticketNumber, 'ticket');
        });
        
        document.getElementById('searchByEmailBtn').addEventListener('click', function() {
            const email = document.getElementById('emailInput').value.trim();
            
            if (!email) {
                alert('Please enter an email address.');
                return;
            }
            
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // Simulate search (in a real system, this would be an API call)
            simulateTicketSearch(email, 'email');
        });
        
        function simulateTicketSearch(searchValue, searchType) {
            // Hide previous results and alerts
            document.getElementById('statusResult').style.display = 'none';
            document.getElementById('noResultsAlert').classList.add('d-none');
            
            // Simulate API delay
            setTimeout(() => {
                // Mock data - in a real system, this would come from a database
                const mockTickets = [
                    {
                        ticketNumber: 'DENR-2023-12345',
                        email: 'juan.delacruz@denr.gov.ph',
                        name: 'Juan Dela Cruz',
                        date: 'October 15, 2023',
                        lastUpdate: 'October 16, 2023',
                        description: 'Network connectivity issues in Room 305. Unable to access shared drives.',
                        status: 'in-progress',
                        technician: 'John Smith (ICT Support)',
                        update: 'Technician has been assigned and will visit your location tomorrow morning.'
                    },
                    {
                        ticketNumber: 'DENR-2023-67890',
                        email: 'maria.santos@denr.gov.ph',
                        name: 'Maria Santos',
                        date: 'October 14, 2023',
                        lastUpdate: 'October 15, 2023',
                        description: 'Printer not working in Finance Division.',
                        status: 'resolved',
                        technician: 'Sarah Johnson (Hardware Support)',
                        update: 'Printer issue has been resolved. Replaced toner cartridge.'
                    },
                    {
                        ticketNumber: 'DENR-2023-54321',
                        email: 'robert.lim@denr.gov.ph',
                        name: 'Robert Lim',
                        date: 'October 16, 2023',
                        lastUpdate: 'October 16, 2023',
                        description: 'Email account login issues.',
                        status: 'pending',
                        technician: 'Not assigned yet',
                        update: 'Ticket is in queue for review by ICT team.'
                    }
                ];
                
                let foundTicket = null;
                
                if (searchType === 'ticket') {
                    foundTicket = mockTickets.find(ticket => 
                        ticket.ticketNumber.toLowerCase() === searchValue.toLowerCase()
                    );
                } else if (searchType === 'email') {
                    foundTicket = mockTickets.find(ticket => 
                        ticket.email.toLowerCase() === searchValue.toLowerCase()
                    );
                }
                
                if (foundTicket) {
                    // Update result display
                    document.getElementById('resultTicketNumber').textContent = foundTicket.ticketNumber;
                    document.getElementById('resultSubmittedBy').textContent = foundTicket.name;
                    document.getElementById('resultDate').textContent = foundTicket.date;
                    document.getElementById('resultLastUpdate').textContent = foundTicket.lastUpdate;
                    document.getElementById('resultDescription').textContent = foundTicket.description;
                    document.getElementById('resultTechnician').textContent = foundTicket.technician;
                    document.getElementById('resultUpdate').textContent = foundTicket.update;
                    
                    // Update status badge
                    const statusBadge = document.getElementById('ticketStatusBadge');
                    statusBadge.textContent = foundTicket.status.replace('-', ' ').toUpperCase();
                    statusBadge.className = 'ticket-status';
                    
                    switch(foundTicket.status) {
                        case 'pending':
                            statusBadge.classList.add('status-pending');
                            break;
                        case 'in-progress':
                            statusBadge.classList.add('status-in-progress');
                            break;
                        case 'resolved':
                            statusBadge.classList.add('status-resolved');
                            break;
                        case 'closed':
                            statusBadge.classList.add('status-closed');
                            break;
                    }
                    
                    // Show results
                    document.getElementById('statusResult').style.display = 'block';
                } else {
                    // Show no results message
                    document.getElementById('noResultsAlert').classList.remove('d-none');
                }
            }, 500); // Simulate network delay
        }
        
        // Clear search results when modal is closed
        document.getElementById('statusModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('ticketNumberInput').value = '';
            document.getElementById('emailInput').value = '';
            document.getElementById('statusResult').style.display = 'none';
            document.getElementById('noResultsAlert').classList.add('d-none');
        });
    </script>
</body>
</html>