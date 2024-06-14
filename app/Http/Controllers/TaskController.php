<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Constructor del controlador que aplica el middleware 'auth' a todas las rutas.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la lista de tareas del usuario autenticado, opcionalmente filtradas por estado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            // Obtiene las tareas del usuario autenticado, ordenadas por fecha de creación descendente
            $tasksQuery = Auth::user()->tasks()->orderBy('created_at', 'desc');
    
            // Aplica filtros si se proporciona el parámetro 'filter' en la solicitud
            if ($request->has('filter')) {
                if ($request->filter === 'completed') {
                    // Filtra las tareas completadas
                    $tasksQuery->where('status_id', TaskStatus::where('name', 'Completada')->firstOrFail()->id);
                } elseif ($request->filter === 'not_completed') {
                    // Filtra las tareas no completadas
                    $tasksQuery->where('status_id', '!=', TaskStatus::where('name', 'Completada')->firstOrFail()->id);
                }
            }
    
            // Obtener las tareas paginadas en lugar de una colección
            $tasks = $tasksQuery->paginate(10);
    
            return view('tasks.index', compact('tasks'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener las tareas: ' . $e->getMessage());
        }
    }
    

    /**
     * Muestra el formulario para crear una nueva tarea.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            $taskstatus = TaskStatus::all();
            
            // Retorna la vista 'tasks.create' con los estados de tarea
            return view('tasks.create', compact('taskstatus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al mostrar el formulario de creación: ' . $e->getMessage());
        }
    }

    /**
     * Almacena una nueva tarea creada por el usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Valida los datos de entrada proporcionados para la creación de la tarea
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'status_id' => 'required|exists:taskstatus,id'
            ]);
        
            // Crea una nueva instancia de Task y asigna los valores recibidos
            $task = new Task();
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->user_id = Auth::id();
            $task->status_id = $request->input('status_id');
        
            $task->save();
        
            return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la tarea: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        try {
            $taskstatus = TaskStatus::all();
        
            // Retorna la vista 'tasks.edit' con la tarea y los estados de tarea
            return view('tasks.edit', compact('task', 'taskstatus'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al mostrar el formulario de edición: ' . $e->getMessage());
        }
    }

    /**
     * Actualiza los datos de una tarea existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        try {
            // Valida los datos de entrada proporcionados para la actualización de la tarea
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'status_id' => 'required|exists:taskstatus,id'
            ]);
        
            // Asigna los nuevos valores al modelo Task
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status_id = $request->input('status_id');
        
            $task->save();
        
            return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la tarea: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una tarea específica de la base de datos.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
        
            return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la tarea: ' . $e->getMessage());
        }
    }

    /**
     * Marca una tarea como completada actualizando su estado.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Task $task)
    {
        try {
            // Asigna el estado 'Completada' al modelo Task
            $task->status_id = TaskStatus::where('name', 'Completada')->firstOrFail()->id;
            $task->save();
        
            return redirect()->route('tasks.index')->with('success', 'Tarea marcada como completada.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al marcar la tarea como completada: ' . $e->getMessage());
        }
    }
}
