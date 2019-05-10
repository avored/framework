
<div class="mt-1 ml-1">
    <a-breadcrumb>
        @if(isset($breadcrumb->parents) && $breadcrumb->parents->count() >0)
            @foreach($breadcrumb->parents as $parentBreadcrumb)
                    
                <a-breadcrumb-item>
                    <a href="{{ route($parentBreadcrumb->route) }}">
                        {{ __($parentBreadcrumb->label) }}
                    </a>
                </a-breadcrumb-item>
            
            @endforeach
        @endif
        
        <a-breadcrumb-item>{{ __($breadcrumb->label) }}</a-breadcrumb-item>
    </a-breadcrumb>
</div>
