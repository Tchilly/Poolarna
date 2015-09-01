<?php

namespace Poolarna\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

use Poolarna\Http\Requests;
use Poolarna\Http\Controllers\Controller;
use Poolarna\Event;
use Poolarna\Participant;

class EventController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // List all events
        return view('event.list', ['events' => Event::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if (Auth::check()) {

            // List all events
            return view('event.create');

        } else {

            return redirect('event')->withErrors('You need to be logged in!');

        }
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
            'name' => 'required|max:255',
            'availability' => 'required|digits_between:1,99',
            'event_date' => 'required|date_format:"Y-m-d"',
            'event_time' => 'required|date_format:"H:i"',
            'event_place' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('event/create')
                        ->withErrors($validator)
                        ->withInput();
        }


        $event = new Event();

        $event->name = $request->name;
        $event->description = $request->description;
        $event->availability = $request->availability;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->event_place = $request->event_place;
        $event->user_id = Auth::user()->id;

        $event->save();

        return redirect('event')->with('status', 'Event stored!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // List an event
        $event = Event::find($id);
        return view('event.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // List an event
        $event = Event::find($id);
        return view('event.edit', ['event' => $event]);
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
        // Update an event
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'availability' => 'required|digits_between:1,99',
            'event_date' => 'required|date_format:"Y-m-d"',
            'event_time' => 'required|date_format:"H:i"',
            'event_place' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('event/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $event = Event::findOrFail($id);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->availability = $request->availability;
        $event->event_date = $request->event_date;
        $event->event_time = $request->event_time;
        $event->event_place = $request->event_place;

        $event->save();

        return redirect('event/'.$id)->with('status', 'Event saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        // Delete the event
        $event = Event::findOrFail($id);
        $event->delete();

        // Delete all participants related to this event
        $participants = Participant::where('event_id', '=', $id);
        $participants->delete();

        return redirect('event')->with('status', 'Boom! Event gone!');

    }
}
