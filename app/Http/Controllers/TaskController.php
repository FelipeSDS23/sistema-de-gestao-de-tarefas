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
        $tasks = $user->tasks()->get(); // 🔹 Recupera todas as tarefas do usuário

        // 🔹 Validação dos inputs
        $request->validate([
            'filter' => 'nullable|in:completo,pendente,trabalho,pessoal,estudos',
            'order' => 'nullable|in:vencimento asc,vencimento desc,asc,desc',
        ]);

        // 🔹 Aplicação de Filtros (mantém o resultado filtrado na variável $tasks)
        if ($request->filter) {
            $tasks = $tasks->filter(function ($task) use ($request) {
                return match ($request->filter) {
                    'completo' => $task->status === 'Concluída',
                    'pendente' => $task->status === 'Pendente',
                    'trabalho' => $task->category === 'Trabalho',
                    'pessoal'  => $task->category === 'Pessoal',
                    'estudos'  => $task->category === 'Estudos',
                    default    => true,
                };
            });
        }

        // 🔹 Aplicação de Ordenação sobre a variável já filtrada
        if ($request->order) {
            $tasks = match ($request->order) {
                'vencimento asc'  => $tasks->sortBy('deadline'),
                'vencimento desc' => $tasks->sortByDesc('deadline'),
                'asc'             => $tasks->sortBy('created_at'),
                'desc'            => $tasks->sortByDesc('created_at'),
                default           => $tasks,
            };
        } else {
            // Ordem padrão: mais recente primeiro
            $tasks = $tasks->sortByDesc('created_at');
        }

        // 🔹 Reindexa a coleção para evitar problemas com chaves
        $tasks = $tasks->values();


        



        // Formats dates for display and assigns color class according to task deadline
        $tasks = $tasks->map(function ($task) {
            $task->created_date = Carbon::parse($task->created_at)->format('d/m/Y');
        
            // Parse and adjust dates
            $deadline = Carbon::parse($task->deadline)->startOfDay();
            $currentDate = Carbon::now('America/Sao_Paulo')->startOfDay();
            
            // Calculation of the difference in days between today and the deadline
            $daysRemaining = $currentDate->diffInDays($deadline, false);
        
            $task->deadline = $deadline->format('d/m/Y'); // Format deadline as 'd/m/Y'
        
            $taskStyleClass = '';
        
            // Logic to set color based on date and status
            if ($task->status == 'Concluída') {
                $taskStyleClass = 'bg-blue-500';
            } elseif ($daysRemaining < 0) { 
                $taskStyleClass = 'bg-red-500'; // Late
            } elseif ($daysRemaining <= 5) {
                $taskStyleClass = 'bg-yellow-500'; // 5 days or less left
            } else {
                $taskStyleClass = 'bg-green-500'; // More than 5 days to expire
            }
        
            $task->taskStyleClass = $taskStyleClass;
        
            return $task;
        });
                

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
