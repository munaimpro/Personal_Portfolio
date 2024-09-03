@extends('website.layouts.app')
@section('component')
    @include('website.components.index.banner')
    @include('website.components.index.about')
    @include('website.components.index.skills')
    @include('website.components.index.service')
    @include('website.components.index.portfolio')
    @include('website.components.index.testimonial')
    @include('website.components.index.blog')
    @include('website.components.index.contact')
@endsection


{{-- Front end script start --}}

@push('banner_about_section_script')
    <script>
        // Function for retriving about information
        getAboutInfo();

        async function getAboutInfo() {
            showLoader();
            let response = await axios.get('/retriveAboutInfo');
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the hero image
                let heroImageFullPath = baseUrl + '/storage/website_pictures/hero/' + response.data.data['hero_image'];

                // Generating full path for the about image
                let aboutImageFullPath = baseUrl + '/storage/website_pictures/about/' + response.data.data['about_image'];

                // Generating full path for the resume link
                let resumeFullPath = baseUrl + '/storage/resume/' + response.data.data['resume_link'];

                $('#websiteHeroGreetings').html(response.data.data['greetings']);
                $('#websiteHeroFullName').html(response.data.data['full_name']);
                $('#websiteAboutFullName').html("I am "+response.data.data['full_name']);
                $('#websiteHeroDesignation').html(response.data.data['designation']);
                $('#websiteAboutDesignation').html(response.data.data['designation']);
                $('#websiteHeroDescription').html(response.data.data['hero_description']);
                $('#websiteHeroImage').attr('src', heroImageFullPath);
                $('#websiteAboutDescription').html(response.data.data['about_description']);
                $('#websiteAboutImage').attr('src', aboutImageFullPath);
                $('#resumeDownloadButton').attr('href', resumeFullPath);
                $('#websiteSkillDescription').html(response.data.data['skill_description']);
            } else{
                displayToast('error', response.data['message']);
            }
        }

    </script>
@endpush

{{-- Front end script end --}}