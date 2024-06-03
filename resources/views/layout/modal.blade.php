<div class="modal fade show" id="@yield('modal-id')">
    <div class="modal-dialog modal-@yield('modal-size')">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@yield('modal-title')</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @yield('modal-body')
        </div>
    </div>
</div>
