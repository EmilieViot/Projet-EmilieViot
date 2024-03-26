/* ** MAPPING ** */
document.addEventListener("DOMContentLoaded", () => {

        let map = L.map('map').setView([47.963552981598, -3.849275961448], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let marker = L.marker([47.963552981598, -3.849275961448]).addTo(map);

        marker.bindPopup("Rencontrons-nous !").openPopup();

});