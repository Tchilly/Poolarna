<?php

namespace Poolarna;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_id', 'deleted_at'];


    /**
     * Get the participants for the event.
     */
    public function participants()
    {
        return $this->hasMany('Poolarna\Participant');
    }

    /**
     * Get the user for the event.
     */
    public function user()
    {
        return $this->hasOne('Poolarna\User', 'id', 'user_id');
    }

    /**
    * Check to see if user is signed up for event.
    */
    public function checkParticipantion($id)
    {

        if (Auth::check()) {

            $user = Auth::user();

            $query = DB::table('participants')
                ->select('user_id')
                ->where('user_id', '=', $user->id)
                ->where('event_id', '=', $id)
                ->count();

            if ($query <= 0) {

                 return false;

            }

            return true;

        }

    }

    /**
    * Check to see if user is signed up for event.
    */
    public function showAvailability($id = null)
    {

        if ($id == null) {

            $id = $this->id;

        }

        $event = Event::find($id);

        $availability = $event->availability;

        $signed = DB::table('participants')
            ->select('user_id')
            ->where('event_id', '=', $event->id)
            ->count();

        return $availability - $signed;

    }

    /**
    * Check to see if user is signed up for event.
    */
    public function checkAvailability($id = null)
    {

        if ($id == null) {

            $id = $this->id;

        }

        $event = Event::find($id);

        $availability = $event->availability;

        $signed = DB::table('participants')
            ->select('user_id')
            ->where('event_id', '=', $event->id)
            ->count();

        $availability = $availability - $signed;

        if ($availability <= 0) {

            return false;

        }

        return true;

    }



}
