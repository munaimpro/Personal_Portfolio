{{-- Navbar section --}}
<header class="header_wrapper vertical_MK25_w_space">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/website/images/logo.png') }}" alt="logo" class="img-fluid" id="websiteLogo">
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-stream"></i></span>
          </button>

          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav menu-navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('about') }}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('services') }}">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('portfolio') }}">Portfolio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('pricing') }}">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('blog') }}">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('contact') }}">Contact</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
</header>


{{-- Front end script start --}}

<script>

    // Function for retrive website logo

    retrieveLogoInfo();

    async function retrieveLogoInfo(){

        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveLogoInfo');
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the open graph website image
                let logoImageFullPath = baseUrl + '/storage/website_logo/' + response.data.data['logo'];

                $('#websiteLogo')[0].src = logoImageFullPath;
            } else{
                console.log('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

</script>

{{-- Front end script end --}}