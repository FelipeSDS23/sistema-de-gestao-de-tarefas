<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Tarefas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-semibold text-center mb-6">Nova tarefa</h2>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded-md text-center">
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded-md text-center">
                            <strong>Corrija os erros abaixo:</strong>
                        </div>
                    @endif

                    @if (isset($task))
                    <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
                        @method('PATCH')
                    @else
                    <form action="{{ route('tasks.store') }}" method="POST">
                    @endif
                        @csrf

                        <!-- Campo Nome da Tarefa -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Nome da Tarefa (máximo 30 caracteres):
                            </label>
                            <input type="text" id="title" name="title" maxlength="30" value="{{ isset($task) ? $task->title : old('title') }}"
                                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                    @error('title') border-red-500 @enderror" required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <!-- Campo Categoria -->
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Categoria:</label>
                            <select id="category" name="category"
                                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                    @error('category') border-red-500 @enderror" required>
                                <option value="">Selecione uma categoria</option>
                                <option value="Trabalho" {{ (isset($task) && $task->category == 'Trabalho') || old('category') == 'Trabalho' ? 'selected' : '' }}>Trabalho</option>
                                <option value="Pessoal" {{ (isset($task) && $task->category == 'Pessoal') || old('category') == 'Pessoal' ? 'selected' : '' }}>Pessoal</option>
                                <option value="Estudos" {{ (isset($task) && $task->category == 'Estudos') || old('category') == 'Estudos' ? 'selected' : '' }}>Estudos</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

            
                        <!-- Campo Data Limite -->
                        <div class="mb-4">
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Data Limite:</label>
                            <input type="date" id="deadline" name="deadline" value="{{ isset($task) ? $task->deadline : old('deadline') }}"
                                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 
                                    @error('deadline') border-red-500 @enderror" required>
                            @error('deadline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
            
                        <div class="flex justify-center">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @if (isset($task))
                                    Atualizar Tarefa
                                @else
                                    Cadastrar Tarefa
                                @endif
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
