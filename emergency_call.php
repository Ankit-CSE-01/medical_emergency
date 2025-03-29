<?php require_once 'includes/header.php'; ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h4>Emergency Call</h4>
            </div>
            <div class="card-body">
                <p>Click the button below to connect to the nearest hospital emergency service:</p>
                <button id="callEmergency" class="btn btn-danger btn-lg">
                    <i class="fas fa-phone"></i> Call Emergency
                </button>
                <div id="callStatus" class="mt-3"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Nearest Hospitals</h4>
            </div>
            <div class="card-body">
                <div id="map" style="height: 300px;"></div>
                <div id="hospitalsList" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('callEmergency').addEventListener('click', function() {
    // In a real application, this would initiate a call to the nearest hospital
    // For demo purposes, we'll simulate the call
    const callStatus = document.getElementById('callStatus');
    callStatus.innerHTML = '<div class="alert alert-info">Connecting to nearest emergency service...</div>';
    
    // Simulate call connection after 2 seconds
    setTimeout(() => {
        callStatus.innerHTML = '<div class="alert alert-success">Connected to emergency services. Please describe your emergency.</div>';
    }, 2000);
});

// Initialize map and show nearby hospitals
function initMap() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            
            // In a real app, you would fetch nearby hospitals from your database
            // For demo, we'll use some sample hospitals
            const hospitals = [
                {name: "City General Hospital", lat: userLat + 0.01, lng: userLng + 0.01, phone: "123-456-7890", distance: "1.2 km"},
                {name: "Central Medical Center", lat: userLat - 0.01, lng: userLng - 0.01, phone: "123-456-7891", distance: "1.5 km"},
                {name: "Community Health Clinic", lat: userLat + 0.02, lng: userLng - 0.01, phone: "123-456-7892", distance: "2.1 km"}
            ];
            
            // Create map centered on user's location
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: userLat, lng: userLng},
                zoom: 13
            });
            
            // Add user marker
            new google.maps.Marker({
                position: {lat: userLat, lng: userLng},
                map: map,
                title: "Your Location",
                icon: {
                    url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
                }
            });
            
            // Add hospital markers
            hospitals.forEach(hospital => {
                new google.maps.Marker({
                    position: {lat: hospital.lat, lng: hospital.lng},
                    map: map,
                    title: hospital.name
                });
            });
            
            // Display hospitals list
            const hospitalsList = document.getElementById('hospitalsList');
            hospitalsList.innerHTML = '<h5>Nearby Hospitals:</h5>';
            
            hospitals.forEach(hospital => {
                hospitalsList.innerHTML += `
                    <div class="hospital-item mb-2 p-2 border rounded">
                        <h6>${hospital.name}</h6>
                        <p>Distance: ${hospital.distance} | Phone: ${hospital.phone}</p>
                    </div>
                `;
            });
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

// Load the Google Maps API
window.initMap = initMap;
</script>

<?php require_once 'includes/footer.php'; ?>