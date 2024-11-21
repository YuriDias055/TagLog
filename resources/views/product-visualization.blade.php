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

                    <form method="GET" action="{{ route('product-visualization') }}">
                        <label for="estado_da_entrega" class="mr-2 text-gray-800 dark:text-gray-200">Filtrar por Estado da Entrega:</label>
                        <select name="estado_da_entrega" id="estado_da_entrega" class="border border-gray-300 dark:border-gray-600 rounded p-2 text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-700">
                            <option value="">Todos</option>
                            @foreach ($estadoMap as $key => $value)
                                <option value="{{ $key }}" {{ request('estado_da_entrega') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-4 inline-flex items-center px-2 py-2 bg-gray-800 dark:bg-gray-600 text-white border-none rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 transition-colors duration-300">
                            Filtrar
                        </button>
                    </form>

                    <table class="min-w-full bg-white dark:bg-gray-800 mt-4">
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
                                    <td class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">{{ $produto->code }}</td>
                                    <td class="py-2 px-4 border-b text-center text-gray-800 dark:text-gray-200">{{ $produto->state }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <button 
                                            class="inline-flex items-center px-2 py-1 bg-gray-800 dark:bg-gray-600 text-white border-none rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 transition-colors duration-300"
                                            @click="isOpen = true; produto = { 
                                                code: '{{ $produto->code }}', 
                                                rua: '{{ $produto->endereco->rua ?? '' }}', 
                                                bairro: '{{ $produto->endereco->bairro ?? '' }}', 
                                                numero: '{{ $produto->endereco->numero ?? '' }}', 
                                                cidade: '{{ $produto->endereco->cidade ?? '' }}', 
                                                estado: '{{ $produto->endereco->estado ?? '' }}', 
                                                state: '{{ $produto->state }}' 
                                            }"
                                        >
                                            Visualizar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $produtos->links() }}
                    </div>

                    <!-- Modal Pop-up -->
                    <div 
                        x-show="isOpen"
                        x-cloak
                        @keydown.escape.window="isOpen = false"
                        class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50 transition-opacity duration-300"
                    >
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-lg">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Detalhes do Pacote</h3>
                            <div class="mb-2 text-gray-800 dark:text-gray-200">
                                <strong>Código:</strong> <span x-text="produto.code"></span>
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
                                <strong>Estado da Entrega:</strong> <span x-text="produto.state"></span>
                            </div>

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
