{{-- Education & skills section start --}}
<section id="skills" class="page_sectionMK25_wrapper skills_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-5 mb-lg-0 skill_MK25_items">
                <div class="section_MK25_subtitle mb-5" id="websiteAcademicEducation">
                    <h4>EDUCATION</h4>
                    <h3 class="mb-5 d-none">ACADEMIC EDUCATION</h3>
                    <ul class="education_MK25_list">
                        {{-- Education items  --}}
                    </ul>
                </div>
                
                <div class="section_MK25_subtitle mb-5 d-none" id="websiteTechnicalEducation">
                    <h3 class="mb-5">TECHNICAL EDUCATION</h3>
                    <ul class="education_MK25_list">
                        {{-- Education items  --}}
                    </ul>
                </div>
                
                
            </div>
        
            <div class="col-lg-6 col-sm-12 mb-5 mb-lg-0 skill_MK25_items">
                <div class="section_MK25_subtitle mb-5" id="websiteProgrammingSkills">
                    <h4>SKILLS</h4>
                    <h3 class="mb-5 d-none">PROGRAMMING SKILLS</h3>
                    {{-- Skill items  --}}
                </div>
                
                <div class="section_MK25_subtitle mb-5 d-none" id="websiteTechnicalSkills">
                    <h3 class="mb-5">TECHNICAL SKILLS</h3>
                    {{-- Skill items  --}}
                </div>
                
                <div class="section_MK25_subtitle d-none" id="websiteOtherSkills">
                    <h3 class="mb-5">OTHER SKILLS</h3>
                    {{-- Skill items  --}}
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Education & skills section end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve skill information
    
    retrieveAllSkillInfo();

    async function retrieveAllSkillInfo(){

        try{
            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllSkillInfo');
            hideLoader();

            let website_programming_skills = $('#websiteProgrammingSkills');
            let website_programming_skills_title = $('#websiteProgrammingSkills h3');
            let website_technical_skills = $('#websiteTechnicalSkills');
            let website_other_skills = $('#websiteOtherSkills');

            response.data.data.forEach(function(item, index){
                let row = `<div class="bar">
                                <div class="bar_MK25_text row justify-content-space-between">
                                    <div class="col-6">${item['skill_name']}</div>
                                    <div class="col-6">${item['skill_percentage']}%</div>
                                </div>
                                <div class="progress" role="progressbar" aria-label="${item['skill_name']}" aria-valuenow="${item['skill_percentage']}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: ${item['skill_percentage']}%"></div>
                                </div>
                            </div>`
                if(item['skill_type'] === 'Programming'){
                    website_programming_skills_title.removeClass('d-none');
                    website_programming_skills.append(row);
                } else if(item['skill_type'] === 'Technical'){
                    website_technical_skills.removeClass('d-none');
                    website_technical_skills.append(row);
                } else{
                    website_other_skills.removeClass('d-none');
                    website_other_skills.append(row);
                }
                
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
    

    // Function for retrieve education information
    
    retrieveAllEducationInfo();

    async function retrieveAllEducationInfo(){

        try{
            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllEducationInfo');
            hideLoader();
            console.log(response);

            let website_academic_education = $('#websiteAcademicEducation');
            let website_academic_education_title = $('#websiteAcademicEducation h3');
            let website_academic_education_list = $('#websiteAcademicEducation .education_MK25_list');
            let website_technical_education = $('#websiteTechnicalEducation');
            let website_technical_education_list = $('#websiteTechnicalEducation .education_MK25_list');

            response.data.data.forEach(function(item, index){

                // Formatting the starting date
                let startingDate = new Date(item['education_starting_date']);
                let formattedStartingDate = startingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                });

                // Formatting the ending date
                let endingDate = new Date(item['education_ending_date']);
                let formattedEndingDate = endingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                });

                let row = `<li class="education_item">
                                <span class="year">${formattedStartingDate} - ${item['education_ending_date'] ? formattedEndingDate : '<span class="bg-lightgreen badges">Present</span>'}</span>
                                <p>${item['education_degree']}</p>
                            </li>`
                if(item['education_type'] === 'Academic'){
                    website_academic_education_title.removeClass('d-none');
                    website_academic_education_list.append(row);
                } else{
                    website_technical_education.removeClass('d-none');
                    website_technical_education_list.append(row);
                }
                
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}