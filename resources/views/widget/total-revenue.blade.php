<div class="md:w-1/3 sm:w-full cursor-pointer bg-blue-600 mt-5 border text-center b-gray-400 rounded items-center p-6 text-white">
    <div class="text-md border-b pb-3 font-bold w-full">
        <span class="uppercase">
            {{ __('avored::system.total-revenue') }}
        </span>
    </div>
    <div class="flex mt-5 text-center justify-around items-center">
        <div class="w-12 h-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4.13 12H4a2 2 0 1 0 1.8 1.11L7.86 10a2.03 2.03 0 0 0 .65-.07l1.55 1.55a2 2 0 1 0 3.72-.37L15.87 8H16a2 2 0 1 0-1.8-1.11L12.14 10a2.03 2.03 0 0 0-.65.07L9.93 8.52a2 2 0 1 0-3.72.37L4.13 12zM0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/>
            </svg>
        </div>
        <div class="text-3xl ml-5 font-bold">
            {{ session()->get('default_currency_symbol') }}{{ number_format($value, 2) }}   
        </div>
    </div>
</div>
