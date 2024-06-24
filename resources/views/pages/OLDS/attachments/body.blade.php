<div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
    <div class="card">
        @if($Data->canAddAttachments())
            <button class="btn btn-w-md btn-multiline btn-info mb-2" data-toggle="modal" data-type="expenses"
                    data-target="#itemAttachments" ><i class="ti-anchor fs-20"></i><br>Anexar</button>
        @endif
        <div class="row">
        @foreach($Attachments as $attachment)
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="media align-items-center">
                    <a href="{{$attachment->link_download}}" target="_blank">
                        <span>
                            <i class="ti-file fs-30 text-info"></i>
                        </span>
                        <div class="media-body">
                            <h5>{{$attachment->description}}</h5>
                            <p class="gap-items">
                                <small>Arquivo: {{$attachment->link}}</small>
                            </p>
                        </div>
                    </a>
                    @if($Data->canRemAttachments())
                        <a class="media-action hover-danger" data-href="{{ route('ajax.commons.attachments.destroy', $attachment->id)}}"
                           onclick="showDeleteAttachmentMessage(this)" href="#"
                           data-provide="tooltip" title="Remover"><i class="ti-close"></i></a>
                    @endif
                </div>
            </div>
        @endforeach
        </div>
{{--        --}}
{{--        <table class="table table-striped table-bordered" data-provide="datatables">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>ID</th>--}}
{{--                <th>Descrição</th>--}}
{{--                <th>Ação</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tfoot>--}}
{{--            <tr>--}}
{{--                <th>ID</th>--}}
{{--                <th>Descrição</th>--}}
{{--                <th>Ação</th>--}}
{{--            </tr>--}}
{{--            </tfoot>--}}
{{--            <tbody>--}}
{{--            @foreach($Attachments as $attachment)--}}
{{--                <tr>--}}
{{--                    <td>{{$attachment->id}}</td>--}}
{{--                    <td>{{$attachment->description}}</td>--}}
{{--                    <td>--}}
{{--                        --}}
{{--                        <a>{{$attachment->link_download}}</a></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        --}}
    </div>
</div>