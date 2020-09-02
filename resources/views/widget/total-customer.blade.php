<div class="md:w-1/3 sm:w-full cursor-pointer bg-red-600 mr-5 mt-5 border text-center b-gray-400 rounded items-center p-6 text-white">
    <div class="text-md border-b pb-3 font-bold w-full">
        <span class="uppercase">
            {{ __('avored::system.total-customer') }}
        </span>
    </div>
    <div class="flex mt-5 text-center justify-around items-center">
        <div class="w-12 h-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"/>
            </svg>
        </div>
        <div class="text-3xl ml-5 font-bold">
            {{ $value }}   
        </div>
    </div>
</div>
