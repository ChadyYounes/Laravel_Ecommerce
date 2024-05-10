const field = document.getElementById("location");
async function initMap() {
    // Request needed libraries.
    const { Map, InfoWindow } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    const map = new Map(document.getElementById("map"), {
        center: { lat: 33.8938, lng: 35.5018 },
        zoom: 14,
        mapId: "4504f8b37365c3d0",
    });
    const infoWindow = new InfoWindow();

    const draggableMarker = new AdvancedMarkerElement({
        map,
        position: { lat: 33.8938, lng: 35.5018 },
        gmpDraggable: true,
        title: "This marker is draggable.",
    });

    draggableMarker.addListener("dragend", (event) => {
        const position = draggableMarker.position;

        infoWindow.close();
        infoWindow.setContent(
            `Pin dropped at: ${position.lat}, ${position.lng}`,

            (field.value = `${position.lat}, ${position.lng}`)
        );
        infoWindow.open(draggableMarker.map, draggableMarker);
    });
}

initMap();
