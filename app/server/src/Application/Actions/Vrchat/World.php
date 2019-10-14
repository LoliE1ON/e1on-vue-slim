<?php
declare(strict_types=1);

namespace App\Application\Actions\Vrchat;

use App\Application\Actions\ActionPayload;
use App\Application\Models\VrchatModel;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;
use App\Application\Libraries\CurlLibrary as Curl;
use App\Application\Models\WorldModel;

class World extends Action
{
    /**
     * get world data
     * {@inheritdoc}
     * @throws \Exception
     */
    protected function action(): Response
    {
        $data = [];
        $contents = json_decode(file_get_contents('php://input'), true);

        // Если пришел WorldId
        if(isset($contents['worldId'])) {

            // Делаем выборку
            $world = WorldModel::where(['worldId' => $contents['worldId']])->first();

            if (isset($world->id)) {

                // Если не пустой массив с данным о карте
                if (!empty($world->jsonData)) {

                    // Проверяем как давно обновлялись данные
                    if ($world->updateTimeJsonData < (time()-604800)) {

                        // Обновляем данные
                        $responce = $this->requestWorld($world->worldId);

                        if (!empty($responce)) {

                            $world->jsonData = $responce;
                            $world->updateTimeJsonData = time();
                            $world->save();

                        }
                    }


                    $data['data'] = json_decode($world->jsonData, true);
                    return $this->respondWithData(json_encode($data));

                }
                // Если массив пустой, то получаем данные
                else {

                    // Отправляем запрос
                    $responce = $this->requestWorld($world->worldId);

                    // Если есть ответ, то сохраняем в БД
                    if (!empty($responce)) {

                        $world->jsonData = $responce;
                        $world->updateTimeJsonData = time();
                        $world->save();

                        $data['data'] = json_decode($world->jsonData);
                        return $this->respondWithData(json_encode($data));

                    }

                }
            }

        }

        // Генерируем ошибку
        $data['error'] = 'WorldId incorrect!';
        $payload = new ActionPayload(401, $data);
        return $this->respond($payload);

    }

    /**
     * Fetch world data
     * @param string $worldId
     * @return String
     * @throws \Exception
     */
    private function requestWorld(string $worldId): String {

        $curl = new Curl();
        $vrchat = VrchatModel::where('id', 1)->first();

        $curl->setUrl("https://api.vrchat.cloud/api/1/worlds/".$worldId."?apiKey=".$vrchat->apiKey);
        $responce = $curl->getQuery();

        echo "QUERYR12313123123";

        return $responce;

    }
}
