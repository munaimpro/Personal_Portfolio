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
            <table class="table  datanew">
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
                        <th>City</th>
                        <th>Browser</th>
                        <th>Total Visit</th>
                        <th>Last Visit</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>Ip address</td>
                        <td>country name</td>
                        <td>city name</td>
                        <td>browser name</td>
                        <td>total visit count</td>
                        <td>last visiting time and date</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- Table content end --}}
    </div>
</div>
{{-- Table end --}}