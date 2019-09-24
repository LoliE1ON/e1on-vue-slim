<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;
use App\Application\Models\UsersModel;

class AuthAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {  
        
        $users = UsersModel::all();

        $data = ['users' => $users];
        return $this->respondWithData(json_encode($data));

    }

}
