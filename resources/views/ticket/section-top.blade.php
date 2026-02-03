<style>
    /* Hero section with particles - DENR COLORS */
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #1e8449 0%, #145a32 100%);
        color: white;
        padding: 100px 0;
        min-height: auto;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    /* DENR GREEN COLORS */
    .hero-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-subtitle {
        font-size: 1.1rem;
        line-height: 1.5;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    /* DENR GREEN BUTTONS */
    .hero-buttons .btn {
        padding: 0.75rem 2rem !important;
        border-radius: 10px !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .hero-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-light {
        background: white;
        color: #1e8449 !important;
        border: none;
    }

    .btn-light:hover {
        background: #f8f9fa;
        color: #145a32 !important;
    }

    .btn-outline-light {
        border: 2px solid white;
        background: transparent;
        color: white;
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section {
            padding: 80px 0;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }
        
        .hero-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .hero-buttons .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Add particles.js script -->
<script>
    // Load particles.js from CDN
    function loadParticlesJS() {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js';
        script.onload = initializeParticles;
        document.head.appendChild(script);
    }

    function initializeParticles() {
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 60,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: "#ffffff"
                },
                shape: {
                    type: "circle"
                },
                opacity: {
                    value: 0.3,
                    random: true
                },
                size: {
                    value: 2,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                }
            },
            retina_detect: true
        });
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        loadParticlesJS();
    });
</script>

<!-- Hero Section with DENR colors -->
<div class="hero-section">
    <!-- Particles Container -->
    <div id="particles-js"></div>
    
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="hero-title">
                ICT Helpdesk Ticketing System
            </h1>
            
            <p class="hero-subtitle">
                Submit, track, and manage your ICT concerns with the Department of Environment and Natural Resources - Region XI. 
                Our dedicated support team is here to assist you with technical issues promptly and efficiently.
            </p>
            
            <div class="hero-buttons">
                <a href="#submitTicket" class="btn btn-light me-2 mb-2">
                    <i class="fas fa-plus-circle me-1"></i> Submit New Ticket
                </a>
                <a href="{{route('ticket.status')}}" class="btn btn-outline-light mb-2">
                    <i class="fas fa-search me-1"></i> Check Ticket Status
                </a>
            </div>
        </div>
    </div>
</div>