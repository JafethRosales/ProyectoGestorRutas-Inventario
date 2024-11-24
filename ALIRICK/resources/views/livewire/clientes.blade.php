<div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg py-10 px-10 ">
    <td class="px-6 py-4">
        <button wire:click='confirmEditar(true)' type="button" class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-blue-800 bg-indigo-950 text-white rounded-full">
            Nuevo Registro</button>
    </td>
    <table class="min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
            <tr>
                @foreach ($atributosTabla as $atributo)
                <th scope="col" class="px-6 py-3 ">
                    {{$atributo}}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr class="bg-white border-b dark:bg-gray-700 dark:border-gray-900">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$cliente->name}}
                </td>
                <td class="px-6 py-4">
                    {{$cliente->calle_numero}} {{$cliente->colonia}} {{$cliente->codigo_postal}}
                </td>
                <td class="px-6 py-4">
                    {{$cliente->credito}}
                </td>
                <td class="px-6 py-4">
                    {{$cliente->limite_credito}}
                </td>
                <td class="px-6 py-4">
                    {{$cliente->codigo}}
                </td>
                </td>
                <td class="px-6 py-4">
                    {{$cliente->created_format}}
                </td>
                <td class="px-6 py-4">
                    <button wire:click="confirmLimite({{$cliente->id}})"  class="align-middle  font-sans font-bold text-center uppercase transition-all text-xs py-3 px-6 hover:bg-indigo-950 text-gray-400  rounded-full">
                        Modificar</button>
                </td>
                </td>
                <td class="p-4">
                    <button wire:click="confirmEditar({{$cliente->id}})" class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg class="w-7 h-7 " style="fill:#241c27;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.71,16.71l-2.42-2.42a1,1,0,0,0-1.42,0l-3.58,3.58a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1h2.42a1,1,0,0,0,.71-.29l3.58-3.58A1,1,0,0,0,20.71,16.71ZM16,20H15V19l2.58-2.58,1,1Zm-6,0H6a1,1,0,0,1-1-1V5A1,1,0,0,1,6,4h5V7a3,3,0,0,0,3,3h3v1a1,1,0,0,0,2,0V9s0,0,0-.06a1.31,1.31,0,0,0-.06-.27l0-.09a1.07,1.07,0,0,0-.19-.28h0l-6-6h0a1.07,1.07,0,0,0-.28-.19.32.32,0,0,0-.09,0L12.06,2H6A3,3,0,0,0,3,5V19a3,3,0,0,0,3,3h4a1,1,0,0,0,0-2ZM13,5.41,15.59,8H14a1,1,0,0,1-1-1ZM8,14h6a1,1,0,0,0,0-2H8a1,1,0,0,0,0,2Zm0-4H9A1,1,0,0,0,9,8H8a1,1,0,0,0,0,2Zm2,6H8a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z" fill="#241c27"></path></svg>
                    </button>
                </td>

                <td class="p-4">
                    <button wire:click="confirmDelete({{ $cliente->id }})"  class="align-middle text-xs rounded-full hover:bg-indigo-700 px-2 py-1 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <svg class="w-7 h-7" style="color: rgb(165, 162, 147);" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-k</title><path d="M432,144,403.33,419.74A32,32,0,0,1,371.55,448H140.46a32,32,0,0,1-31.78-28.26L80,144" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" fill="#a5a293"></path><rect x="32" y="64" width="448" height="80" rx="16" ry="16" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect><line x1="312" y1="240" x2="200" y2="352" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="312" y1="352" x2="200" y2="240" style="fill:none;stroke:#241c27;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
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
</div>