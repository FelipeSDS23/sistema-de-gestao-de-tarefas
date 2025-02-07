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
                    <p>Data de Cadastro: {{ auth()->user()->created_at->format('d/m/Y') }}</p> --}}
                    
                    <div class="flex justify-between align-center">
                    {{-- Filters --}}
                        <form>
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
                            <a href="{{ route('dashboard.create') }}">
                                <button class="bg-blue-500 px-3 h-10 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                    Nova tarefa
                                    <span class="material-symbols-outlined px-2">add_circle</span>
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="container mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 gap-4">

                            
                            <!-- Card 1 -->
                            <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg flex justify-between align-center  transform hover:translate-y-[-5px] transition duration-300">
                                <div>
                                    <h5 class="my-1 text-xl font-semibold">Estudar alemão</h5>
                                    <p class="my-1">Status: Pendênte</p>
                                    <p class="my-1">Categoria</p>
                                    <p class="my-1">Criada em: 12/01/2024</p>
                                    <p class="my-1">Expira em: 20/01/2024</p>
                                </div>
                                <div>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">task_alt</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">edit_square</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">delete</span></a></p>
                                </div>
                            </div>





                            <!-- Card 2 -->
                            <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg flex justify-between align-center  transform hover:translate-y-[-5px] transition duration-300">
                                <div>
                                    <h5 class="my-1 text-xl font-semibold">Estudar alemão</h5>
                                    <p class="my-1">Status: Pendênte</p>
                                    <p class="my-1">Categoria</p>
                                    <p class="my-1">Criada em: 12/01/2024</p>
                                    <p class="my-1">Expira em: 20/01/2024</p>
                                </div>
                                <div>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">task_alt</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">edit_square</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">delete</span></a></p>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg flex justify-between align-center  transform hover:translate-y-[-5px] transition duration-300">
                                <div>
                                    <h5 class="my-1 text-xl font-semibold">Estudar alemão</h5>
                                    <p class="my-1">Status: Pendênte</p>
                                    <p class="my-1">Categoria</p>
                                    <p class="my-1">Criada em: 12/01/2024</p>
                                    <p class="my-1">Expira em: 20/01/2024</p>
                                </div>
                                <div>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">task_alt</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">edit_square</span></a></p>
                                    <p><a href="#"><span class="py-1 my-1 transform hover:scale-110 transition duration-300 cursor-pointer text-right material-symbols-outlined">delete</span></a></p>
                                </div>
                            </div>
                            <!-- Card 4 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 4</h5>
                                <p>Conteúdo do card 4</p>
                            </div>
                            <!-- Card 5 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 5</h5>
                                <p>Conteúdo do card 5</p>
                            </div>

                            <!-- Card 6 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 6</h5>
                                <p>Conteúdo do card 6</p>
                            </div>
                            <!-- Card 7 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 7</h5>
                                <p>Conteúdo do card 7</p>
                            </div>
                            <!-- Card 8 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 8</h5>
                                <p>Conteúdo do card 8</p>
                            </div>
                            <!-- Card 9 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 9</h5>
                                <p>Conteúdo do card 9</p>
                            </div>
                            <!-- Card 10 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 10</h5>
                                <p>Conteúdo do card 10</p>
                            </div>

                            <!-- Card 11 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 11</h5>
                                <p>Conteúdo do card 11</p>
                            </div>
                            <!-- Card 12 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 12</h5>
                                <p>Conteúdo do card 12</p>
                            </div>
                            <!-- Card 13 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 13</h5>
                                <p>Conteúdo do card 13</p>
                            </div>
                            <!-- Card 14 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 14</h5>
                                <p>Conteúdo do card 14</p>
                            </div>
                            <!-- Card 15 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 15</h5>
                                <p>Conteúdo do card 15</p>
                            </div>

                            <!-- Card 16 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 16</h5>
                                <p>Conteúdo do card 16</p>
                            </div>
                            <!-- Card 17 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 17</h5>
                                <p>Conteúdo do card 17</p>
                            </div>
                            <!-- Card 18 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 18</h5>
                                <p>Conteúdo do card 18</p>
                            </div>
                            <!-- Card 19 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 19</h5>
                                <p>Conteúdo do card 19</p>
                            </div>
                            <!-- Card 20 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 20</h5>
                                <p>Conteúdo do card 20</p>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
