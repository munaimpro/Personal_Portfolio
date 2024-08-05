{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Service List</h4>
        <h6>View/Search Service</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Service
        </button>
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
                        <th>
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Service Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableList">
                    <tr>
                        <td>Name</td>
                        <td>
                            <a class="me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                            </a>                                        
                            <a lass="me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive service information
    
    retriveAllServiceInfo();

    async function retriveAllServiceInfo(){

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
            let response = await axios.get('/retriveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>${item['service_title']}</td>
                                <td>
                                    <a data-id=${item.id} class="editBtn me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                    </a>                                        
                                    <a data-id=${item.id} class="deleteBtn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>`
                table_list.append(row);
            });

            $('.deleteBtn').on('click', function(){
                $('#serviceInfoDeleteId').val($(this).data('id'));
            });

            $('.editBtn').on('click', function(){
                let service_info_id = $(this).data('id');
                retriveServiceInfoById(service_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}