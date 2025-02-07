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

                    <h2>Gerenciar Tarefas</h2>
                    <p>Bem-vindo, {{ Auth::user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
                    <p>Data de Cadastro: {{ auth()->user()->created_at->format('d/m/Y') }}</p>

                    <div class="container mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 gap-4">
                            <!-- Card 1 -->
                            <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 1</h5>
                                <p>Conteúdo do card 1</p>
                            </div>
                            <!-- Card 2 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 2</h5>
                                <p>Conteúdo do card 2</p>
                            </div>
                            <!-- Card 3 -->
                            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg">
                                <h5 class="text-xl font-semibold">Card 3</h5>
                                <p>Conteúdo do card 3</p>
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
