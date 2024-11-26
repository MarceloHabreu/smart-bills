<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grid para os cards de contagem -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card: Total de Contas Registradas -->
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-6 py-4 rounded relative">
                    <strong class="font-bold text-lg">Total de Contas Registradas:</strong>
                    <span class="block text-2xl font-bold sm:inline" id="total-contas-registradas">{{ $totalAccounts }}</span>
                </div>

                <!-- Card: Contas Pendentes -->
                <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded relative">
                    <strong class="font-bold text-lg">Contas Pendentes Deste Mês:</strong>
                    <span class="block text-2xl font-bold sm:inline" id="contas-pendentes">{{ $quantityPending }}</span>
                </div>

                <!-- Card: Contas Pagas -->
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded relative">
                    <strong class="font-bold text-lg">Contas Pagas Este Mês:</strong>
                    <span class="block text-2xl font-bold sm:inline" id="contas-pagas">{{ $quantityPaid }}</span>
                </div>

                <!-- Card: Total Gasto -->
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-2 rounded relative">
                    <strong class="font-bold text-lg">Total Gasto Este Mês:</strong>
                    <span class="block text-2xl font-bold sm:inline" id="total-gasto">R$ {{ number_format($totalSpent, 2, ',', '.') }}</span>
                </div>
            </div>

            <!-- Grid para os cards de contas urgentes e atrasadas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Card: Contas Urgentes -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-orange-600 flex justify-center items-center">Contas Urgentes</h3>
                        <ul class="mt-2 space-y-4 max-h-96 overflow-y-auto">
                            @forelse ($urgentAccounts as $account)
                                <li class="flex flex-col bg-orange-50 px-6 py-4 rounded-lg shadow-sm hover:bg-orange-100">
                                    <div class="flex justify-between items-center">
                                        <span class="text-orange-700 font-medium text-lg">{{ $account->name }}</span>
                                        <span class="text-gray-900 font-semibold text-lg">{{ 'R$ ' . number_format($account->value, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-red-600 font-semibold">Vencimento: {{ \Carbon\Carbon::parse($account->due_date)->format('d/m/Y') }}</span>
                                        <span class="text-sm text-blue-600 font-semibold bg-blue-100 px-2 py-1 rounded">Esta conta está próxima do seu vencimento</span>
                                    </div>
                                </li>
                            @empty
                                <div class="flex justify-center items-center bg-orange-50 px-6 py-4 rounded-lg shadow-sm">
                                    <span class="text-sm text-blue-600 font-semibold bg-blue-100 px-2 py-1 rounded">Sem contas urgentes. Você está em dia!</span>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Card: Contas Atrasadas -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-orange-600 flex justify-center items-center">Contas Atrasadas</h3>
                        <ul class="mt-2 space-y-4 max-h-96 overflow-y-auto">
                            @forelse ($overdueAccounts as $account)
                                <li class="flex flex-col bg-orange-50 px-6 py-4 rounded-lg shadow-sm hover:bg-orange-100">
                                    <div class="flex justify-between items-center">
                                        <span class="text-orange-700 font-medium text-lg">{{ $account->name }}</span>
                                        <span class="text-gray-900 font-semibold text-lg">{{ '' . 'R$ ' . number_format($account->value, 2, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-red-600 font-semibold">Vencimento: {{ \Carbon\Carbon::parse($account->due_date)->format('d/m/Y') }}</span>
                                        <span class="text-sm text-blue-600 font-semibold bg-blue-100 px-2 py-1 rounded">Não fique devendo!</span>
                                    </div>
                                </li>
                            @empty
                                <div class="flex justify-center items-center bg-orange-50 px-6 py-4 rounded-lg shadow-sm">
                                    <span class="text-sm text-blue-600 font-semibold bg-blue-100 px-2 py-1 rounded">Sem contas atrasadas. Excelente trabalho!</span>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Gráfico -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-6 col-span-1 lg:col-span-4">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 flex justify-center items-center">Gráfico de Contas</h3>
                    <div class="mt-4 flex justify-center items-center" style="height: 400px;">
                        <canvas id="myChart" class="w-full h-full"></canvas>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                        datasets: [{
                            label: 'Total de Contas Pagas',
                            // Passando os dados do array mensal para o gráfico
                            data: @json($monthlyPayments),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

        </div>
    </div>
</x-app-layout>
