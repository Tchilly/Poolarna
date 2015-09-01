<?php

namespace Poolarna\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;

use Poolarna\Http\Requests;
use Poolarna\Http\Controllers\Controller;
use Poolarna\Participant;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|digits_between:1,255',
            'event_id' => 'required|digits_between:1,255'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $event = new Participant();

        $event->user_id = $request->user_id;
        $event->event_id = $request->event_id;

        $event->save();

        return back()
            ->with('status', 'You have signed up!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {

        $participant = Participant::where('user_id', '=', $request->user_id)
                ->where('event_id', '=', $request->event_id);

        $participant->delete();

        return back()
            ->with('status', 'You have been removed!');

    }

}
