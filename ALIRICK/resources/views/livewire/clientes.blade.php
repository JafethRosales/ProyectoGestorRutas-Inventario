<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg pt-1 pb-10 px-10 ">
    <div class="py-4">
        <td class="px-6 py-4">
            <button wire:click='confirmEditar(true)' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
                Nuevo Registro</button>
        </td>
        
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
        @if (session()->has('success'))
            <div class="px-2 pt-4 alert alert-success text-white">{{ session('success') }}</div>
        @endif
    </div> 
    
    <div >
    <table class="table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
            <tr>
                @foreach ($atributosTabla as $index => $atributo)
                <th scope="col" class="border border-gray-800 @if($index == 0) rounded-tl-lg @elseif($index == 9) rounded-tr-lg @endif           px-6 py-3 ">
                    {{$atributo}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-900">
                <td scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$cliente->name}}
                </td>
                <td class="px-2 py-4">
                    {{$cliente->calle_numero}} {{$cliente->colonia}} {{$cliente->codigo_postal}}
                </td>
                <td class="px-2 py-4">
                    {{$cliente->credito}}
                </td>
                <td class="px-2 py-4">
                    {{$cliente->limite_credito}}
                </td>
                <td class="px-2 py-4">
                    {{$cliente->codigo}}
                </td>
                </td>
                <td class="px-2 py-4">
                    {{$cliente->formatDate}}
                </td>
                <td class="px-2 py-4">
                    <button wire:click="confirmLimite({{$cliente->id}})"  class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-4 hover:bg-indigo-950 text-gray-400  rounded-full">
                        Modificar</button>
                </td>
                <td class="px-2 py-4">
                    <button wire:click="confirmVisits({{$cliente->id}})"  class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg style="color: rgb(22, 22, 21);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#241c27" class="bi bi-calendar2-day" viewBox="0 0 16 16"> <path d="M4.684 12.523v-2.3h2.261v-.61H4.684V7.801h2.464v-.61H4v5.332h.684zm3.296 0h.676V9.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a1.806 1.806 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98v4.105zm2.805-5.093c0 .238.192.425.43.425a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43zm.094 5.093h.672V8.418h-.672v4.105z" fill="#241c27"></path> <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" fill="#241c27"></path> <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" fill="#241c27"></path> </svg>
                    </button>
                </td>
                </td>
                <td class="p-4">
                    <button wire:click="confirmEditar({{$cliente->id}})" class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg class="w-7 h-7 " style="fill:#241c27;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.71,16.71l-2.42-2.42a1,1,0,0,0-1.42,0l-3.58,3.58a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1h2.42a1,1,0,0,0,.71-.29l3.58-3.58A1,1,0,0,0,20.71,16.71ZM16,20H15V19l2.58-2.58,1,1Zm-6,0H6a1,1,0,0,1-1-1V5A1,1,0,0,1,6,4h5V7a3,3,0,0,0,3,3h3v1a1,1,0,0,0,2,0V9s0,0,0-.06a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0L12.06,2H6A3,3,0,0,0,3,5V19a3,3,0,0,0,3,3h4a1,1,0,0,0,0-2ZM13,5.41,15.59,8H14a1,1,0,0,1-1-1ZM8,14h6a1,1,0,0,0,0-2H8a1,1,0,0,0,0,2Zm0-4H9A1,1,0,0,0,9,8H8a1,1,0,0,0,0,2Zm2,6H8a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z" fill="#241c27"></path></svg>
                    </button>
                </td>

                <td class="p-4 ">
                    <button wire:click="confirmDelete({{ $cliente->id }})"  class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg class="w-7 h-7" style="color: rgb(165, 162, 147);" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-k</title><path d="M432,144,403.33,419.74A32,32,0,0,1,371.55,448H140.46a32,32,0,0,1-31.78-28.26L80,144" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" fill="#a5a293"></path><rect x="32" y="64" width="448" height="80" rx="16" ry="16" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect><line x1="312" y1="240" x2="200" y2="352" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="312" y1="352" x2="200" y2="240" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    
    @if ($limite)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg">
            <h2 class="text-lg font-bold text-white">Modificar Límite de Crédito</h2>
            <p class="text-white">Esta acción cambiará el límite de crédito de {{$deleteName}}.</p>
            <form>
                <h4 for="limite_credito" class="text-white font-bold">Nuevo monto</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" step="0.01" type="number" name='limite_credito' wire:model='limite_credito' id="limite_credito">
            </form>
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelLimite" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="modificarLimite" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif

    @if ($editar)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg w-2/5">
            <h2 class="text-white text-lg font-bold">Nuevos Datos</h2>
            <p class="text-white font-bold">Ingresa los nuevos datos del cliente:</p>
            <form>
                <h4 for="name" class="text-white font-bold">Nombre</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" type="text" name='name' wire:model='name' id="name">
                <h4 for="calle_numero" class="text-white font-bold">Calle y Número</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" type="text" name='calle_numero' wire:model='calle_numero' id="calle_numero">
                <h4 for="colonia" class="text-white font-bold">Colonia</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" type="text" name='colonia' wire:model='colonia' id="colonia">
                <h4 for="codigo_postal" class="text-white font-bold">Código Postal</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" type="text" name='codigo_postal' wire:model='codigo_postal' id="codigo_postal">
                <h4 for="codigo" class="text-white font-bold">Código de Cliente</h4>
                <input class="text-white dark:bg-gray-800 mt-2 w-full rounded-lg border-gray-600 shadow-sm p-3 h-10" type="text" name='codigo' wire:model='codigo' id="codigo">
            </form>
            

            <div class="flex justify-end space-x-4">
                <button wire:click="cancelEditar" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="editarCliente" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif


    @if ($delete)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg">
            <h2 class="text-lg text-white font-bold">Eliminar Usuario</h2>
            <p class="text-white">¿Estás Seguro? Esta acción eliminará a {{$deleteName}} de la plataforma.</p>
            
            <div class="flex justify-end space-x-4">
                <button wire:click="cancelDelete" class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                    Cancelar
                </button>
                <button wire:click="deleteCliente" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif


    @if($visitas)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex flex-col gap-8 items-center justify-center">
        <div class="dropdown-container bg-gray-700 rounded-lg p-6 shadow-lg overflow-y:auto w-3/5">    
            <!-- Search Bar -->
            <input type="text" wire:model.live="search" placeholder="Días de Visita..." class="rounded-lg form-input w-full">

            @if ($selectedDays)
                <!-- Search Results -->
            <ul>
                @forelse($selectedDays as $item)
                    <li>
                        <button wire:click="addItem({{ $item->id}})" class="w-full text-white pt-2">
                            {{ $item->dia }} 
                        </button>
                    </li>
                @empty
                    <li class="text-red-400 pt-6 px-6 pb-2"> 
                        No hay coincidencias
                    </li>
                @endforelse 
            </ul>
            @endif
        </div>
        
       
        <div class="bg-gray-700 rounded-lg p-6 shadow-lg overflow-y:auto w-4/5 ">
        <!-- Sale List -->
        <h3 class="text-white pb-4">Días de Visita</h3>
        @if($items)
            <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400" >
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
                    <tr>
                        <th class="border border-gray-800 rounded-tl-lg  px-4 py-3">Día</th>
                        <th class="border border-gray-800 rounded-tl-lg  px-4 py-3">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $index => $item)
                        <tr>
                            <td class="p-4">{{ $item['dia'] }}</td>
                           
                            <td>
                                <button wire:click="removeItem({{ $index }})"  class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg class="w-7 h-7" style="color: rgb(165, 162, 147);" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-k</title><path d="M432,144,403.33,419.74A32,32,0,0,1,371.55,448H140.46a32,32,0,0,1-31.78-28.26L80,144" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" fill="#a5a293"></path><rect x="32" y="64" width="448" height="80" rx="16" ry="16" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect><line x1="312" y1="240" x2="200" y2="352" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="312" y1="352" x2="200" y2="240" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
        <!-- Actions -->
        <div>
            <button class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900" wire:click="cancelVisits">Cancelar</button>
            <button class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" wire:click="saveVisits">Asignar Días</button>
        </div>
    </div>
    @endif

</div>