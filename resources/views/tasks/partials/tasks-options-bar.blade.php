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