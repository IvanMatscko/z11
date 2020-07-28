<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    /**
     * @var string
     */
    protected $table = 'z11_dota2_trainers';

    /**
     * @var string
     */
    protected $primaryKey = 'trainer_id';

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = "z11_dota2_history";
}
