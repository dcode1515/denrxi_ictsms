<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="index.html" class="b-brand">
                    <img src="{{ URL::asset('public/images/logo/denr.png') }}" style="width:70px" alt="" class="logo logo-lg" />DENR ICTSMS v.0.0.v1
                    <img src="{{ URL::asset('public/images/logo/denr.png') }}"  alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Dashboards</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="index.html">HelpDesk</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="analytics.html">Inventory</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-cast"></i></span>
                            <span class="nxl-mtext">HelpDesk</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="reports-sales.html">Ticket Request</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="reports-leads.html">Ticket Type</a></li>
                            
                        </ul>
                    </li>
                     <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-cast"></i></span>
                            <span class="nxl-mtext">Office</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('head.office')}}">Head Office</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="reports-leads.html">Office</a></li>
                            
                        </ul>
                    </li>
                    <li class="nxl-item">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                            <span class="nxl-mtext">Reports</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">User Management</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-database"></i></span>
                            <span class="nxl-mtext">Back up Database</span>
                        </a>
                    </li>
                    <li class="nxl-item">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file-text"></i></span>
                            <span class="nxl-mtext">Data Logs</span>
                        </a>
                    </li>
                    
                </ul>
              
            </div>
        </div>
    </nav>