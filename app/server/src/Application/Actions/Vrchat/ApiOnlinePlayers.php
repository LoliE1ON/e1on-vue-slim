<?php
declare(strict_types=1);

namespace App\Application\Actions\Vrchat;

use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\Action;
use App\Application\Libraries\CurlLibrary as Curl;
use App\Application\Models\VrchatModel;
use App\Application\Models\StatisticModel;

class ApiOnlinePlayers extends Action
{
    /**
     * handle online players
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = [];
        $curl = new Curl();
        $vrchat = VrchatModel::where('id', 1)->first();

        if (isset($vrchat->auth) and !empty($vrchat->auth)) {

            $worldId = 'wrld_c5796060-01b4-49af-a555-1ee3a4af8503';
            $curl->setUrl("https://api.vrchat.cloud/api/1/worlds/".$worldId."?apiKey=".$vrchat->apiKey)
                ->setCookie("auth=".$vrchat->auth);
            $responce = json_decode($curl->getQuery());

            $players = $responce->occupants;
            StatisticModel::create(['time' => time(), 'visits' => $players, 'worldId' => $worldId]);

        }
        else {

            $curl->setUrl("https://api.vrchat.cloud/api/1/auth/user?apiKey=".$vrchat->apiKey)
                ->setOption(CURLOPT_USERPWD, $vrchat->login . ":" . $vrchat->password)
                ->setOption(CURLOPT_HEADER, true)
                ->setOption(CURLOPT_RETURNTRANSFER, false);

            $responce = $curl->getQuery();
            preg_match('#auth=(.+?);#is', $responce, $matches);

            if (isset($matches[1]) and !empty($matches[1])) {
                VrchatModel::where('id', 1)->update(['auth' => $matches[1]]);
            }

        }

        return $this->respondWithData(json_encode($data));

    }

}
