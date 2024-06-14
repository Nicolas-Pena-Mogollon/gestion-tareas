<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions; // Usar transacciones de base de datos para revertir los cambios después de cada prueba

    /**
     * Prueba para crear una tarea con status_id 1.
     *
     * @return void
     */
    public function testCreateTaskWithStatus1()
    {
        $user = User::factory()->create();

        // Crear una tarea con status_id 1
        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'title' => 'Tarea con status_id 1',
            'description' => 'Descripción de tarea con status_id 1',
            'status_id' => 1, // Valor de status_id específico
        ]);

        // Verificar que la tarea se creó correctamente
        $response->assertStatus(302); // Verificar redirección después de crear la tarea
        $response->assertSessionHas('success', 'Tarea creada correctamente.'); // Verificar mensaje de éxito en sesión
    }

    /**
     * Prueba para crear una tarea con status_id 2.
     *
     * @return void
     */
    public function testCreateTaskWithStatus2()
    {
        $user = User::factory()->create();

        // Crear una tarea con status_id 2
        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'title' => 'Tarea con status_id 2',
            'description' => 'Descripción de tarea con status_id 2',
            'status_id' => 2, // Valor de status_id diferente
        ]);

        // Verificar que la tarea se creó correctamente
        $response->assertStatus(302); // Verificar redirección después de crear la tarea
        $response->assertSessionHas('success', 'Tarea creada correctamente.'); // Verificar mensaje de éxito en sesión
    }

    /**
     * Prueba para actualizar una tarea existente.
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        // Actualizar la tarea con nuevos datos
        $response = $this->actingAs($user)->put(route('tasks.update', $task), [
            'title' => 'Tarea actualizada',
            'description' => 'Descripción actualizada',
            'status_id' => 2, // Nuevo status_id diferente al original
        ]);

        // Verificar que la tarea se actualizó correctamente
        $response->assertStatus(302); // Verificar redirección después de actualizar la tarea
        $response->assertSessionHas('success', 'Tarea actualizada correctamente.'); // Verificar mensaje de éxito en sesión
    }

    /**
     * Prueba para eliminar una tarea existente.
     *
     * @return void
     */
    public function testDeleteTask()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        // Eliminar la tarea
        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));

        // Verificar que la tarea se eliminó correctamente
        $response->assertStatus(302); // Verificar redirección después de eliminar la tarea
        $response->assertSessionHas('success', 'Tarea eliminada correctamente.'); // Verificar mensaje de éxito en sesión
    }

    /**
     * Prueba para verificar la vista de lista de tareas.
     *
     * @return void
     */
    public function testViewTasks()
    {
        $user = User::factory()->create();

        // Simular varias tareas para el usuario
        $tasks = Task::factory()->count(5)->create(['user_id' => $user->id]);

        // Verificar la vista de la lista de tareas
        $response = $this->actingAs($user)->get(route('tasks.index'));

        // Verificar que la página cargue correctamente
        $response->assertStatus(200); // Verificar que la página cargue correctamente
    }
}