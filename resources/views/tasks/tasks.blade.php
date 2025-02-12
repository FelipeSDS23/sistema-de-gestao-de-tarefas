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
                    @include('tasks.partials.feedback-messages')
                    {{-- Options bar --}}
                    @include('tasks.partials.tasks-options-bar')
                    {{-- Subtitles --}}
                    @include('tasks.partials.subtitles')

                    <div class="container mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 gap-4">

                            @foreach($tasks as $task)
                                <!-- Card -->
                                <div class="{{ $task->taskStyleClass }} text-white p-6 rounded-lg shadow-lg flex justify-between align-center  transform hover:translate-y-[-5px] transition duration-300">
                                    <div>
                                        <h5 class="my-1 text-xl font-semibold break-words max-w-[250px]">{{ $task->title }}</h5>
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