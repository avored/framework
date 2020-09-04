
<div class="bg-gray-200 mr-8 p-3 rounded text-sm m-4">
    <ol class="list-reset flex text-gray-700">
    @if(isset($breadcrumb->parents) && $breadcrumb->parents->count() >0)
        @foreach($breadcrumb->parents as $parentBreadcrumb)
            <li>
                <a class=" font-semibold" href="{{ route($parentBreadcrumb->route) }}">
                    {{ __($parentBreadcrumb->label) }}
                </a> > &nbsp;
            </li>
        @endforeach
    @endif
    <li> <span class="">{{ __($breadcrumb->label) }}</span></li>
    </ol>
</div>
