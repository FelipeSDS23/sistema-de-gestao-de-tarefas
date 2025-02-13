<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Setting;
use App\Mail\AppEmail;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // 🔹 Recupera as tarefas do usuário e aplica paginação
        $tasksQuery = $user->tasks();

        // 🔹 Validação dos inputs
        $request->validate([
            'filter' => 'nullable|in:completo,pendente,trabalho,pessoal,estudos',
            'order' => 'nullable|in:vencimento asc,vencimento desc,asc,desc',
        ]);

        // 🔹 Aplicação de Filtros
        if ($request->filter) {
            $tasksQuery = $tasksQuery->where(function ($query) use ($request) {
                match ($request->filter) {
                    'completo' => $query->where('status', 'Concluída'),
                    'pendente' => $query->where('status', 'Pendente'),
                    'trabalho' => $query->where('category', 'Trabalho'),
                    'pessoal'  => $query->where('category', 'Pessoal'),
                    'estudos'  => $query->where('category', 'Estudos'),
                    default    => null,
                };
            });
        }

        // 🔹 Aplicação de Ordenação
        if ($request->order) {
            match ($request->order) {
                'vencimento asc'  => $tasksQuery->orderBy('deadline', 'asc'),
                'vencimento desc' => $tasksQuery->orderBy('deadline', 'desc'),
                'asc'             => $tasksQuery->orderBy('created_at', 'asc'),
                'desc'            => $tasksQuery->orderBy('created_at', 'desc'),
                default           => null,
            };
        } else {
            // Ordem padrão: mais recente primeiro
            $tasksQuery->orderBy('created_at', 'desc');
        }

        // 🔹 Paginação
        $tasks = $tasksQuery->paginate(9); // Aqui você pode alterar o número de tarefas por página

        // 🔹 Formatação das tarefas
        $tasks->getCollection()->transform(function ($task) {
            $task->created_date = Carbon::parse($task->created_at)->format('d/m/Y');
            
            // Parse e ajusta as datas
            $deadline = Carbon::parse($task->deadline)->startOfDay();
            $currentDate = Carbon::now('America/Sao_Paulo')->startOfDay();
            
            // Cálculo da diferença em dias
            $daysRemaining = $currentDate->diffInDays($deadline, false);
            
            $task->deadline = $deadline->format('d/m/Y'); // Formata a data limite
            
            // Lógica para definir a classe de cor
            $taskStyleClass = '';
            if ($task->status == 'Concluída') {
                $taskStyleClass = 'bg-blue-500';
            } elseif ($daysRemaining < 0) { 
                $taskStyleClass = 'bg-red-500'; // Atrasada
            } elseif ($daysRemaining <= 5) {
                $taskStyleClass = 'bg-yellow-500'; // Faltando 5 dias ou menos
            } else {
                $taskStyleClass = 'bg-green-500'; // Mais de 5 dias para expirar
            }
            
            $task->taskStyleClass = $taskStyleClass;
            
            return $task;
        });

        // 🔹 Retorna a view com as tarefas paginadas
        return view('tasks.tasks', ['tasks' => $tasks]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'title' => 'required|max:50',
            'category' => 'required|in:Trabalho,Pessoal,Estudos',
            'deadline' => 'required|date|after_or_equal:today',
        ];
        $feedback = [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 50 caracteres.',
            'category.required' => 'A categoria é obrigatória.',
            'category.in' => 'A categoria deve ser uma das seguintes opções: Trabalho, Pessoal ou Estudos.',
            'deadline.required' => 'O campo data limite é obrigatório.',
            'deadline.date' => 'A data limite deve ser uma data válida.',
            'deadline.after_or_equal' => 'A data limite deve ser hoje ou uma data futura.',
        ];
        $request->validate($rules, $feedback);

        $user = User::find(Auth::user()->id);

        $task = new Task($request->all());
      
        $user->tasks()->save($task);

        // Sends email if the user has activated this option
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        if($settings->first()->send_email_on_create) {
            $taskTitle = $request->get('title');
            $dados = [
                'nome' => Auth::user()->name,
                'mensagem' => "A tarefa $taskTitle foi criada com sucesso!"
            ];
            Mail::to(Auth::user()->email)->send(new AppEmail($dados));
        }


        return redirect()->route('tasks.create')->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $task = Task::find($id);

        if(!$task) {
            return redirect()->back()->with('error', 'Tarefa não encontrada');
        }

        return view('tasks.create', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $task = Task::find($id);

        if(!$task) {
            return redirect()->back()->with('error', 'Tarefa não encontrada');
        }

        // Check if the action is "Completed" and update the status
        if($request->action && $request->action == "Concluída") {
            $task->status = "Concluída";
            $task->save();
            return redirect()->back()->with('success', 'Tarefa marcada como concluída');
        }

        // Validation
        $rules = [
            'title' => 'required|max:50',
            'category' => 'required|in:Trabalho,Pessoal,Estudos',
            'deadline' => 'required|date|after_or_equal:today',
        ];
        $feedback = [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 50 caracteres.',
            'category.required' => 'A categoria é obrigatória.',
            'category.in' => 'A categoria deve ser uma das seguintes opções: Trabalho, Pessoal ou Estudos.',
            'deadline.required' => 'O campo data limite é obrigatório.',
            'deadline.date' => 'A data limite deve ser uma data válida.',
            'deadline.after_or_equal' => 'A data limite deve ser hoje ou uma data futura.',
        ];
        $request->validate($rules, $feedback);

        // If it is not a specific action, update the other fields of the request
        $task->update($request->except('action'));

        // Sends email if the user has activated this option
        $settings = Setting::where('user_id', Auth::user()->id)->get();
        if($settings->first()->send_email_on_edit) {
            $taskTitle = $request->get('title');
            $dados = [
                'nome' => Auth::user()->name,
                'mensagem' => "A tarefa $taskTitle foi editada com sucesso!"
            ];
            Mail::to(Auth::user()->email)->send(new AppEmail($dados));
        }

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::find($id);

        if(!$task) {
            return redirect()->back()->with('error', 'Tarefa não encontrada');
        }

        $task->delete();

        return redirect()->back()->with('success', 'Tarefa excluída com sucesso');
        
    }
}
