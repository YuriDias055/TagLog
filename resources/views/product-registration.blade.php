@if(session('success'))
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md text-center">
            <p>{{ session('success') }}</p>
            <button onclick="document.getElementById('success-popup').style.display='none'" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">OK</button>
        </div>
    </div>
@endif

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Pacotes') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
    <form method="POST" action="{{ route('produtos.store') }}" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 w-120">
            @csrf
            <div class="mb-4">
                <x-input-label for="codigo" :value="__('Código')" />
                <x-text-input id="codigo" class="block mt-1 w-full" type="number" name="codigo" :value="old('codigo')"  autofocus autocomplete="codigo" />
                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="rua" :value="__('Rua')" />
                <x-text-input id="rua" class="block mt-1 w-full" type="text" name="rua" :value="old('rua')"  autofocus autocomplete="rua" />
                <x-input-error :messages="$errors->get('rua')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="bairro" :value="__('Bairro')" />
                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')"  autofocus autocomplete="bairro" />
                <x-input-error :messages="$errors->get('bairro')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="numero" :value="__('Número')" />
                <x-text-input id="numero" class="block mt-1 w-full" type="number" name="numero" :value="old('numero')"  autofocus autocomplete="numero" />
                <x-input-error :messages="$errors->get('numero')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="cidade" :value="__('Cidade')" />
                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="cidade" :value="old('cidade')"  autofocus autocomplete="cidade" />
                <x-input-error :messages="$errors->get('cidade')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="estado" :value="__('Estado')" />
                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="estado" :value="old('estado')"  autofocus autocomplete="estado" />
                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="estado_da_entrega" :value="__('Estado da entrega')" />
                    <div class="mt-1">
                        <label class="block">
                            <x-text-input id="estado_pendente" type="radio" name="estado_da_entrega" value="pendente" :checked="old('estado_da_entrega') === 'pendente'" checked/>
                            <span class="ml-2">Pendente</span>
                        </label>

                        <label class="block mt-2">
                            <x-text-input id="estado_fila" type="radio" name="estado_da_entrega" value="na fila" :checked="old('estado_da_entrega') === 'na fila'" />
                            <span class="ml-2">Na Fila</span>
                        </label>

                        <label class="block mt-2">
                            <x-text-input id="estado_andamento" type="radio" name="estado_da_entrega" value="Em andamento" :checked="old('estado_da_entrega') === 'Em andamento'" />
                            <span class="ml-2">Em andamento</span>
                        </label>

                        <label class="block mt-2">
                            <x-text-input id="estado_entregue" type="radio" name="estado_da_entrega" value="Entregue" :checked="old('estado_da_entrega') === 'Entregue'" />
                            <span class="ml-2">Entregue</span>
                        </label>
                    </div>
                <x-input-error :messages="$errors->get('estado_da_entrega')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end ">
                <x-primary-button>
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
