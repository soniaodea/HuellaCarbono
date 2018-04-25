let map;
function createMap() {
    let date = new Date();
    let style = (date.getHours() >= 7 && date.getHours() <= 21) ? "mapbox://styles/mapbox/streets-v9" : "mapbox://styles/mapbox/dark-v9";
    map = new mapboxgl.Map({
        container: "map",
        style: style,
        renderWorldCopies: false,
        interactive: true,
        hash: false, // show coords on url
        center: [-1.9817, 43.3077],
        zoom: 12.7,
    });
    map.scrollZoom.disable(); // disable zoom with mousewheel
    map.addControl(new mapboxgl.NavigationControl());
}

function createMarkers(buildings) {
    if (buildings.length > 0) {
        createBuildingsList();
    }

    buildings.forEach(function(building, index) {
        let markerElement = document.createElement("i");
        markerElement.className = "fa fa-3x fa-map-marker text-primary";

        let marker = new mapboxgl.Marker(markerElement)
        .setLngLat(building.geometry.coordinates)
        .setPopup(
            new mapboxgl.Popup({offset: 25})
            .setHTML("<h5>" + building.properties.name + "</h5><p>" + building.properties.description + "</p>")
        )
        .addTo(map);

        buildingElem = createBuilding(building);

        if (index == 0) {
            buildingElem.click();
        }
    });
}

function createBuildingsList() {
    let buildingsList = document.createElement("div");
    buildingsList.id = "buildings";
    buildingsList.className = "d-none d-sm-block py-3";
    document.getElementById("map").insertAdjacentElement("afterbegin", buildingsList);

    let title = document.createElement("h3");
    title.innerText = "Edificios ";
    title.className = "text-center";
    buildingsList.insertAdjacentElement("beforeend", title);

    let img = document.createElement("img");
    img.src = "assets/img/building.png";
    img.style.width = "2em";
    title.insertAdjacentElement("beforeend", img);

    let list = document.createElement("ul");
    list.className = "list-unstyled px-2 text-capitalize";
    buildingsList.insertAdjacentElement("beforeend", list);
}

function createBuilding(building) {

    let buildingElement = document.createElement("li");
    buildingElement.className = "building";
    buildingElement.setAttribute("data-longitude", building.geometry.longitude);
    buildingElement.setAttribute("data-latitude", building.geometry.latitude);
    buildingElement.innerText = building.properties.name;
    document.getElementById("buildings").getElementsByTagName("ul")[0].insertAdjacentElement("beforeend", buildingElement);

    let icon = document.createElement("i");
    icon.className = "fa fa-map-pin";
    buildingElement.insertAdjacentElement("afterbegin", icon);

    buildingElement.addEventListener("click", moveOnMap, false);

    return buildingElement;
}

function moveOnMap() {
    map.flyTo({
        zoom: 15,
        center: [this.getAttribute("data-longitude"), this.getAttribute("data-latitude")]
    });
}
