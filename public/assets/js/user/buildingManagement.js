
document.addEventListener("DOMContentLoaded", function () {
    addRemoveEvent();
    addEditEvent();
}, false);

function addRemoveEvent() {
    for (element of document.querySelectorAll("[data-action=\"delete\"]")) {
        element.addEventListener("click", deleteBuilding, false);
    }
}

function addEditEvent() {
    for (element of document.querySelectorAll("[data-action=\"edit\"]")) {
        element.addEventListener("click", editBuilding, false);
    }
}

function deleteBuilding() {
    swal({
        title: "Eliminar edificio",
        text: "Esta acción no puede ser revertida, ¿deseas continuar?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            cancel: "No, cancelar",
            confirm: {
                text: "Si, eliminar"
            }
        }
    }).then((value) => {
        if (value) {
            this.parentNode.getElementsByTagName("form")[0].submit();
        }
    });
}

function editBuilding() {
    let row = this;
    while(row.tagName != "TR") {
        row = row.parentNode;
    }

    document.getElementById("id").value = row.getElementsByClassName("id")[0].innerText;

    document.getElementById("name").value = row.getElementsByClassName("name")[0].innerText;


    document.getElementById("surface").value = row.getElementsByClassName("surface")[0].innerText;

    //document.getElementById("description").value = row.getElementsByClassName("description")[0].innerText;
    let country = document.getElementById("country_id").options;
    let countryId = row.getElementsByClassName("country")[0].getAttribute("data-id");
    for (let i = 0; i < country.length; i++) {
        if (country[i].value == countryId) {
            country[i].selected = true;
            break;
        }
    }
    let region = document.getElementById("region_id").options;
    let regionId = row.getElementsByClassName("region")[0].getAttribute("data-id");
    for (let i = 0; i < region.length; i++) {
        if (region[i].value == regionId) {
            region[i].selected = true;
            break;
        }
    }
    //document.getElementById("postcode").value = row.getElementsByClassName("postcode")[0].innerText;
    //document.getElementById("address").value = row.getElementsByClassName("address")[0].innerText;
    let coordinates = row.getElementsByClassName("coordinates")[0];
    document.getElementById("editLatitude").value = null;
    document.getElementById("editLongitude").value = null;

    showEditMap(coordinates.getAttribute("data-latitude"), coordinates.getAttribute("data-longitude"))

    $("#editBuildingModal").modal("show");
}

let editMap,
    editMarker,
    newBuildingMap,
    newBuildingMarker,
    building_id;

$('#addBuildingModal').one('shown.bs.modal', function () {
    let lat = 40.393;
    let lng = -3.702;
    let zoom = 5;

    newBuildingMap = createMap("createMap");
    newBuildingMap.on("load", function () {
        this.setCenter([lng, lat]);
        this.setZoom(zoom);
    });

    let markerElement = document.createElement("i");
    markerElement.className = "fa fa-3x fa-map-marker text-primary";
    newBuildingMarker = new mapboxgl.Marker(markerElement)
    .setLngLat([lng, lat])
    .addTo(newBuildingMap);

    addClickEvent(newBuildingMap, newBuildingMarker, function (lngLat) {
        document.getElementById("createLatitude").value = lngLat.lat;
        document.getElementById("createLongitude").value = lngLat.lng;
    });
});

function showEditMap(lat, lng) {
    let zoom = 15;
    if (!lat || !lng) {
        lat = 40.393;
        lng = -3.702;
        zoom = 5;
    }

    if (!editMap) {
        $('#editBuildingModal').one('shown.bs.modal', function () {
            editMap = createMap("editMap");
            editMap.on("load", function () {
                this.setCenter([lng, lat]);
                this.setZoom(zoom);
            });

            let markerElement = document.createElement("i");
            markerElement.className = "fa fa-3x fa-map-marker text-primary";
            editMarker = new mapboxgl.Marker(markerElement)
            .setLngLat([lng, lat])
            .addTo(editMap);

            addClickEvent(editMap, editMarker, function (lngLat) {
                document.getElementById("editLatitude").value = lngLat.lat;
                document.getElementById("editLongitude").value = lngLat.lng;
            });
        });

    } else {
        editMarker.setLngLat([lng, lat]);
        editMap.flyTo({
            zoom: zoom,
            center: editMarker.getLngLat()
        });
    }
}

function createMap(mapId) {
    return new mapboxgl.Map({
        container: mapId,
        style: 'mapbox://styles/mapbox/streets-v9',
        zoom: 9
    });
}

function addClickEvent(map, marker, callback) {
    map.on("click", function(e) {
        let lat = e.lngLat.lat;
        let lng = e.lngLat.lng;

        marker.setLngLat([lng, lat]);

        if (typeof callback === "function") {
            callback(e.lngLat);
        }
    });
}

$(function () {
    $('#addBuildingModal').on('shown.bs.modal', function () {
        $('#addBuildingModal input:not([type="hidden"])').first().trigger('focus');
    });

    $('#editBuildingModal').on('shown.bs.modal', function () {
        $('#editBuildingModal input:not([type="hidden"])').first().trigger('focus');
    });
});
