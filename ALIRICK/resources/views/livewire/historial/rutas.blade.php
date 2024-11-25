<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Historial de Rutas</h3>
        
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Vendedor</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Hora Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Hora Término</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Venta Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Créditos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rutas as $ruta)
                    <tr>
                        <td class="px-6 py-4">{{ $ruta->user->name }}</td>
                        <td class="px-6 py-4">{{ $ruta->hora_inicio }}</td>
                        <td class="px-6 py-4">{{ $ruta->hora_termino }}</td>
                        <td class="px-6 py-4">${{ number_format($ruta->venta_total, 2) }}</td>
                        <td class="px-6 py-4">
                            <div>Recuperado: ${{ number_format($ruta->credito_recuperado, 2) }}</div>
                            <div>Generado: ${{ number_format($ruta->credito_generado, 2) }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $rutas->links() }}
        </div>
    </div>
</div>
