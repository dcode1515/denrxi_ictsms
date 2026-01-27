<nav class="navbar navbar-expand-lg navbar-enhanced">
    <div class="container">
        <!-- Enhanced Brand Logo with better positioning -->
        <a class="navbar-brand enhanced-brand" href="#">
            <div class="brand-container">
                <div class="logo-wrapper">
                    <img src="{{ URL::asset('public/images/logo/denr.png') }}" alt="DENR Logo" class="nav-logo">
                    <div class="logo-badge">XI</div>
                </div>
                <div class="brand-text">
                    <div class="main-title">DENR Region XI</div>
                    <div class="subtitle">ICT Helpdesk System</div>
                </div>
            </div>
        </a>
        
        <!-- Enhanced Toggle Button -->
        <button class="navbar-toggler enhanced-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto nav-enhanced">
                <li class="nav-item">
                    <a class="nav-link nav-link-enhanced active" href="#">
                        <div class="nav-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="nav-text">Home</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-enhanced" href="#submitTicket">
                        <div class="nav-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <span class="nav-text">Submit Ticket</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-enhanced" href="#knowledgeBase">
                        <div class="nav-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <span class="nav-text">Knowledge Base</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-enhanced" href="#faq">
                        <div class="nav-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <span class="nav-text">FAQ</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-enhanced nav-status" href="#" data-bs-toggle="modal" data-bs-target="#checkStatusModal">
                        <div class="nav-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <span class="nav-text">Check Status</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Active indicator line -->
    <div class="nav-active-line"></div>
</nav>