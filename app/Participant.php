<?php

namespace Poolarna;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'participants';

    /**
     * Get the user for the participant.
     */
    public function user()
    {
        return $this->hasOne('Poolarna\User', 'id', 'user_id');
    }
}
