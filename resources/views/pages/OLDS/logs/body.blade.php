<div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
    <div class="card">
        <ol class="timeline timeline-activity timeline-point-sm timeline-content-right w-100 py-20 pr-20">

            @foreach($Logs as $log)
                <li class="timeline-block">
                    <div class="timeline-point">
                        <span class="badge badge-dot badge-lg badge-{{$log->log_color}}"></span>
                    </div>
                    <div class="timeline-content">
                        <time datetime="2018">{{$log->created_at_human_formatted}}</time>
                        <p><b>{{$log->getCreatorName()}}</b>: {{$log->log_text}}</p>
                    </div>
                </li>
            @endforeach

        </ol>
    </div>
</div>