<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // este metodo se ejecuta antes de cualquier otra funcion de la clase 
    // before es un metodo especial
    public function before($user)
    {
        // Se premitira cualquier accion siempre y cuando el usuario logueado sea Admin
        if( $user->hasRole('Admin') )
        {
            return true;
        }

        // No retornar false ya que al invocar cualquier otro metodo devolveria siembre falso
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        // Estas funciones retornaran un boolean (true - false)
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // No hay que hacer nada adicional el defecto es que el usuario debe de estar autenticado
        return true;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        // Estas funciones retornaran un boolean (true - false)
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        // Estas funciones retornaran un boolean (true - false)
        return $user->id === $post->user_id;
    }
}
