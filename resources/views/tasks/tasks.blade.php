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

                    {{-- <h2>Gerenciar Tarefas</h2>
                    <p>Bem-vindo, {{ Auth::user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
                    <p>Data de Cadastro: {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                    <p>Image, {{ Auth::user()->image }}</p> --}}
                    
                    <div class="flex justify-between align-center">
                    {{-- Filters --}}
                        <form>
                            @csrf
                            <label for="filtro">
                                <span class="material-symbols-outlined">filter_list</span>
                            </label>
                            <select id="filtro" name="filtro" class="w-0 h-10">
                                <option value=""></option>
                                <option value="status">Status</option>
                                <option value="categoria">Categoria</option>
                                <option value="data-criacao-mais-antigo">Data de criação (Mais antigo)</option>
                                <option value="data-criacao-mais-recente">Data de criação (Mais recente)</option>
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
                                        <span class="tooltip">
                                            <a href="#">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    timer
                                                </span>
                                            </a>
                                            <span class="tooltip-text">Iniciar</span>
                                        </span>

                                        <span class="tooltip">
                                            <a href="#">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    task_alt
                                                </span>
                                            </a>
                                            <span class="tooltip-text">Completar</span>
                                        </span>

                                        <span class="tooltip">
                                            <a href="#">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    edit_square
                                                </span>
                                            </a>
                                            <span class="tooltip-text">Editar</span>
                                        </span>

                                        <span class="tooltip">
                                            <a href="#">
                                                <span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">
                                                    delete
                                                </span>
                                            </a>
                                            <span class="tooltip-text">Remover</span>
                                        </span>
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
