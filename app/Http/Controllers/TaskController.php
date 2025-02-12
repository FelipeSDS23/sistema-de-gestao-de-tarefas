<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::find(Auth::user()->id);

        // !!!!!!!!!!!!!!!!!! CODAR FILTROS AQUI !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->get();

        $tasks = $tasks->map(function ($task) {
            $task->created_date = Carbon::parse($task->created_at)->format('d/m/Y');
        
            // Parse and reset the time for both created_at and deadline
            $deadline = Carbon::parse($task->deadline)->startOfDay();
            $currentDate = Carbon::now('America/Sao_Paulo')->startOfDay();
        
            $task->deadline = $deadline->format('Y-m-d'); // Format the deadline as 'Y-m-d'
        
            $taskStyleClass = '';
        
            // Logic for determining the task style class based on the deadline and status
            if ($deadline->isBefore($currentDate)) {
                $taskStyleClass = 'bg-red-500';
            } elseif ($task->status == 'Pendente') {
                $taskStyleClass = 'bg-yellow-500';
            } elseif ($task->status == 'Concluída') {
                $taskStyleClass = 'bg-green-500';
            }

            $task->deadline = $deadline->format('d/m/Y'); // Format the deadline as 'd/m/Y'
        
            $task->taskStyleClass = $taskStyleClass;
        
            return $task;
        });        

        return view('tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:30',
            'category' => 'required|in:Trabalho,Pessoal,Estudos',
            'deadline' => 'required|date|after_or_equal:today',
        ];

        $feedback = [
            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.exists' => 'O usuário selecionado não existe no sistema.',
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 30 caracteres.',
            'category.required' => 'A categoria é obrigatória.',
            'category.in' => 'A categoria deve ser uma das seguintes opções: Trabalho, Pessoal ou Estudos.',
            'deadline.required' => 'O campo data limite é obrigatório.',
            'deadline.date' => 'A data limite deve ser uma data válida.',
            'deadline.after_or_equal' => 'A data limite deve ser hoje ou uma data futura.',
        ];
        
        $request->validate($rules, $feedback);

        $user = User::find($request->user_id);

        $task = new Task($request->all());
      
        $user->tasks()->save($task);

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
