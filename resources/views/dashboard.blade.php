<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <!-- Cards Informativos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quantidade Total de Pacotes</h4>
                <p class="text-2xl text-gray-600 dark:text-gray-400">1,234</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quantidade Total de Pacotes na Fila</h4>
                <p class="text-2xl text-gray-600 dark:text-gray-400">$12,345</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quantidade Total de Pacotes Entregues</h4>
                <p class="text-2xl text-gray-600 dark:text-gray-400">87</p>
            </div>
        </div>

        <!-- Gráfico -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Informações de Pacotes</h3>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mt-4 flex justify-center items-center w-120 mx-auto"> <!-- Contêiner reduzido -->
            <canvas id="salesChart" class="w-48 h-48"></canvas> 
        </div>
    </div>

    <!-- Script para Gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'pie', 
                data: {
                    labels: ['Pendente', 'Na Fila', 'Em Andamento', 'Entregue'], // Rótulos do gráfico
                    datasets: [{
                        label: 'Distribuição de Vendas',
                        data: [3000, 5000, 2000, 4000], // Dados das vendas
                        backgroundColor: [
                            'yellow', 
                            'blue', 
                            'orange', 
                            'green'  
                        ],
                        borderColor: [
                            'black', 
                            'black', 
                            'black', 
                            'black'  
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': $' + tooltipItem.raw; 
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
