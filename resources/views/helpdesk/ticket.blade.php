<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENR XI - ICT Service Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --denr-green: #006341;
            --denr-green-dark: #004d31;
            --denr-blue: #007cc3;
            --denr-blue-light: #e6f3fa;
            --denr-gray: #f8f9fa;
            --denr-text: #333333;
            --denr-text-light: #666666;
            --denr-success: #2e7d32;
            --denr-warning: #ff9800;
            --denr-danger: #d32f2f;
        }

        * {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--denr-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Custom Header */
        .denr-header {
            background: linear-gradient(135deg, var(--denr-green), var(--denr-green-dark));
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .denr-header::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.3;
        }

        .denr-logo {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-right: 15px;
        }

        .denr-logo-icon {
            color: var(--denr-green);
            font-size: 30px;
        }

        .header-title h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.2rem;
        }

        .header-title p {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Custom Card */
        .denr-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .denr-card:hover {
            transform: translateY(-5px);
        }

        .card-header-custom {
            background: linear-gradient(to right, var(--denr-green), var(--denr-blue));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        .card-header-custom h3 {
            font-weight: 600;
            margin: 0;
        }

        /* Form Styling */
        .form-label-custom {
            font-weight: 600;
            color: var(--denr-text);
            margin-bottom: 0.5rem;
        }

        .required-star {
            color: var(--denr-danger);
        }

        .form-control-custom {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .form-control-custom:focus {
            border-color: var(--denr-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 124, 195, 0.25);
        }

        /* Priority Selector */
        .priority-selector {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .priority-option {
            flex: 1;
            min-width: 120px;
        }

        .priority-option input[type="radio"] {
            display: none;
        }

        .priority-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px 10px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .priority-label i {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .priority-label span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .priority-option input[type="radio"]:checked + .priority-label {
            border-color: var(--denr-blue);
            background-color: var(--denr-blue-light);
            color: var(--denr-blue);
        }

        .priority-low .priority-label i { color: #2e7d32; }
        .priority-medium .priority-label i { color: #ff9800; }
        .priority-high .priority-label i { color: #d32f2f; }
        .priority-critical .priority-label i { color: #7b1fa2; }

        /* File Upload Area */
        .file-upload-area {
            border: 2px dashed #c0c0c0;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            background-color: #fafafa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .file-upload-area:hover {
            border-color: var(--denr-blue);
            background-color: rgba(0, 124, 195, 0.05);
        }

        .file-upload-area.dragover {
            border-color: var(--denr-green);
            background-color: rgba(0, 99, 65, 0.05);
        }

        .upload-icon {
            font-size: 48px;
            color: var(--denr-blue);
            margin-bottom: 15px;
        }

        .file-preview-container {
            margin-top: 20px;
        }

        .file-preview {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--denr-gray);
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-icon {
            color: var(--denr-blue);
            font-size: 20px;
        }

        .remove-file {
            color: var(--denr-danger);
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Button Styling */
        .btn-denr {
            background: linear-gradient(to right, var(--denr-green), var(--denr-green-dark));
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-denr:hover {
            background: linear-gradient(to right, var(--denr-green-dark), var(--denr-green));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 99, 65, 0.2);
        }

        .btn-denr-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-denr-secondary:hover {
            background: #5a6268;
            color: white;
        }

        /* Toast Notification */
        .toast-denr {
            border-left: 5px solid var(--denr-green);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .toast-denr-success {
            border-left-color: var(--denr-success);
        }

        .toast-denr-error {
            border-left-color: var(--denr-danger);
        }

        .toast-denr-warning {
            border-left-color: var(--denr-warning);
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            background: #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: #666;
            font-weight: 600;
            transition: all 0.3s;
        }

        .step.active .step-icon {
            background: var(--denr-green);
            color: white;
        }

        .step.completed .step-icon {
            background: var(--denr-success);
            color: white;
        }

        .step-label {
            font-size: 0.85rem;
            color: #666;
        }

        .step.active .step-label {
            color: var(--denr-green);
            font-weight: 600;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-open { background: #e3f2fd; color: #1976d2; }
        .status-pending { background: #fff3e0; color: #f57c00; }
        .status-in-progress { background: #e8f5e8; color: #388e3c; }
        .status-resolved { background: #e8eaf6; color: #5c6bc0; }
        .status-closed { background: #f5f5f5; color: #616161; }

        /* Footer */
        .denr-footer {
            background: var(--denr-green);
            color: white;
            padding: 1.5rem 0;
            margin-top: auto;
        }

        .denr-footer p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .priority-selector {
                flex-direction: column;
            }
            
            .priority-option {
                min-width: 100%;
            }
            
            .denr-logo {
                width: 60px;
                height: 60px;
                margin-right: 10px;
            }
            
            .header-title h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div id = "app">
    <Ticket></Ticket>
   
 </div>
    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
   
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
     <script src="{{ asset('public/js/app.js') }}?v={{ config('app.version') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form elements
            const form = document.getElementById('ticketForm');
            const fileInput = document.getElementById('fileInput');
            const browseBtn = document.getElementById('browseBtn');
            const dropZone = document.getElementById('dropZone');
            const filePreviewContainer = document.getElementById('filePreviewContainer');
            const clearBtn = document.getElementById('clearBtn');
            const submitBtn = document.getElementById('submitBtn');
            
            // Toast function
            function showToast(message, type = 'success') {
                const toastContainer = document.querySelector('.toast-container');
                const toastId = 'toast-' + Date.now();
                
                const toastHtml = `
                    <div id="${toastId}" class="toast toast-denr toast-denr-${type}" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="fas ${type === 'success' ? 'fa-check-circle text-success' : type === 'error' ? 'fa-exclamation-circle text-danger' : 'fa-info-circle text-warning'} me-2"></i>
                            <strong class="me-auto">${type === 'success' ? 'Success' : type === 'error' ? 'Error' : 'Notice'}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;
                
                toastContainer.insertAdjacentHTML('beforeend', toastHtml);
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
                toast.show();
                
                // Remove toast from DOM after it's hidden
                toastElement.addEventListener('hidden.bs.toast', function () {
                    toastElement.remove();
                });
            }
            
            // File handling
            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Convert to MB
                    
                    if (fileSize > 10) {
                        showToast(`File "${file.name}" exceeds 10MB limit`, 'error');
                        continue;
                    }
                    
                    const validTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                    if (!validTypes.includes(file.type)) {
                        showToast(`File type not supported for "${file.name}"`, 'error');
                        continue;
                    }
                    
                    addFilePreview(file);
                }
            }
            
            function addFilePreview(file) {
                const fileId = 'file-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                
                const fileIcon = file.type.startsWith('image/') ? 'fa-file-image' : 
                                file.type === 'application/pdf' ? 'fa-file-pdf' : 
                                'fa-file-word';
                
                const previewHtml = `
                    <div class="file-preview" id="${fileId}">
                        <div class="file-info">
                            <i class="fas ${fileIcon} file-icon"></i>
                            <div>
                                <div class="fw-bold">${file.name}</div>
                                <small class="text-muted">${fileSize} MB</small>
                            </div>
                        </div>
                        <div class="remove-file" onclick="removeFile('${fileId}')">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                `;
                
                filePreviewContainer.insertAdjacentHTML('beforeend', previewHtml);
            }
            
            // Make removeFile function globally accessible
            window.removeFile = function(fileId) {
                const fileElement = document.getElementById(fileId);
                if (fileElement) {
                    fileElement.remove();
                }
            };
            
            // Event listeners for file upload
            browseBtn.addEventListener('click', () => {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFiles(e.target.files);
                }
            });
            
            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('dragover');
                }, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('dragover');
                }, false);
            });
            
            dropZone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            });
            
            // Form submission
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                if (!form.checkValidity()) {
                    // Show validation errors
                    form.classList.add('was-validated');
                    showToast('Please fill in all required fields correctly.', 'error');
                    return;
                }
                
                // Check if at least one priority is selected
                const prioritySelected = document.querySelector('input[name="priority"]:checked');
                if (!prioritySelected) {
                    showToast('Please select a priority level.', 'error');
                    return;
                }
                
                // Disable submit button and show loading state
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                
                // Simulate API call
                try {
                    // Collect form data
                    const formData = {
                        ticketType: document.getElementById('ticketType').value,
                        priority: prioritySelected.value,
                        fullName: document.getElementById('fullName').value,
                        position: document.getElementById('position').value,
                        office: document.getElementById('office').value,
                        email: document.getElementById('email').value,
                        concernDescription: document.getElementById('concernDescription').value,
                        files: fileInput.files.length
                    };
                    
                    // Generate a ticket number
                    const ticketNumber = 'DENR-' + Date.now().toString().substr(-6);
                    
                    // Simulate network delay
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    
                    // Show success message
                    showToast(`Ticket #${ticketNumber} submitted successfully! You'll receive a confirmation email shortly.`, 'success');
                    
                    // Reset form
                    resetForm();
                    
                    // Show ticket details in console (for demo)
                    console.log('Ticket submitted:', formData);
                    
                } catch (error) {
                    showToast('An error occurred while submitting your ticket. Please try again.', 'error');
                    console.error('Submission error:', error);
                } finally {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
            
            // Clear form function
            function resetForm() {
                form.reset();
                form.classList.remove('was-validated');
                filePreviewContainer.innerHTML = '';
                fileInput.value = '';
                
                // Reset priority to default (High)
                document.getElementById('priorityHigh').checked = true;
                
                // Remove any Bootstrap validation classes
                const formControls = form.querySelectorAll('.form-control, .form-select');
                formControls.forEach(control => {
                    control.classList.remove('is-valid', 'is-invalid');
                });
            }
            
            // Clear button event listener
            clearBtn.addEventListener('click', resetForm);
            
            // Real-time validation
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', () => {
                    if (input.checkValidity()) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                });
            });
            
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Show initial help message
            setTimeout(() => {
                showToast('Welcome to DENR XI ICT Ticketing System. Fill out the form to submit a service request.', 'info');
            }, 1000);
        });
    </script>
</body>
</html>