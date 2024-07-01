document.addEventListener("DOMContentLoaded", () => {
    function getRoute() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        return urlParams.get('route');
    }

    const route = getRoute();


    if (route === 'home' || route === null) {
        // Initialize Leaflet map centered at specified coordinates
        let map = L.map('map').setView([47.963552981598, -3.849275961448], 13);

        // Add OpenStreetMap tile layer to the map
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Add a marker to the map at specified coordinates
        let marker = L.marker([47.963552981598, -3.849275961448]).addTo(map);

        // Bind a popup message to the marker and open it by default
        marker.bindPopup("Rencontrons-nous!").openPopup();
    }
});
