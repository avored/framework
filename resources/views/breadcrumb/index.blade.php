
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

{{-- <nav class="bg-grey-light p-3 rounded font-sans w-full m-4">
  <ol class="list-reset flex text-grey-dark">
    <li><a href="#" class="text-blue font-bold">Home</a></li>
    <li><span class="mx-2">/</span></li>
    <li><a href="#" class="text-blue font-bold">Library</a></li>
    <li><span class="mx-2">/</span></li>
    <li>Data</li>
  </ol>
</nav> --}}
