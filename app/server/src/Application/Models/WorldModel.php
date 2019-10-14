<?php

namespace App\Application\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class WorldModel extends Eloquent
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'world';

    /**
     * Определяет необходимость отметок времени для модели.
     *
     * @var bool
     */
    public $timestamps = false;

}