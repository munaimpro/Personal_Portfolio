{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Client Feedback</h4>
        <h6>Manage Client Feedback</h6>
    </div>
</div>
{{-- Page header end --}}

{{-- Table start --}}
<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset">
                        <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                    </a>
                </div>
            </div>
            <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew" id="tableData">
            <thead>
            <tr>
                <th>Name</th>
                <th>Designation</th>
                <th>Feedback</th>
                <th>Date</th>
                <th>Project Name</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody id="tableList">
                
            </tbody>
            </table>
            </div>
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve client feedback information
    
    retrieveAllClientFeedbackInfo();

    async function retrieveAllClientFeedbackInfo(){

        try{
            // Getting data table
            let table_data = $('#tableData');

            // Getting table rows
            let table_list = $('#tableList');

            // Destroy data table
            // table_data.DataTable().destroy();

            // Make data table empty
            table_list.empty();

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllClientFeedbackInfo');
            hideLoader();

            console.log(response);

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the client image
                let clientImageFullPath = baseUrl + '/storage/profile_picture/client_images/' + item['client_image'];

                // Formatting the client feedback created at date
                let feedbackDate = new Date(item['created_at']);
                let formattedfeedbackDate = feedbackDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Limit the feedback string
                function shortenText(text, length = 20, suffix = '...'){
                    if(text.length > length){
                        return text.substring(0, length) + suffix;
                    }

                    return text;
                }

                let row = `<tr>
                                <td class="productimgname d-block">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src=${clientImageFullPath} alt="client image" class="h-50 w-50">
                                    </a>
                                    <p class="fw-bold">${item['client_first_name']} ${item['client_last_name']}</p>
                                </td>
                                <td>${item['client_designation']}</td>
                                <td>${shortenText(item['client_feedback'])}</td>
                                <td>${formattedfeedbackDate}</td>
                                <td>${item.portfolio['project_title']}</td>
                                <td>
                                    <a data-id=${item.id} class="viewBtn me-3" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                                    </a>
                                    <a data-id=${item.id} class="deleteBtn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>`
                table_list.append(row);
            });

            $('.deleteBtn').on('click', function(){
                $('#clientFeedbackInfoDeleteId').val($(this).data('id'));
            });

            $('.viewBtn').on('click', function(){
                let clientfeedback_info_id = $(this).data('id');
                retrieveClientFeedbackInfoById(clientfeedback_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}