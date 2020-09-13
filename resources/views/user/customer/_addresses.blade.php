@if (!isset($address))

<div class="text-gray-800 flex items-center">
    <div class="text-xl text-red-700 font-semibold">
        {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.addresses')]) }}
    </div>
</div>

<div class="mt-5">
    <address-table
        :init-addresses="{{ json_encode($customer->addresses()->paginate(10)) }}"
        :customer="{{ $customer }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
    ></address-table>
</div>

@else
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.address')]) }}
        </div>
    </div>
    <div class="mt-5">
        <form action="{{ route('admin.address.update', ['customer' => $customer->id, 'address' => $address->id]) }}" method="post">
            @csrf
            @method('put')
            

        </form>
    </div>
@endif
