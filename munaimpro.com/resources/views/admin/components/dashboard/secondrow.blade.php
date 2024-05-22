{{-- second row start --}}
<div class="row">
    <div class="col-lg-7 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Purchase & Sales</h5>
                <div class="graph-sets">
                    <ul>
                        <li>
                            <span>Sales</span>
                        </li>
                        <li>
                            <span>Purchase</span>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        2022 <img src="{{ asset('assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item">2022</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item">2021</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="dropdown-item">2020</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="sales_charts"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Recently Added Products</h4>
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="productlist.html" class="dropdown-item">Product List</a>
                        </li>
                        <li>
                            <a href="addproduct.html" class="dropdown-item">Product Add</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Products</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="productimgname">
                                    <a href="productlist.html" class="product-img">
                                        <img src="{{ asset('assets/img/product/product22.jpg') }}" alt="product">
                                    </a>
                                    <a href="productlist.html">Apple Earpods</a>
                                </td>
                                <td>$891.2</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td class="productimgname">
                                    <a href="productlist.html" class="product-img">
                                        <img src="{{ asset('assets/img/product/product23.jpg') }}" alt="product">
                                    </a>
                                    <a href="productlist.html">iPhone 11</a>
                                </td>
                                <td>$668.51</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td class="productimgname">
                                    <a href="productlist.html" class="product-img">
                                        <img src="{{ asset('assets/img/product/product24.jpg') }}" alt="product">
                                    </a>
                                    <a href="productlist.html">samsung</a>
                                </td>
                                <td>$522.29</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- second row end --}}