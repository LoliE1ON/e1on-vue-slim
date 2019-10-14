<?php
declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\ActionPayload;
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
        $data = [];

        // Если пришли логин и пароль
        if(isset($contents['login']) and isset($contents['password'])) {

            // Проверяем данные
            $user = UsersModel::where(['login' => $contents['login'], 'password' => $contents['password']])->first();
            if (isset($user->id)) {

                // Генерируем новый токен
                $user->token = md5(time()."-solt-1488-".time());

                // Обновляем токен в БД
                $user->save();

                $data['user'] = [
                    'id' => $user->id,
                    'login' => $user->login,
                    'token' => $user->token
                ];

                return $this->respondWithData(json_encode($data));
            }
        }

        // Генерируем ошибку
        $data['error'] = 'Login or password incorrect!';
        $payload = new ActionPayload(401, $data);
        return $this->respond($payload);

    }

}
