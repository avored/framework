<div class="md:w-1/3 sm:w-full cursor-pointer bg-purple-500 mr-5 mt-5 border text-center b-gray-400 rounded items-center p-6 text-white">
    <div class="text-md border-b pb-3 font-bold w-full">
        <span class="uppercase">
            {{ __('avored::system.total-order') }}
        </span>
    </div>
    <div class="flex mt-5 text-center justify-around items-center">
        <div class="w-12 h-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 6V4H2v2h16zm0 4H2v6h16v-6zM0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm4 8h4v2H4v-2z"/>
            </svg>
           
        </div>
        <div class="text-3xl ml-5 font-bold">
            {{ $value }}   
        </div>
    </div>
</div>
