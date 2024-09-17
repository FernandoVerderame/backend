{{-- MODALE MAPPA --}}
<div class="modal" id="mapModal" tabindex="-1">
    <div class="map modal-dialog">
        <div class="modal-content text-center">
            {{-- SE CE UN INDIRIZZO --}}
            @if ($apartment->address)
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- TTITOLO E INDIRIZZO --}}
                    <div class="description ">
                        <h3>{{ $apartment->title }}</h3>
                        <hr>
                        <h5>Si trova a </h5>
                        <h6>{{ $apartment->address }}</h6>
                    </div>
                    {{-- MAPPA --}}
                    <div class="map-box">
                        <div id="map" style="width: 80%; height: 80%" data-latitude="{{ $apartment->latitude }}"
                            data-longitude="{{ $apartment->longitude }}">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>