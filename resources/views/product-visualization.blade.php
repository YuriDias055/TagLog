<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Visualizar Pacotes') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ isOpen: false, produto: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <!-- Filtro de Estado da Entrega -->
                    <form method="GET" action="{{ route('product-visualization') }}" class="mb-4">
                        <div class="flex items-center">
                            <label for="estado_da_entrega" class="mr-2 text-gray-800 dark:text-gray-200">Filtrar por Estado da Entrega:</label>
                            <select name="estado_da_entrega" id="estado_da_entrega" class="border border-gray-300 dark:border-gray-600 rounded p-2 text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-700">
                                <option value="">Todos</option>
                                <option value="pendente" {{ $estadoDaEntrega == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="na fila" {{ $estadoDaEntrega == 'na fila' ? 'selected' : '' }}>Na Fila</option>
                                <option value="em andamento" {{ $estadoDaEntrega == 'em andamento' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="entregue" {{ $estadoDaEntrega == 'entregue' ? 'selected' : '' }}>Entregue</option>
                            </select>
                            <button type="submit" 
                                class="ml-4 inline-flex items-center px-2 py-2 bg-gray-800 dark:bg-gray-600 text-white border-none rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 transition-colors duration-300">
                                Filtrar
                            </button>
                        </div>
                    </form>

                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">Código</th>
                                <th class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">Estado da Entrega</th>
                                <th class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">{{ $produto->codigo }}</td>
                                    <td class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">{{ $produto->estado_da_entrega }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <!-- Botão para abrir o modal com as informações do pacote -->
                                        <button 
                                            class="inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-600 text-white border-none rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 transition-colors duration-300"
                                            @click="isOpen = true; produto = {{ $produto }}"
                                        >
                                            Visualizar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Links de Paginação -->
                    <div class="mt-4">
                        {{ $produtos->links() }}
                    </div>

                    <!-- Modal Pop-up -->
                    <div 
                        x-show="isOpen"
                        x-cloak
                        @keydown.escape.window="isOpen = false"
                        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50"
                    >
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Detalhes do Pacote</h3>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Código:</strong> <span x-text="produto.codigo"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Rua:</strong> <span x-text="produto.rua"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Bairro:</strong> <span x-text="produto.bairro"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Número:</strong> <span x-text="produto.numero"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Cidade:</strong> <span x-text="produto.cidade"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Estado:</strong> <span x-text="produto.estado"></span>
                            </div>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Estado da Entrega:</strong> <span x-text="produto.estado_da_entrega"></span>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="flex justify-end mt-4">
                                <button 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded"
                                    @click="isOpen = false">
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
