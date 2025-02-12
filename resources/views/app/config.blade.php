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

                    {{-- Feedback messages --}}
                    @include('app.partials.feedback-messages')

                    <h2 class="text-2xl font-semibold text-center mb-6">Configurações</h2>
                    <form action="{{ route('dashboard.config') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="receber_email_tarefa_criada" class="inline-flex items-center text-sm font-medium text-gray-700">
                                <input type="checkbox" id="receber_email_tarefa_criada" name="receber_email_tarefa_criada" class="form-checkbox h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500 border-gray-300 rounded-md" {{ $setting->send_email_on_create ? 'checked' : '' }} />
                                <span class="ml-2">Receber e-mail quando a tarefa for criada</span>
                            </label>
                        </div>
                    
                        <div class="mb-6">
                            <label for="receber_email_tarefa_editada" class="inline-flex items-center text-sm font-medium text-gray-700">
                                <input type="checkbox" id="receber_email_tarefa_editada" name="receber_email_tarefa_editada" class="form-checkbox h-5 w-5 text-blue-500 focus:ring-2 focus:ring-blue-500 border-gray-300 rounded-md" {{ $setting->send_email_on_edit ? 'checked' : '' }} />
                                <span class="ml-2">Receber e-mail quando a tarefa for editada</span>
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
