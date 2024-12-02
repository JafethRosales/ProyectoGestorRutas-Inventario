<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="py-4 px-4">
        <td class="px-10 py-4">
            <button wire:click='' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Filtrar por Día</button>
        </td>
        <td class="px-10 py-4">
            <button wire:click='' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Filtrar por Producto</button>
        </td>
    </div> 
    
    <div>
    <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
            <tr>
                @foreach ($atributosTabla as $index => $atributo)
                <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 4) rounded-tr-lg @endif           px-4 py-3 ">
                    {{$atributo}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($ventas as $venta)
            <tr class="dark:bg-gray-700">
                <td scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$venta->producto}}
                </td>
                <td class="px-4 py-4">
                    {{$venta->precio_base}}
                </td>
                <td class="px-4 py-4">
                    {{$venta->unidades}}
                </td>
                <td class="px-4 py-4">
                    {{$venta->total}}
                </td>
                <td class="px-4 py-4">
                    {{$venta->fecha}}
                </td>
            </tr>
            @empty
            <tr>
                <td class="px-4 py-4">No se encontraron registros.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
