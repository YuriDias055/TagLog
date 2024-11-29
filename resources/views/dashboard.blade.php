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
                <p class="text-2xl text-gray-600 dark:text-gray-400">{{ $totalPacotes }}</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quantidade Total de Pacotes na Fila</h4>
                <p class="text-2xl text-gray-600 dark:text-gray-400">{{ $pacotesNaFila }}</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quantidade Total de Pacotes Entregues</h4>
                <p class="text-2xl text-gray-600 dark:text-gray-400">{{ $pacotesEntregues }}</p>
            </div>
        </div>

    <!-- Gráfico -->
    <div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Informações de Pacotes</h3>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mt-4 w-full mx-auto" style="height: 400px;"> 
        <!-- Contêiner do Gráfico -->
        <canvas id="salesChart" class="w-full h-full"></canvas> <!-- Canvas Flexível -->
    </div>
</div>

<!-- Adicionando Script para o Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');

        // Dados dinâmicos vindos do servidor
        const dataLabels = @json(array_keys($dadosGrafico)); // Ex.: ['Pendente', 'Na Fila', 'Em Andamento', 'Entregue']
        const dataValues = @json(array_values($dadosGrafico)); // Ex.: [3000, 5000, 2000, 4000]

        const salesChart = new Chart(ctx, {
            type: 'pie', 
            data: {
                labels: dataLabels, // Rótulos dos estados
                datasets: [{
                    label: 'Distribuição de Pacotes',
                    data: dataValues, // Dados dos pacotes
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
                responsive: true, // Ativa a responsividade
                maintainAspectRatio: false, // Ajusta o gráfico ao contêiner
                plugins: {
                    legend: {
                        position: 'top', // Legenda no topo
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                const value = tooltipItem.raw; // Valor do item
                                const label = tooltipItem.label || ''; // Nome do rótulo
                                return `${label}: ${value} pacotes`; // Texto no tooltip
                            }
                        }
                    }
                }
            }
        });
    });
</script>


</x-app-layout>
