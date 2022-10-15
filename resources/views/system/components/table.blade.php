@props([
    'header',
    'body',
])

<div class="flex overflow-hidden">
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full">
                <thead>
                    {{ $header }}
                </thead>
                <tbody class="text-gray-600 text-sm">
                    {{ $body }}
                </tbody>
            </table>
        </div>
    </div>
</div>
