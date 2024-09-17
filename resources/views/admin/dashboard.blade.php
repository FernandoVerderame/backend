@extends('layouts.app')

@section('title', 'Pannello di controllo')

@section('content')

@extends('layouts.app')

@section('title', 'Pannello di controllo')

@section('content')

    <h1 class="mt-5 mb-5">Pannello di controllo</h1>
    <div class="row row-gap-3 mb-5">
        <div class="col-8 col-lg-4 offset-2 offset-lg-0">
            {{-- CARD APPARTAMENTI IN GESTIONE --}}
            <div class="card align-items-center p-3">
                <h4 class="mb-2">Appartamenti totali</h4>
                <div>
                    <span class="dashbutton me-2"><i class="fa-solid fa-house"></i></span>
                    {{-- TOTALE APPARTAMENTI --}}
                    <span>{{ $apartments->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-8 col-lg-4 offset-2 offset-lg-0">
            {{-- CARD MESSAGGI TOTALI --}}
            <div class="card align-items-center p-3">
                <h4 class="mb-2">Messaggi totali</h4>
                <div>
                    <span class="dashbutton me-2"><i class="fa-solid fa-envelope-open-text"></i></span>
                    {{-- TOTALE MESSAGGI --}}
                    <span>{{ $totalMessages }}</span>
                </div>
            </div>
        </div>
        <div class="col-8 col-lg-4 offset-2 offset-lg-0">
            {{-- CARD VISUALIZZAZIONI TOTALI --}}
            <div class="card align-items-center p-3">
                <h4 class="mb-2">Visualizzazioni totali</h4>
                <div>
                    <span class="dashbutton me-2"><i class="fa-regular fa-eye"></i></span>
                    {{-- TOTALE VISUALIZZAZIONI --}}
                    <span>{{ $totalViews }}</span>
                </div>
            </div>
        </div>
    </div>
    <h1 class="mb-5">Statistiche</h1>
    <div class="row row-gap-3">
        <div class="col col-md-6">
            {{-- CARD VISUALIZZAZIONI TOTALI--}}
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Visualizzazioni</h4>
                    <span class="dashbutton me-2"><i class="fa-regular fa-eye"></i></span>
                </div>
                <div class="box-grafic">
                    <canvas id="total-views"></canvas>
                </div>
            </div>
        </div>
        <div class="col col-md-6">
            {{-- CARD MESSAGGI MENSILI --}}
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Messaggi</h4>
                    <span class="dashbutton me-2"><i class="fa-solid fa-envelope-open-text"></i></span>
                </div>
                <div class="box-grafic">
                    <canvas id="total-messages"></canvas>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('scripts')

<!-- IMPORTO CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.js"></script>

<script>
    /* INIZZIALIZZO GRAFICO */
    const initGraph = (elem, title, labels, data, backgroundColor) => {
        const graph = new Chart(elem, {
            type: 'bar',
            data: {
                labels, // ETICHETTE ASSE X
                datasets: [{
                    label: title, // TITOLO DEL GRAFICO
                    data, // DATI DA VISUALIZZARE NEL GRAFICO
                    borderWidth: 2, // SPESSORE BORDO
                    backgroundColor // SFONDO
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        /* RESTITUISCO IL GRAFICO CREATO */
        return graph;
    }


    /* ARRAY MESI */
    const monthsAxis = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];


    /* RECUPERO ELEMENTI */
    const viewsTotalElem = document.getElementById('total-views');
    const messagesTotalElem = document.getElementById('total-messages');


    /* RECUPERO I VALORI DEI MESSAGGI E DELLE VISSULIAZZIZIONI PASSATI DALLA DASHBORDCONTROLLER */
    const viewsTotalData = <?php echo json_encode($month_views) ?>;
    const messagesTotalData = <?php echo json_encode($month_messages) ?>;

    /* GRAFICI PER LE VISSUALIZZAZIONI */
    initGraph(viewsTotalElem, 'Visualizzazioni totali', monthsAxis, viewsTotalData, 'rgba(255, 0, 0, 0.7)');

    
    /* GRAFICI PER I MESSAGGI */
    initGraph(messagesTotalElem, 'Messaggi totali', monthsAxis, messagesTotalData, 'rgba(0, 0, 255, 0.7)');
</script>

@endsection
