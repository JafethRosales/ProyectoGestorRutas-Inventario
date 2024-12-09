<div class="h-screen relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="pt-6">
        @if (!$rutaAbierta)
        <td class="px-6 py-4">
            <button wire:click='abrirRuta' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Comenzar Ruta
            </button>
        </td>
        @endif
        @if ($rutaAbierta)
        <td class="px-6 py-4">
            <button wire:click='cerrarRuta' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Terminar Ruta
            </button>
        </td>
        @endif
         <!-- Feedback -->
        @if (session()->has('success'))
            <div class="px-2 pt-4 alert alert-success text-white">{{ session('success') }}</div>
        @endif

        @if (session()->has('error'))
            <div class="px-2 pt-4 alert alert-danger text-white">{{ session('error') }}</div>
        @endif
    </div>

    @if ($rutaAbierta)
    <div class="py-8 px-6">
        <table class="table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
                <tr>
                    @foreach ($atributosTabla as $index => $atributo)
                    <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 7) rounded-tr-lg @endif           px-6 py-3 ">
                        {{$atributo}}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-900">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$cliente->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$cliente->domicilio}} 
                    </td>
                    <td class="px-6 py-4">
                        {{$cliente->credito}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="abrirVenta({{$cliente->cliente_id}})"  class="text-green-300 align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-indigo-950 text-gray-400  rounded-full">
                            Ventas
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="confirmPagos({{$cliente->cliente_id}})"  class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-indigo-950 text-gray-400  rounded-full">
                            Pagos
                        </button>
                    </td>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="confirmCredito({{$cliente->cliente_id}})"  class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-indigo-950 text-gray-400  rounded-full">
                            Dar Crédito
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="confirmIncidencia({{$cliente->cliente_id}})"  class="align-middle  text-blue-300 font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-indigo-950 text-gray-400  rounded-full">
                            Incidencia
                        </button>
                    </td>
                    </td>
                    <td class="p-4">
                        <button  class="font-sans @if($cliente->visitado) bg-green-500 @else bg-red-500 @endif align-middle  text-blue-300 font-sans font-bold text-center uppercase transition-all text-xs py-2 px-3  text-gray-400  rounded-full">
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-6 py-4 text-white">
                        Sin registros
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endif

    @if ($pagos)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg w-2/5">
            <h2 class="text-white text-lg font-bold">Registrar Pagos</h2>
            <p class="text-white font-bold">Ingresa el monto del pago del cliente {{$clienteName}}:</p>
            <form>
                <h4 for="monto" class="text-white font-bold">Cantidad</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" step="0.01" type="number" name='monto' wire:model='monto' id="monto">
            </form>
            

            <div class="flex justify-end space-x-4">
                <button wire:click="cancelPagos" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="hacerPagos" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif

    @if ($creditos)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg w-2/5">
            <h2 class="text-white text-lg font-bold">Dar Crédito</h2>
            <p class="text-white font-bold">Ingresa el monto de la compra que quedará a crédito:</p>
            <form>
                <h4 for="monto" class="text-white font-bold">Cantidad</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" step="0.01" type="number" name='monto' wire:model='monto' id="monto">
            </form>
            

            <div class="flex justify-end space-x-4">
                <button wire:click="cancelCredito" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="hacerCredito" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif

    @if ($incidencia)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg w-2/5">
            <h2 class="text-white text-lg font-bold">Registro de Visita</h2>
            <p class="text-white font-bold">Ingresa la razón de no venta a {{$clienteName}}:</p>
            <form>
                <h4 for="descripcion" class="text-white font-bold">Motivo</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10"  type="text" name='descripcion' wire:model='descripcion' id="descripcion">
            </form>
            

            <div class="flex justify-end space-x-4">
                <button wire:click="cancelIncidencia" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="hacerIncidencia" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif







    @if($ventas)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="dropdown-container bg-gray-700 rounded-lg p-6 shadow-lg overflow-y:auto w-3/5">    
            <!-- Search Bar -->
            <input type="text" wire:model.live="search" placeholder="Buscar productos..." class="rounded-lg form-input w-full">

            @if ($inventario)
                <!-- Search Results -->
            <ul>
                @forelse($inventario as $item)
                    <li>
                        <button wire:click="addItem({{ $item->producto_id }})" class="w-full text-white pt-2">
                            {{ $item->nombre }} 
                            <p class="text-xs text-green-300">Stock: {{ $item->existencias_vehiculo }} pzas.</p>
                        </button>
                    </li>
                @empty
                    <li class="text-red-400 p-2"> 
                        No hay coincidencias
                    </li>
                @endforelse 
            </ul>
            @endif
        </div>
        
        @if (session()->has('errorList'))
            <div class=" px-2 pt-4 alert alert-errorList text-white">{{ session('errorList') }}</div>
        @endif


        <!-- Sale List -->
        <h3>Sale List</h3>
        @if($items)
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Existencias</th>
                        <th>Retirar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                        <tr>
                            <td>{{ $item['nombre'] }}</td>
                            <td>
                                <input type="number" wire:change="updateQuantity({{ $index }}, $event.target.value)" value="{{ $item['cantidad'] }}" min="1" max="{{ $item['existencias_vehiculo'] }}">
                            </td>
                            <td>{{ $item['existencias_vehiculo'] }}</td>
                            <td>
                                <button wire:click="removeItem({{ $index }})">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <!-- Actions -->
        <button class="text-white" wire:click="save">Complete Sale</button>
    </div>
    @endif


    

   
</div>
