{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Visitor's Information</h4>
        <h6>Who visited our site</h6>
    </div>
</div>
{{-- Page header - SEO Properties end --}}

{{-- Table start --}}
<div class="card">
    <div class="card-body">
        {{-- Table search start --}}
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img"></a>
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
        {{-- Table search end --}}
        
        {{-- Table content start --}}
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
                        <th>IP Address</th>
                        <th>Country</th>
                        <th>Browser</th>
                        <th>Total Visit</th>
                        <th>Last Visit</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableList">
                    
                </tbody>
            </table>
        </div>
        {{-- Table content end --}}
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve visitor information
    
    retrieveAllVisitorInfo();

    async function retrieveAllVisitorInfo(){

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
            let response = await axios.get('/retrieveAllVisitorInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){

                // Formatting the last visiting time
                let lastVisit = new Date(item['last_visiting_time']);
                let formattedDate = lastVisit.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let row = `<tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>${item['ip_address']}</td>
                                <td>${item['visitor_country']}</td>
                                <td>${item['visitor_browser']}</td>
                                <td>${item['total_visit']}</td>
                                <td>${formattedDate}</td>
                                <td>
                                    <a data-id="${item.id}" class="viewBtn me-3" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>`
                table_list.append(row);
            });

            $('.viewBtn').on('click', function(){
                let visitor_info_id = $(this).data('id');
                retrieveVisitorInfoById(visitor_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}