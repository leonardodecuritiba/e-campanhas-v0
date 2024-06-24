<div class="tab-pane fade" id="observations" role="tabpanel" aria-labelledby="observations-tab">
    <div class="card">
        @if($Data->canAddObservations())
            <button class="btn btn-w-md btn-multiline btn-info mb-2" data-toggle="modal" data-id="{{"#"}}"
                    data-target="#addObservations" ><i class="ti-comment fs-20"></i><br>Comentar</button>
        @endif
        <div class="observations-list">
            @include('pages.commons.observations.item',["Observations" => $Observations])
        </div>
    </div>
</div>