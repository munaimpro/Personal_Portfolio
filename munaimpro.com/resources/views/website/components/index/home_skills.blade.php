{{-- Skills section --}}
<section id="skills" class="skills_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-sm-12 text-center mb-5">
            <h2 class="section_MK25_first_title">SKILLS</h2>
        </div>
        <div class="col-lg-5 mb-5 section_MK25_subtitle">
            <h3>Skills i acquired</h3>
            <p id="websiteSkillDescription"></p>
        </div>
        <div class="col-lg-7 mb-5 skill_MK25_items" id="websiteHomeSkills">
            
        </div>
        <div class="col-12">
            <a href="{{ url('about') }}" class="external_MK25_section_link fw-bold">
            View All About <i class="fa-solid fa-circle-arrow-right"></i>
            </a>
        </div>
        </div>
    </div>
</section>


{{-- Front end script start --}}

<script>

    // Function for retrive skill information
    
    retriveAllSkillInfo();

    async function retriveAllSkillInfo(){

        try{
            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retriveAllSkillInfo');
            hideLoader();

            website_home_skills = $('#websiteHomeSkills');

            response.data.data.forEach(function(item, index){
                if(index < 4){
                    let row = `<div class="bar">
                                    <div class="bar_MK25_text row justify-content-space-between">
                                        <div class="col-6">${item['skill_name']}</div>
                                        <div class="col-6">${item['skill_percentage']}%</div>
                                    </div>
                                    <div class="progress" role="progressbar" aria-label="${item['skill_name']}" aria-valuenow="${item['skill_percentage']}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar" style="width: ${item['skill_percentage']}%"></div>
                                    </div>
                                </div>`
                    website_home_skills.append(row);
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}