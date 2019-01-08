<div class="row">
    <div class="col-12">
        @if(session()->has('errorNotificationText'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <strong>Erro!</strong> {{ session()->get('errorNotificationText') }}
            </div>
        @endif


        @if(session()->has('notificationText'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <strong>Sucesso!</strong> {{ session()->get('notificationText') }}
            </div>
        @endif
    </div>
</div>
