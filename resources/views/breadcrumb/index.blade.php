
<div class="mt-1 ml-1 flex items-center">
    @if(isset($breadcrumb->parents) && $breadcrumb->parents->count() >0)
        @foreach($breadcrumb->parents as $parentBreadcrumb)
            <div class="ml-1">
                <a href="{{ route($parentBreadcrumb->route) }}">
                    {{ __($parentBreadcrumb->label) }}
                </a> > 
            </div>
        @endforeach
    @endif
    <div class="ml-1"> {{ __($breadcrumb->label) }}</div>
</div>
