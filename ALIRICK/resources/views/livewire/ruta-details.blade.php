<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="py-4 px-4">
        <td class="px-10 py-4">
            <button class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                <a href="/rutas/">Regresar</a>
            </button>
        </td>
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
                @forelse ($clientes as $cliente)
                <tr class="dark:bg-gray-700">
                    <td scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$cliente->formatDate}}
                    </td>
                    <td class="px-4 py-4">
                        {{$cliente->name}}
                    </td>
                    <td class="px-4 py-4 dark:text-blue-400">
                        {{$cliente->descripcion}}
                    </td>
                    <td class="px-4 py-4">
                        <button wire:click="verLista('{{$cliente->id}}', '{{$cliente->created_at}}')" class="align-middle rounded-full hover:bg-indigo-900 px-2 py-1 font-medium  dark:text-white">
                            Ver Lista
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-4 dark:text-blue-400">No se encontraron registros.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    @if($lista)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center overflow-y:auto">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg overflow-y:auto">
            <h2 class="text-lg text-white font-bold">Lista de Productos</h2>
            <p class="text-white">Productos comprados por el cliente {{$nombre}}:</p>
            <div>
                <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
                        <tr>
                            @foreach ($atributosLista as $index => $atributo)
                            <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 2) rounded-tr-lg @endif           px-4 py-3 ">
                                {{$atributo}}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                        <tr class="dark:bg-gray-600">
                            <td class="px-4 py-4 dark:text-white">
                                {{$producto->producto}}
                            </td>
                            <td class="px-4 py-4 dark:text-white">
                                {{$producto->precio_base}}
                            </td>
                            <td class="px-4 py-4 dark:text-white">
                                {{$producto->cantidad}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-4 py-4 dark:text-red-300">No se encontraron registros.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end space-x-4">
                <button wire:click="cerrar" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
