<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Ana Julia
 * @link https://github.com/anajuliabarreto
 * @date 2024-08-30 
 * @copyright AnaJulia
 
 */class UserController extends Controller
{
   
    public function index()
    {
        $user = User::select('id', 'name', 'email')->paginate('2');

        return [
            'status' => 200,
            'menssagem' => 'Usuários encontrados!!',
            'user' => $user
        ];
    }

    public function create()
    {

    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    /*
      Update 
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $data = $request->all();

            $user = User::find($id);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            return [
                'status' => 200,
                'menssagem' => 'Usuário atualizado com sucesso!!',
                'user' => $user
            ];
        } catch (\Exception $e) {
            return [
                'status' => 400,
                'menssagem' => 'Erro ao atualizar usuário!!',
                'error' => $e->getMessage()
            ];
        }
    }

    public function destroy(string $id)
    {
        //
        try {
            $user = User::find($id);

            $user->delete();

            return [
                'status' => 200,
                'menssagem' => 'Usuário deletado com sucesso!!',
                'user' => $user
            ];
        } catch (\Exception $e) {
            return [
                'status' => 400,
                'menssagem' => 'Erro ao deletar usuário!!',
                'error' => $e->getMessage()
            ];
        }
    }
}