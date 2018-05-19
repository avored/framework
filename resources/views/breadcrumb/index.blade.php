

    <ol class="breadcrumb mt-3">

        @if(isset($breadcrumb->parents) && $breadcrumb->parents->count() >0)
            @foreach($breadcrumb->parents as $parentBreadcrumb)
                <li class="breadcrumb-item"><a href="{{ route($parentBreadcrumb->route) }}">
                        {{  __($parentBreadcrumb->label) }}
                    </a>
                </li>
            @endforeach
        @endif
            <li class="breadcrumb-item active">{{ __($breadcrumb->label) }}</li>

    </ol>
