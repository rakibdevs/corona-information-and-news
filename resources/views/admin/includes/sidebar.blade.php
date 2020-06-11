<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="40" src="{{ asset('images/logo.png') }}" class="header-brand-img" alt="Woh"> 
            </div>
            <span class="text"></span>
        </a>
    </div>

    @php
        $segment1 = request()->segment(2);
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'collection') ? 'active' : '' }}">
                    <a href="{{url('admin/collection')}}"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i> <span>Collection</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'expense') ? 'active' : '' }}">
                    <a href="{{url('admin/expense')}}"><i class="fa fa-money" aria-hidden="true"></i> <span>Expense</span></a>
                </div>
                <div class="nav-item {{ ($segment1 == 'gallery') ? 'active' : '' }}">
                    <a href="{{url('admin/gallery')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Gallery</span></a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'settings') ? 'active' : '' }}">
                    <a href="{{}}"><i class="fa fa-cog"></i> <span>Settings</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>