{{-- Navbar section --}}
<header class="header_wrapper vertical_MK25_w_space">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/website/images/logo.png') }}" alt="logo" class="img-fluid" id="websiteLogo">
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-stream"></i></span>
          </button>

          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav menu-navbar-nav align-items-center">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ url('/') }}" @if($routeName === '')id="active"@endif>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('about') }}" @if($routeName === 'about')id="active"@endif>About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('services') }}" @if($routeName === 'services')id="active"@endif>Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('portfolio') }}" @if($routeName === 'portfolio')id="active"@endif>Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('pricing') }}" @if($routeName === 'pricing')id="active"@endif>Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('blog') }}" @if($routeName === 'blog')id="active"@endif>Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('contact') }}" @if($routeName === 'contact')id="active"@endif>Contact</a>
              </li>
              <li class="nav-item">
                <a class="btn primary-btn m-0 px-4 py-2" href="{{ url('Admin/signin') }}" id="userAuthenticationButton" target="_blank">
                  Sign In <i class="fas fa-sign-in-alt"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
</header>


{{-- Front end script start --}}

<script>

    // Function for retrieve website logo

    retrieveLogoInfo();

    async function retrieveLogoInfo(){

        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveLogoInfo');
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the open graph website image
                let logoImageFullPath = `{{ url('/') }}/storage/website_logo/` + response.data.data['logo'];

                $('#websiteLogo')[0].src = logoImageFullPath;
                $('#websiteTabImage').attr('href', logoImageFullPath);
            } else{
                console.log('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

</script>

{{-- Front end script end --}}