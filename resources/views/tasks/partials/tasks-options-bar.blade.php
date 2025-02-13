{{-- Options bar --}}
<div class="flex justify-between align-center">
    
    <div class="flex">

        {{-- Filter --}}
        <form action="{{ route('tasks.index') }}" method="GET">
            @csrf
            <details class="relative inline-block mr-6">
                <summary title="Filtrar" class="cursor-pointer flex items-center gap-2 px-3 py-2 border rounded-lg">
                    <span class="material-symbols-outlined">filter_list</span>
                </summary>            
                <ul class="absolute bg-white shadow-lg rounded-lg mt-2 w-48 border z-50">
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('')">Sem filtro</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('completo')">Completo</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('pendente')">Pendente</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('trabalho')">Trabalho</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('pessoal')">Pessoal</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarFiltro('estudos')">Estudos</button></li>
                </ul>
            </details>
            <input type="hidden" id="filtroSelecionado" name="filter">
        </form>

        {{-- Order by --}}
        <form action="{{ route('tasks.index') }}" method="GET">
            @csrf
            <details class="relative inline-block">
                <summary title="Ordenar" class="cursor-pointer flex items-center gap-2 px-3 py-2 border rounded-lg">
                    <span class="material-symbols-outlined">sort</span>
                </summary>            
                <ul class="absolute bg-white shadow-lg rounded-lg mt-2 w-48 border z-50">
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarOrdem('')">Sem ordenar</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarOrdem('vencimento asc')">Vencimento (mais antigo)</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarOrdem('vencimento desc')">Vencimento (mais recente)</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarOrdem('asc')">Data de criação (Mais antigo)</button></li>
                    <li><button class="block w-full text-left px-4 py-2 hover:bg-gray-100" onclick="selecionarOrdem('desc')">Data de criação (Mais recente)</button></li>
                </ul>
            </details>
            <input type="hidden" id="ordemSelecionada" name="order">
        </form>

    </div>

    <div>
        <a href="{{ route('tasks.create') }}">
            <button class="bg-blue-500 px-3 h-10 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                Nova tarefa
                <span class="material-symbols-outlined px-2">add_circle</span>
            </button>
        </a>
    </div>
</div>

<script>
    function selecionarOrdem(valor) {
        document.getElementById('ordemSelecionada').value = valor;
    }

    function selecionarFiltro(valor) {
        document.getElementById('filtroSelecionado').value = valor;
    }
</script>