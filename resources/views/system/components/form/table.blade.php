<table  {{ $attributes->merge(['class' => 'w-full']) }}>
    <thead class="">
        <tr class="bg-gray-300">
            {{ $head }}
        </tr>
    </thead>
    <tbody class="bg-gray-200">
        {{ $body }}
    </tbody>
</table>
