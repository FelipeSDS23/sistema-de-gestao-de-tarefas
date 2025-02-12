<style>
    img.profile-photo {
        width: 20vw;
        height: 20vw;
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 50%
    }

    @keyframes pulse-grow {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div>
                    <div class="flex items-center justify-center sm:justify-start space-x-4">
                        <!-- Imagem do usuário -->
                        <div>
                            <img src="{{ Auth::user()->image ? asset('storage/profile_pictures/' . Auth::user()->image) : asset('storage/profile_pictures/default.jpg') }}" alt="Profile" class="profile-photo">
                        </div>
                        
                        <!-- Texto ao lado da imagem -->
                        <div>
                            <h1 class="font-bold text-blue-400 text-md md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl">
                                Bem-vindo, {{ Auth::user()->name }}!
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center py-6">
                    <a href="{{ route('tasks.index') }}">
                        <button class="bg-blue-400 text-white font-bold py-1 px-2 sm:py-3 sm:px-6 rounded-lg shadow-lg animate-[pulse-grow_1.5s_infinite]">
                            Ver minhas tarefas
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
