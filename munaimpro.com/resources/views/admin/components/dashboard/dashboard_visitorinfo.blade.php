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
                        <p class="fw-bold" id="lastVisitorIP"></p>
                    </div>
                    <div class="col-4">
                        <p class="m-0">Last visitor country</p>
                        <p class="fw-bold" id="lastVisitorCountry"></p>
                    </div>
                    <div class="col-4">
                        <p class="m-0">Last visitor time</p>
                        <p class="fw-bold" id="lastVisitingDate"></p>
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


{{-- Front end script start --}}

<script>

    // Function for retrieve dashboard last visitor information

    dashboardLatestVisitorInfo();

    async function dashboardLatestVisitorInfo(){
        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/dashboardLatestVisitorInfo');
            hideLoader();

            // Formatting the client feedback created at date
            let lastVisitingTime = new Date(response.data.data[0]['last_visiting_time']);
            let formattedLastVisitingTime = lastVisitingTime.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            if(response.data['status'] === 'success'){
                // Assigning retrieved values
                $('#lastVisitorIP').html(response.data.data[0]['ip_address']);
                $('#lastVisitorCountry').html(response.data.data[0]['visitor_country']);
                $('#lastVisitingDate').html(formattedLastVisitingTime);
            } else{
                console.log('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }



    // Function for retrieve dashboard visitor country information

    dashboardVisitorCountryInfo();

    async function dashboardVisitorCountryInfo(){
        try {
            // Passing id to controller and getting response
            showLoader();
            let response = await axios.post('/dashboardVisitorCountryInfo');
            hideLoader();

            if (response.data['status'] === 'success') {

                var map = L.map('map').setView([20, 0], 2.2); // Center the map

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // GeoJSON URL (for example purposes, this URL may not be valid)
                var geojsonUrl = 'https://raw.githubusercontent.com/datasets/geo-countries/master/data/countries.geojson';

                // Function to determine the style based on visitor countries
                function style(feature) {
                    let countryMatched = response.data.data.some(item => item['visitor_country'] === feature.properties.ADMIN);
                    if (countryMatched) {
                        return { color: "#008000" };
                    } else {
                        return { color: "#CCCCCC" }; // Default color for other countries
                    }
                }

                // Function to bind tooltips and other events
                function onEachFeature(feature, layer) {
                    // Bind a tooltip with the region's name
                    layer.bindTooltip(feature.properties.ADMIN, {
                        permanent: false, // Tooltip only shows on hover
                        direction: "center"
                    });

                    // You can add other events or interactions here
                }

                // Load GeoJSON data and apply style
                L.geoJson.ajax(geojsonUrl, {
                    style: style,
                    onEachFeature: onEachFeature
                }).addTo(map);

                // Ensure map size is recalculated correctly
                map.invalidateSize();

            } else {
                console.log('error', response.data['message']);
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }



    // Function for retrieve dashboard visitor browser usage information

    dashboardVisitorBrowserUsageInfo();

    // async function dashboardVisitorBrowserUsageInfo(){
    //     try {
    //         // Passing id to controller and getting response
    //         showLoader();
    //         let response = await axios.post('/dashboardVisitorBrowserUsageInfo');
    //         hideLoader();

    //         if (response.data['status'] === 'success') {

    //         } else {
    //             console.log('error', response.data['message']);
    //         }
    //     } catch (e) {
    //         console.error('Something went wrong', e);
    //     }
    // }

    async function dashboardVisitorBrowserUsageInfo(){
        try {
            // Show loader while fetching data
            showLoader();
            let response = await axios.post('/dashboardVisitorBrowserUsageInfo');
            hideLoader();

            if (response.data['status'] === 'success') {
                const chartData = response.data;

                // Define default colors for browsers
                const colorMap = {
                    'Chrome': 'rgba(251, 188, 5, 1)',
                    'Firefox': 'rgba(255, 69, 0, 1)',
                    'Safari': 'rgba(64, 158, 255, 1)',
                    'Edge': 'rgba(102, 51, 153, 1)',
                    'Opera': 'rgba(217, 0, 29, 1)',
                    'Other': 'rgba(51, 51, 51, 1)'
                };

                // Initialize arrays for colors
                const backgroundColors = [];
                const borderColors = [];

                // Assign colors dynamically based on the browser labels
                chartData.labels.forEach(label => {
                    backgroundColors.push(colorMap[label] || 'rgba(200, 200, 200, 1)');
                    borderColors.push(colorMap[label] || 'rgba(200, 200, 200, 1)');
                });

                // Update the chart data dynamically
                const data = {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Browser Usage',
                        data: chartData.percentage,
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 1
                    }]
                };

                // Configuration options
                const config = {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += context.raw.toFixed(2) + '%';
                                        return label;
                                    }
                                }
                            },
                            datalabels: {
                                formatter: (value, context) => {
                                    let sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = (value * 100 / sum);

                                    if (percentage < 6) {
                                        return null;
                                    }

                                    let label = context.chart.data.labels[context.dataIndex];
                                    return label + '\n' + percentage.toFixed(2) + '%';
                                },
                                color: '#fff',
                                labels: {
                                    title: {
                                        font: {
                                            weight: 'bold',
                                            size: '14'
                                        }
                                    }
                                },
                                anchor: 'end',
                                align: 'start',
                                offset: 10
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                };

                // Render the chart
                const browserChart = new Chart(
                    document.getElementById('browserChart'),
                    config
                );
            } else {
                console.log('error', response.data['message']);
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }


</script>

{{-- Front end script end --}}