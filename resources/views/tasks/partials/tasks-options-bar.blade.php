{{-- Options bar --}}
<div class="flex justify-between items-center flex-wrap gap-4">

    <div class="flex gap-4 items-center flex-wrap w-full sm:w-auto">
        {{-- Filter and Sort Form --}}
        <form action="{{ route('tasks.index') }}" method="GET"
            class="w-full sm:w-auto flex flex-col sm:flex-row gap-4 sm:gap-4 overflow-x-auto">

            @csrf
            <div class="flex gap-4 w-full sm:w-auto items-center min-w-max bg-gray-100 p-2 rounded-md">

                {{-- Filter --}}
                <div class="flex items-center gap-2 mx-3 w-full sm:w-auto min-w-[200px]">
                    <label for="filtroSelecionado" class="text-xs sm:text-sm">
                        <span class="material-symbols-outlined">
                            filter_list
                        </span>
                    </label>
                    <select id="filtroSelecionado" name="filter"
                        class="px-3 py-2 text-xs sm:text-sm border rounded-lg w-25 min-w-[200px] sm:w-32 appearance-none pr-8">
                        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Sem filtro</option>
                        <option value="completo" {{ request('filter') == 'completo' ? 'selected' : '' }}>Completo
                        </option>
                        <option value="pendente" {{ request('filter') == 'pendente' ? 'selected' : '' }}>Pendente
                        </option>
                        <option value="trabalho" {{ request('filter') == 'trabalho' ? 'selected' : '' }}>Trabalho
                        </option>
                        <option value="pessoal" {{ request('filter') == 'pessoal' ? 'selected' : '' }}>Pessoal</option>
                        <option value="estudos" {{ request('filter') == 'estudos' ? 'selected' : '' }}>Estudos</option>
                    </select>
                </div>

                {{-- Sort --}}
                <div class="flex items-center gap-2 mx-3 w-full sm:w-auto min-w-[200px]">
                    <label for="ordemSelecionada" class="text-xs sm:text-sm">
                        <span class="material-symbols-outlined">
                            sort
                        </span>
                    </label>
                    <select id="ordemSelecionada" name="order"
                        class="px-3 py-2 text-xs sm:text-sm border rounded-lg w-25 min-w-[200px] sm:w-32 appearance-none pr-8">
                        <option value="" {{ request('order') == '' ? 'selected' : '' }}>Sem ordenar</option>
                        <option value="vencimento asc" {{ request('order') == 'vencimento asc' ? 'selected' : '' }}>
                            Vencimento (asc)</option>
                        <option value="vencimento desc" {{ request('order') == 'vencimento desc' ? 'selected' : '' }}>
                            Vencimento (desc)</option>
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Data de criação (asc)
                        </option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Data de criação
                            (desc)</option>
                    </select>
                </div>

                {{-- Apply button --}}
                <div class="w-full sm:w-auto flex justify-center sm:justify-start ml-5">
                    <button type="submit"
                        class="bg-blue-400 text-white text-xs sm:text-sm px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors w-full sm:w-44 flex items-center justify-center">
                        Aplicar
                    </button>
                </div>

                {{-- Clear filters button --}}
                <div class="w-full sm:w-auto flex justify-center sm:justify-start">
                    <button type="button" onclick="window.location.href='{{ route('tasks.index') }}'"
                        class="bg-blue-400 text-white text-xs sm:text-sm px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors w-full sm:w-44 flex items-center justify-center">
                        Limpar
                    </button>
                </div>


            </div>
        </form>
    </div>

    {{-- Button to create new task --}}
    <div class="w-full sm:w-auto mt-4 sm:mt-0">
        <a href="{{ route('tasks.create') }}">
            <button
                class="bg-blue-400 text-xs sm:text-sm px-3 h-10 text-white flex items-center justify-center hover:bg-blue-500 transition-colors w-full sm:w-auto">
                Nova tarefa
                <span class="material-symbols-outlined px-2">add_circle</span>
            </button>
        </a>
    </div>
</div>
