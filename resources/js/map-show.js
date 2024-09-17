/* IMPORO LA MAPPA */
import tt from "@tomtom-international/web-sdk-maps"

/* RECUPERO BOTTONE MAPPA */
const mapButton = document.getElementById('map-button');
/* RECUPERO LA MAPPA */
const mapContainer = document.getElementById('map');


/* FUNZIONE PER GESTIRE IL CLICK */
function handleMapButtonClick() {

    /* SE ESISTE */
    if (mapContainer) {


        /* RECUEPRO COORDINATATE DAL DATASET */
        const lat = mapContainer.dataset.latitude;
        const lon = mapContainer.dataset.longitude;


        /* CREAZIONE DELLA MAPPA */
        const map = tt.map({
            key: import.meta.env.VITE_TT_API_KEY, // API KEY 
            container: mapContainer, // CONTENITORE
            center: [
                lon,
                lat
            ], // LATITUDINE E LONGITUDINE
            zoom: 12 // ZOOM VISTA
        });


        /* AGGIUNGO LO ZOOM SULLA MAPPA */
        map.addControl(new tt.NavigationControl());

        /* MAKER AL CENTRO DELLA PAGINA */
        const marker = new tt.Marker().setLngLat([lon, lat]).addTo(map);

        /* DIMESIONE MAPPA */
        setTimeout(() => { map.resize(); }, 150);


        /* RIMUOVO L'EVENTO DOPO AVER CHIUSO LA MAPPA */
        mapButton.removeEventListener('click', handleMapButtonClick);
    }
}


/* ALL'EVENTO SUL BOTTONE RICHIAMO LA FUNZIONE */
mapButton.addEventListener('click', handleMapButtonClick);
