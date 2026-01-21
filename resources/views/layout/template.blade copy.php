<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:44:28 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Dashboard | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/libs/swiper/swiper-bundle.min.css') }}">
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/layout.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/app.min.css') }}">   
    <link rel="stylesheet" href="{{ URL::asset('public/Dashboard-Template-Velzon-main/assets/css/custom.min.css') }}">
    <style>
        /* Enhanced Logo Styling - Conflict Free */
.navbar-brand-box {
    padding: 1rem;
    background: #1a5f23;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.logo-lg {
    display: block;
}

.logo-sm {
    display: none;
}

/* When sidebar is collapsed */
[data-sidebar-size="sm"] .logo-lg {
    display: none;
}

[data-sidebar-size="sm"] .logo-sm {
    display: block;
    text-align: center;
}

[data-sidebar-size="sm"] .navbar-brand-box {
    padding: 0.75rem 0.5rem;
    text-align: center;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .navbar-brand-box {
        padding: 0.75rem;
    }
}
        </style>


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

                @include('layout.navbar')


        <div class="app-menu navbar-menu">
            <!-- LOGO -->
          <div class="navbar-brand-box">
    <div class="d-flex align-items-center justify-content-between w-100">
        <!-- Logo with Text -->
        <a href="index.html" class="logo logo-light text-decoration-none flex-grow-1">
            <div class="d-flex align-items-center">
                <!-- Logo Image -->
                <div class="logo-icon">
                    <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="DENR" 
                         class="img-fluid" 
                         style="height: 48px; width: auto;">
                </div>
                
                <!-- Text Container -->
                <div class="logo-text ms-2 d-none d-lg-block">
                    <div class="text-white fw-bold mb-0" style="font-size: 15px; line-height: 1.2;">DENR REGION XI</div>
                        <span class="fw-semibold">ICT SERVICE MANAGEMENT SYSTEM</span>
                    </div>
                    <div class="text-white-50" style="font-size: 10px; line-height: 1.2;">Version 0.0.1</div>
                </div>
            </div>
        </a>
        
        <!-- Your existing toggle button - DO NOT CHANGE -->
        <button type="button" class="btn btn-sm p-0 fs-20 header-item btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
</div>
                    @include('layout.sidebar')
           
            <div class="sidebar-background"></div>
        </div>
     
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')

                </div>
              
            </div>          

                @include('layout.footer')
        </div>
      

    </div>
   
   
    <!-- JAVASCRIPT -->
   <script src="{{ asset('public/js/app.js') }}?v={{ config('app.version') }}"></script>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('public/Dashboard-Template-Velzon-main/assets/js/app.js') }}"></script>

    
</body>



</html>