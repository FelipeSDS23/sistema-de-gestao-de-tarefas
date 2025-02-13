{{-- Options bar --}}
<div class="flex justify-between items-center flex-wrap gap-4">

    <div class="flex gap-4 items-center flex-wrap w-full sm:w-auto">
        {{-- Formulário único para Filtro e Ordenação --}}
        <form action="{{ route('tasks.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row gap-4 sm:gap-4 overflow-x-auto">

            @csrf
            <div class="flex gap-4 w-full sm:w-auto items-center min-w-max">

                {{-- Filtro --}}
                <div class="flex items-center gap-2 w-full sm:w-auto min-w-[200px]">
                    <label for="filtroSelecionado" class="text-xs sm:text-sm">
                        <span class="material-symbols-outlined">
                            filter_list
                        </span>
                    </label>
                    <select id="filtroSelecionado" name="filter" class="px-3 py-2 text-xs sm:text-sm border rounded-lg w-25 min-w-[200px] sm:w-32 appearance-none pr-8">
                        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Sem filtro</option>
                        <option value="completo" {{ request('filter') == 'completo' ? 'selected' : '' }}>Completo</option>
                        <option value="pendente" {{ request('filter') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="trabalho" {{ request('filter') == 'trabalho' ? 'selected' : '' }}>Trabalho</option>
                        <option value="pessoal" {{ request('filter') == 'pessoal' ? 'selected' : '' }}>Pessoal</option>
                        <option value="estudos" {{ request('filter') == 'estudos' ? 'selected' : '' }}>Estudos</option>
                    </select>
                </div>

                {{-- Ordenação --}}
                <div class="flex items-center gap-2 w-full sm:w-auto min-w-[200px]">
                    <label for="ordemSelecionada" class="text-xs sm:text-sm">
                        <span class="material-symbols-outlined">
                            sort
                        </span>
                    </label>
                    <select id="ordemSelecionada" name="order" class="px-3 py-2 text-xs sm:text-sm border rounded-lg w-25 min-w-[200px] sm:w-32 appearance-none pr-8">
                        <option value="" {{ request('order') == '' ? 'selected' : '' }}>Sem ordenar</option>
                        <option value="vencimento asc" {{ request('order') == 'vencimento asc' ? 'selected' : '' }}>Vencimento (asc)</option>
                        <option value="vencimento desc" {{ request('order') == 'vencimento desc' ? 'selected' : '' }}>Vencimento (desc)</option>
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Data de criação (asc)</option>
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Data de criação (desc)</option>
                    </select>
                </div>

                {{-- Botão de Aplicar --}}
                <div class="w-35 sm:w-auto flex justify-center sm:justify-start ">
                    <button type="submit" class="bg-blue-500 text-white text-xs sm:text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition-colors w-35 sm:w-auto">
                        Aplicar
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- Botão para criar nova tarefa --}}
    <div class="w-full sm:w-auto mt-4 sm:mt-0">
        <a href="{{ route('tasks.create') }}">
            <button class="bg-blue-500 text-xs sm:text-sm px-3 h-10 text-white flex items-center justify-center hover:bg-blue-700 transition-colors w-full sm:w-auto">
                Nova tarefa
                <span class="material-symbols-outlined px-2">add_circle</span>
            </button>
        </a>
    </div>
</div>
