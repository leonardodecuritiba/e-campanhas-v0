@foreach($Observations as $observation)
    <blockquote class="blockquote">
        <p class="">{{$observation->descriptions}}
            @if($Data->canRemObservations())
                <button data-href="{{ route('ajax.commons.observations.destroy', $observation->id)}}"
                        type="button"
                        class="btn btn-simple btn-xs btn-danger btn-icon"
                        onclick="showDeleteObservationMessage(this)">Remover</button>
            @endif</p>
        <footer class=""><b>{{$observation->owner->getName()}}</b> - {{$observation->created_at_formatted}}</footer>
    </blockquote>
{{--    <hr>--}}
{{--@empty--}}
{{--    <i>Sem observações</i>--}}
@endforeach