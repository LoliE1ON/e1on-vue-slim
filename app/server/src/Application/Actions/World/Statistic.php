<?php
declare(strict_types=1);

namespace App\Application\Actions\World;

use App\Application\Actions\ActionPayload;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;
use App\Application\Models\StatisticModel;

class Statistic extends Action
{
    /**
     * Get world statistic
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $contents = json_decode(file_get_contents('php://input'), true);
        $data = [];

        // Если пришел World ID
        if(isset($contents['worldId'])) {

            // Выбираем статистику за последние сутки
            $hour = 86400;
            $statistics = StatisticModel::where('worldId', $contents['worldId'])
                ->where('time', '>', (time()-$hour))
                ->get();

            foreach ($statistics as $key => $value) {
                $statistics[$key]->date = $value->time;
            }

            $data['statistics'] = $statistics;
            return $this->respondWithData(json_encode($data));

        }

        // Генерируем ошибку
        $data['error'] = 'World ID incorrect!';
        $payload = new ActionPayload(401, $data);
        return $this->respond($payload);

    }

}
