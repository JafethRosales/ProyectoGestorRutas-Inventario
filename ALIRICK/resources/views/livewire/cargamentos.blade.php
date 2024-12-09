<div class="h-screen relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg py-10 px-10 flex flex-col items-center gap-8">
    <div class="dropdown-container bg-gray-700 rounded-lg p-6 shadow-lg overflow-y:auto w-3/5">
        <!-- Search Bar -->
        <input type="text" wire:model.live="search" placeholder="Buscar productos..." class="rounded-lg form-input w-full">

        <!-- Search Results -->
        @if($inventarios)
        <ul >
            @forelse($inventarios as $item)
                <li>
                    <button wire:click="addItem({{ $item->id }})" class="text-white pt-2 w-full">
                        {{ $item->nombre }} 
                        <p class="text-xs text-green-300">Stock: {{ $item->existencias }} pzas.</p>
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

    <div class="bg-gray-700 rounded-lg p-6 shadow-lg overflow-y:auto w-full ">
    <!-- Selected Items List -->
    <h3 class="text-white">Lista de Productos:</h3>
    @if($items)
        <table class="overflow-x:auto table-auto w-full rounded-lg border-separate border-spacing-0 shadow-lg        min-w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400 ">
                <tr>
                    <th class="border border-gray-800 rounded-tl-lg  px-4 py-3 ">Producto</th>
                    <th class="border border-gray-800 px-4 py-3 ">Cantidad</th>
                    <th class="border border-gray-800 px-4 py-3 ">Stock</th>
                    <th class="border border-gray-800 rounded-tr-lg px-4 py-3 ">Remover</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                    <tr >
                        <td class="p-4">{{ $item['nombre'] }}</td>
                        <td>
                            <input class="rounded-lg w-1/5 text-gray-600" type="number" wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                   value="{{ $item['cantidad'] }}" min="1" max="{{ $item['existencias'] }}">
                        </td>
                        <td>{{ $item['existencias'] }}</td>
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

    @if ($mostrarConfirmacion)
    <div class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-gray-700 rounded-lg p-6 space-y-4 shadow-lg">
            <h2 class="text-lg text-white font-bold">Ruta Abierta</h2>
            <p class="text-white">Existe una ruta en curso, ¿Deseas cargar más productos?</p>
            
            <div class="flex justify-end space-x-4">
                <button class="py-2.5 px-5 ms-3 text-sm font-medium text-white  bg-white rounded-lg  hover:bg-gray-100 hover:text-blue-700 focus:z-10  dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900">
                   <a href="/visitas/">Volver a Visitas</a>
                </button>
                <button wire:click="cerrarValidacion(false)" class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Save Button -->
    <button class="text-white bg-red-600 hover:bg-red-800   font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" wire:click="save">Validar Cargamento</button>

    <!-- Feedback Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success text-white">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger text-white">{{ session('error') }}</div>
    @endif
</div>
