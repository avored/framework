<div class="row mt-3">
    <div class="col-12">
        @if(session()->has('errorNotificationText'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <strong>Error!</strong> {{ session()->get('errorNotificationText') }}
            </div>
        @endif


        @if(session()->has('notificationText'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <strong>Success!</strong> {{ session()->get('notificationText') }}
            </div>
        @endif
    </div>
</div>
