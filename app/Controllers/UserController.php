<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use Slim\Psr7\Response;
use Slim\Psr7\Request;

class UserController extends Controller
{

    public function index(Response $response)
    {
        $response
            ->getBody()
            ->write(json_encode($this->repository->all()));

        return $this->successResponse($response);
    }

    public function store(Request $request, Response $response)
    {
        $this->repository->create($request->getParsedBody());
        
        $response
            ->getBody()
            ->write(json_encode([
                'success' => true
            ]));

        return $this->successResponse($response);
    }

    public function show(Response $response, $id)
    {
        $user = $this->repository->find($id);

        $response->getBody()->write(json_encode($user));

        return $this->successResponse($response);
    }

    public function update(Request $request, Response $response, $id)
    {
        $this->repository->update($request->getParsedBody(), $id);
        $response
            ->getBody()
            ->write(json_encode([
                'success' => true
            ]));

        return $this->successResponse($response);
    }

    public function destroy(Response $response, $id)
    {
        $this->repository->delete($id);

        $response
            ->getBody()
            ->write(json_encode([
                'success' => true
            ]));

        return $this->successResponse($response);
    }
}
