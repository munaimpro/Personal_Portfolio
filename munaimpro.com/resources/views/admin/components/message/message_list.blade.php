{{-- Page header - Message not read start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Messages</h4>
        <h6>Manage Client Messages</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Send Message
        </button>
    </div>
</div>
{{-- Page header - Message not read end --}}

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
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
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

    // Function to retrieve all message information
    retrieveAllMessageInfo();

    async function retrieveAllMessageInfo(){
        try {
            // Getting table rows
            let table_list = $('#tableList');

            // Destroy data table
            // table_data.DataTable().destroy();

            // Make table empty
            table_list.empty();

            // Passing data to controller and getting response
            showLoader();
            let response = await axios.get('/retriveAllMessageInfo');
            hideLoader();

            response.data.data.forEach(function(item){
                // Formatting the created_at date
                let createdAt = new Date(item['created_at']);
                let formattedDate = createdAt.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let row = `<tr>
                                <td>${item['name']}</td>
                                <td>${item['email']}</td>
                                <td>${item['subject']}</td>
                                <td>${formattedDate}</td>
                                <td>
                                    <a data-id="${item.id}" class="viewBtn me-3" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                                    </a>                                        
                                    <a data-id="${item.id}" class="replyBtn me-3" data-bs-toggle="modal" data-bs-target="#replyModal">
                                        <img src="{{ asset('assets/img/icons/reply.svg') }}" alt="img">
                                    </a>                                        
                                    <a data-id="${item.id}" class="deleteBtn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>`;
                table_list.append(row);
            });

            $('.deleteBtn').on('click', function(){
                $('#messageInfoDeleteId').val($(this).data('id'));
            });

            $('.viewBtn').on('click', function(){
                let message_info_id = $(this).data('id');
                retrieveMessageInfoById(message_info_id);
            });

            $('.replyBtn').on('click', function(){
                let message_info_id = $(this).data('id');
                retrieveMessageInfoById(message_info_id);
            });

        } catch (e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}