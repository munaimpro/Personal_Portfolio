{{-- Header start --}}
<div class="header">
    <div class="header-left active">
        <a href="index.html" class="logo">
            <img src="" alt="Logo" id="adminSidebarLogo">
        </a>
        <a href="index.html" class="logo-small">
            <img src="{{ asset('assets/img/logo-small.png') }}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('assets/img/icons/search.svg') }}" alt="img"></a>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img">
                    @if($authUser['profile_picture'] == NULL)
                        <img src="{{ asset('assets/img/profiles/avater.png') }}" alt="profile picture">
                    @else
                        <img src="{{ asset('storage/profile_picture/user_images/'.$authUser['profile_picture']) }}" alt="profile picture">
                    @endif
                    <span class="status online"></span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                    <span class="user-img">
                        @if($authUser['profile_picture'] == NULL)
                            <img src="{{ asset('assets/img/profiles/avater.png') }}" alt="profile picture">
                        @else
                            <img src="{{ asset('storage/profile_picture/user_images/'.$authUser['profile_picture']) }}" alt="profile picture">
                        @endif
                        <span class="status online"></span>
                    </span>
                    <div class="profilesets">
                    <h6>{{ $authUser['first_name'].' '. $authUser['last_name']}}</h6>
                    <h5>{{ ucwords($authUser['role']) }}</h5>
                    </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{ url('/') }}" target="_blank"> <i class="me-2" data-feather="globe"></i> Website</a>
                    <a class="dropdown-item" href="{{ url('Admin/profile') }}"> <i class="me-2" data-feather="user"></i> My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                    <hr class="m-0">
                    <a class="dropdown-item logout pb-0" href="{{ url('userSignout') }}"><img src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2" alt="img">Logout</a>
                </div>
            </div>
        </li>
    </ul>

    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('Admin/profile') }}">My Profile</a>
            <a class="dropdown-item" href="generalsettings.html">Settings</a>
            <a class="dropdown-item" href="{{ url('userSignout') }}">Logout</a>
        </div>
    </div>
</div>
{{-- Header end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve website logo

    retrieveLogoInfo();

    async function retrieveLogoInfo(){

        try{
            // Pssing id to controller and getting response
            let response = await axios.post('/retrieveLogoInfo');

            if(response.data['status'] === 'success'){
                // Generating full path for the open graph website image
                let logoImageFullPath = `{{ url('/') }}/storage/website_logo/` + response.data.data['logo'];

                $('#adminBrowserTabImage').attr('href', logoImageFullPath);
                $('#adminSidebarLogo')[0].src = logoImageFullPath;
                $('#websiteLogoPreview')[0].src = logoImageFullPath;
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>