{{-- first row start --}}
<div class="row">
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count">
            <div class="dash-counts">
                <h4 id="totalUser">0</h4>
                <h5>Users</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="user"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das1">
            <div class="dash-counts">
                <h4 id="totalProject">0</h4>
                <h5>Projects</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="briefcase"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das2">
            <div class="dash-counts">
                <h4 id="totalService">0</h4>
                <h5>Services</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="settings"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das3">
            <div class="dash-counts">
                <h4 id="totalPost">0</h4>
                <h5>Blogs</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="file-text"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das4">
            <div class="dash-counts">
                <h4 id="totalCategory">0</h4>
                <h5>Categories</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="tag"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das5">
            <div class="dash-counts">
                <h4 id="totalVisitor">0</h4>
                <h5>Visitors</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="eye"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das6">
            <div class="dash-counts">
                <h4 id="totalNewMessage">0</h4>
                <h5>Messages</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="message-circle"></i>
            </div>
        </div>
    </div>
</div>
{{-- first row end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive dashboard statistics

    dashboardStatInfo();

    async function dashboardStatInfo(){
        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.get('/dashboardStatInfo');
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                $('#totalUser').html(response.data.total_user);
                $('#totalProject').html(response.data.total_portfolio);
                $('#totalService').html(response.data.total_service);
                $('#totalPost').html(response.data.total_post);
                $('#totalCategory').html(response.data.total_category);
                $('#totalVisitor').html(response.data.total_visitor);
                $('#totalNewMessage').html(response.data.total_message);
            } else{
                console.log('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}