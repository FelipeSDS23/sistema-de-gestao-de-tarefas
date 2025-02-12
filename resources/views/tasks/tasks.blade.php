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

                    {{-- Feedback messages --}}
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    {{-- Options bar --}}
                    <div class="flex justify-between align-center">
                        {{-- Filters --}}
                        <form action="{{ route('tasks.index') }}" method="GET">
                            @csrf
                            <label for="filtro">
                                <span class="material-symbols-outlined">filter_list</span>
                            </label>
                            <select id="filtro" name="filtro" class="w-0 h-10">
                                <option value=""></option>
                                <option value="vencimento asc">Vencimento (mais antigo)</option>
                                <option value="vencimento desc">Vencimento (mais recente)</option>
                                <option value="status">Status</option>
                                <option value="category">Categoria</option>
                                <option value="asc">Data de criação (Mais antigo)</option>
                                <option value="desc">Data de criação (Mais recente)</option>
                            </select>
                            <button type="submit" class="bg-blue-500 px-3 h-10 text-white">
                                Aplicar
                            </button>
                        </form>

                        <div>
                            <a href="{{ route('tasks.create') }}">
                                <button class="bg-blue-500 px-3 h-10 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                    Nova tarefa
                                    <span class="material-symbols-outlined px-2">add_circle</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- Subtitles --}}
                    <div class="flex space-x-6 items-center my-5">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                            <span class="ml-2 text-gray-700 text-sm">Tarefa Completa</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-yellow-500 rounded-full"></div>
                            <span class="ml-2 text-gray-700 text-sm">Tarefa Vencendo</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                            <span class="ml-2 text-gray-700 text-sm">Tarefa Vencida</span>
                        </div>
                    </div>



                    <div class="container mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 gap-4">

                            @foreach($tasks as $task)
                                <!-- Card -->
                                <div class="{{ $task->taskStyleClass }} text-white p-6 rounded-lg shadow-lg flex justify-between align-center  transform hover:translate-y-[-5px] transition duration-300">
                                    <div>
                                        <h5 class="my-1 text-xl font-semibold">{{ $task->title }}</h5>
                                        <p class="my-1">Status: {{ $task->status }}</p>
                                        <p class="my-1">{{ $task->category }}</p>
                                        <p class="my-1">Criada em: {{ $task->created_date }}</p>
                                        <p class="my-1">Expira em: {{ $task->deadline }}</p>
                                    </div>
                                    <div>
                                        <form action="{{ route("tasks.update", ['task' => $task->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="Concluída">
                                            <button class="tooltip" type="submit">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    task_alt
                                                </span>
                                                <span class="tooltip-text">Completar</span>
                                            </button>
                                        </form>

                                        <form action="{{ route("tasks.edit", ['task' => $task]) }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="action" value="Edit">
                                            <button class="tooltip" type="submit">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    edit_square
                                                </span>
                                                <span class="tooltip-text">Editar</span>
                                            </button>
                                        </form>

                                        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST" id="delete-form-{{ $task->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="tooltip" type="button" onclick="confirmDelete({{ $task->id }})">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    delete
                                                </span>
                                                <span class="tooltip-text">Remover</span>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                                <!-- Card end -->
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>