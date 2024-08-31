{{-- third row start --}}
<div class="row">
{{-- Visitor country report start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="card-title">Visitor Country Report</div>
            </div>
            <div class="card-body">
                <div id="map"></div>
                <div class="last-visitor-info d-flex text-white p-3">
                    <div class="col-4">
                        <p class="m-0">Last visitor IP</p>
                        <p class="fw-bold">100.56.89.90</p>
                    </div>
                    <div class="col-4">
                        <p class="m-0">Last visitor country</p>
                        <p class="fw-bold">USA</p>
                    </div>
                    <div class="col-4">
                        <p class="m-0">Last visitor time</p>
                        <p class="fw-bold">August 24, 2024 at 5:19 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Visitor country report end --}}

{{-- Browser usage start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="card-title">Browser Usage</div>
            </div>
            <div class="card-body">
                <canvas id="browserChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
{{-- Browser usage end --}}
</div>
{{-- third row end --}}