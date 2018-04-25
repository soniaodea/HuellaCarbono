<div id="loginModal" class="modal fade">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Login</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @include("forms.auth.login")
            </div>
        </div>

    </div>
</div>

<div id="registerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @include("forms.auth.register")
            </div>
        </div>

    </div>
</div>

@if(Request::session()->get("loginFailed"))
    <script>
        $(function() {
            $("#loginModal").modal("show");
        });
    </script>
@endif

@if(Request::session()->get("registerFailed"))
    <script>
        $(function() {
            $("#registerModal").modal("show");
        });
    </script>
@endif
