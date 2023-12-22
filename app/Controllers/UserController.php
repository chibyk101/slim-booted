<?php

namespace App\Controllers;

use App\Models\User;
use App\Support\Validator;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class UserController extends Controller
{

    public function index(Request $request, Response $response)
    {
        $response
            ->getBody()
            ->write(json_encode(User::query()->paginate()));

        return $this->successResponse($response);
    }

    public function store(Request $request, Response $response)
    {
        $validator = Validator::make($request->getParsedBody(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        $user = User::create($validator->validate());

        $response
            ->getBody()
            ->write($user->toJson());

        return $this->successResponse($response);
    }

    public function show(Request $request, Response $response, $id)
    {
        $user = User::findOrFail($id);

        $response->getBody()->write(json_encode($user));

        return $this->successResponse($response);
    }

    public function update(Request $request, Response $response, $id)
    {
        $user = User::findOrFail($id);

        $user->update(Validator::make($request->getParsedBody(), [
            'name' => 'required|string',
            'email' => 'required|email'
        ]));

        $response
            ->getBody()
            ->write($user->toJson());

        return $this->successResponse($response);
    }

    public function destroy(Request $request, Response $response, $id)
    {
        User::findOrFail($id)->delete();

        $response
            ->getBody()
            ->write(json_encode([
                'success' => true
            ]));

        return $this->successResponse($response);
    }
}
