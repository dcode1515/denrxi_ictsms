<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('public/images/logo/denr1.png') }}" alt="" height="90">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
    
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarDashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics"> Helpdesk </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="dashboard-crm.html" class="nav-link" data-key="t-crm"> Inventory </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-headphone-line"></i> <span data-key="t-apps">Helpdesk</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                   
                                    <li class="nav-item">
                                        <a href="apps-chat.html" class="nav-link" data-key="t-chat"> Ticket Request </a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="{{route('ticket.type')}}" class="nav-link" data-key="t-chat"> Ticket Type </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarOffice" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOffice">
                                <i class="ri-building-line"></i> <span data-key="t-apps">Office</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarOffice">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('head.office')}}" class="nav-link" data-key="t-chat"> Head Office </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('office')}}" class="nav-link" data-key="t-chat"> Office </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="ri-user-line"></i> <span data-key="t-widgets">User Management</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="ri-file-text-line"></i> <span data-key="t-widgets">Reports</span>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="ri-archive-line"></i> <span data-key="t-widgets">Data Logs</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>