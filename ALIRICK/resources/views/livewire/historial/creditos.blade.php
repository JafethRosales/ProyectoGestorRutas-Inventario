<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-semibold mb-4">Historial de Créditos</h3>
        
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Orden</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Crédito</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Débito</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($creditos as $credito)
                    <tr>
                        <td class="px-6 py-4">{{ $credito->orden->id }}</td>
                        <td class="px-6 py-4">${{ number_format($credito->credito, 2) }}</td>
                        <td class="px-6 py-4">${{ number_format($credito->debito, 2) }}</td>
                        <td class="px-6 py-4">{{ $credito->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $creditos->links() }}
        </div>
    </div>
</div>
