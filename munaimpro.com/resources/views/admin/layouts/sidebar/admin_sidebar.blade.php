{{-- Sidebar start --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/dashboard') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img"><span> Dashboard</span> </a>
                </li>
                
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/product.svg') }}" alt="img"><span> Website Details</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/seoproperty') }}">Logo & SEO Information</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/visitorinfo') }}">Visitor Information</a></li>
                    </ul>
                </li>
                
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/sales1.svg') }}" alt="img"><span> About</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/basicinfo') }}">Basic Information</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/education') }}">Education</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/skill') }}">Skills</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/award') }}">Awards</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/experience') }}">Experience</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/interest') }}.html">Interest</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/social_media') }}">Social Media</a></li>
                    </ul>
                </li>
                
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/services') }}"><i data-feather="file"></i><span> Service</span> </a>
                </li>
                
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/portfolio') }}"><i data-feather="file"></i><span> Portfolio</span> </a>
                </li>
                
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/pricing') }}"><i data-feather="file"></i><span> Pricing</span> </a>
                </li>
                
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/message') }}"><i data-feather="file"></i><span> Message</span> </a>
                </li>
                
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/expense1.svg') }}" alt="img"><span> Post</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/post') }}">All Post</a></li>
                        <li><a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/category') }}">Category List</a></li>
                    </ul>
                </li>
                
                <li>
                    <a @if($seoproperty->page_name === $routeName) class="active" @endif href="{{ url('Admin/user') }}"><img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img"><span> Users</span> </a>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/settings.svg') }}" alt="img"><span> Settings</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="generalsettings.html">General Settings</a></li>
                        <li><a href="emailsettings.html">Email Settings</a></li>
                        <li><a href="paymentsettings.html">Payment Settings</a></li>
                        <li><a href="currencysettings.html">Currency Settings</a></li>
                        <li><a href="grouppermissions.html">Group Permissions</a></li>
                        <li><a href="taxrates.html">Tax Rates</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
{{-- Sidebar end --}}