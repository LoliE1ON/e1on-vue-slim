<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;
use App\Application\Models\UsersModel;

class Token extends Action
{
    /**
     * Get token
     * {@inheritdoc}
     */
    protected function action(): Response
    {  

        $contents = json_decode(file_get_contents('php://input'), true);
        echo var_dump($contents);

        $users = UsersModel::all();

        $data = ['users' => $contents];
        return $this->respondWithData(json_encode($data));

    }

}
