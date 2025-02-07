<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-semibold text-center mb-6">Configurações</h2>
                    <form action="/atualizar-configuracoes" method="POST">
                        <div class="mb-6">
                            <label for="receber_email" class="inline-flex items-center text-sm font-medium text-gray-700">
                                <input type="checkbox" id="receber_email" name="receber_email" class="form-checkbox h-5 w-5 text-blue-500 focus:ring-blue-500" checked />
                                <span class="ml-2">Receber e-mail ao criar/atualizar tarefa</span>
                            </label>
                        </div>
            
                        <div class="flex justify-center">
                            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Salvar Configurações
                            </button>
                        </div>
                    </form>
                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
