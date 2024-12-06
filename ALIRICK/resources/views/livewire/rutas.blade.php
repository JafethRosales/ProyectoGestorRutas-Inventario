<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="py-4 px-4">
        <td class="px-10 py-4">
            <button wire:click='' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Filtrar por Día
            </button>
        </td>
    </div> 
    
    <div>
    <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
            <tr>
                @foreach ($atributosTabla as $index => $atributo)
                <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 8) rounded-tr-lg @endif           px-4 py-3 ">
                    {{$atributo}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rutas as $ruta)
            <tr class="dark:bg-gray-700">
                <td scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$ruta->formatDate}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->hora_inicio}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->hora_termino}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->total}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->credito_recuperado}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->credito_generado}}
                </td>
                <td class="px-4 py-4">
                    {{$ruta->descuentos}}
                </td>
                <td class="px-4 py-4 dark:text-red-400">
                    {{$ruta->liquidar}}
                </td>
                <td class="px-4 py-4">
                    <button class="align-middle rounded-full hover:bg-indigo-900 px-2 py-1 font-medium  dark:text-white">
                        <a href="{{ route('rutas.show', $ruta->id) }}">Ver Clientes</a>
                    </button>
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
