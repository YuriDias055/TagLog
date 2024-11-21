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
            <x-text-input id="codigo" class="block mt-1 w-full" type="text" name="code" :value="old('code')" autofocus autocomplete="codigo" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <select name="addressId" id="endereco" class="block mt-1 w-full border border-gray-300 dark:border-gray-600 rounded p-2 text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-700">
                @foreach($enderecos as $endereco)
                    <option value="{{ $endereco->id }}" {{ old('addressId') == $endereco->id ? 'selected' : '' }}>
                        {{ $endereco->street }}, {{ $endereco->district }} - {{$endereco -> num}} - {{ $endereco->city }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('addressId')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="descricao" :value="__('Descrição')" />
            <textarea id="descricao" name="description" rows="4" class="block mt-1 w-full border border-gray-300 dark:border-gray-600 rounded p-2 text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-700">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <input type="hidden" name="state" value="P" /> <!-- Estado 'P' por padrão -->

        <div class="flex items-center justify-end">
            <x-primary-button>
                {{ __('Cadastrar Pacote') }}
            </x-primary-button>
        </div>
    </form>
</div>


    <div class="py-6 px-4 sm:px-6 lg:px-8 flex justify-center">
        <form method="POST" action="{{ route('enderecos.store') }}" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4 w-120">
            @csrf
            <div class="mb-4">
                <x-input-label for="rua" :value="__('Rua')" />
                <x-text-input id="rua" class="block mt-1 w-full" type="text" name="street" :value="old('street')" autofocus autocomplete="rua" />
                <x-input-error :messages="$errors->get('street')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="bairro" :value="__('Bairro')" />
                <x-text-input id="bairro" class="block mt-1 w-full" type="text" name="district" :value="old('district')" autofocus autocomplete="bairro" />
                <x-input-error :messages="$errors->get('district')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="numero" :value="__('Número')" />
                <x-text-input id="numero" class="block mt-1 w-full" type="number" name="num" :value="old('num')" autofocus autocomplete="numero" />
                <x-input-error :messages="$errors->get('num')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="cidade" :value="__('Cidade')" />
                <x-text-input id="cidade" class="block mt-1 w-full" type="text" name="city" :value="old('city')" autofocus autocomplete="cidade" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="estado" :value="__('Estado')" />
                <x-text-input id="estado" class="block mt-1 w-full" type="text" name="state" :value="old('state')" autofocus autocomplete="estado" />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end">
                <x-primary-button>
                    {{ __('Cadastrar Endereço') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
