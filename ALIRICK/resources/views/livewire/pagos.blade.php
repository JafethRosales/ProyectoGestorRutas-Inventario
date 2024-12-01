<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="py-4 px-4">
        @if($todos)
        <td class="px-10 py-4">
            <button wire:click='onlyCreditos' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Créditos Activos</button>
        </td>
        @elseif (!$todos)
        <td class="px-10 py-4">
            <button wire:click='allCredit' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Todos los Registros</button>
        </td>
        @endif
    </div> 
    
    <div>
    <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
            <tr>
                @foreach ($atributosTabla as $index => $atributo)
                <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 3) rounded-tr-lg @endif           px-4 py-3 ">
                    {{$atributo}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($pagos as $pago)
            <tr class="dark:bg-gray-700">
                <td scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$pago->name}}
                </td>
                <td class="px-4 py-4">
                    {{$pago->credito}}
                </td>
                <td class="px-4 py-4">
                    {{$pago->monto}}
                </td>
                <td class="px-4 py-4">
                    {{$pago->formatDate}}
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
