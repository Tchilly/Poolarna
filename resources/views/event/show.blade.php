@extends('layouts.master')

@section('title')
    {{ $event->name }}
@endsection

@section('content')

    <main class="content col-sm-8">
        <h1>{{ $event->name }}
            <small>
                @if(Auth::user()->id == $event->user_id)
                    <a href="/event/{{$event->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                    <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#remove-event">Remove</a>
                @endif
                <a href="/api/v1/event/get/{{ $event->id }}" class="btn btn-default btn-xs">JSON output</a>
            </small>
        </h1>
        <p class="lead">{{ $event->description }}</p>
        <ul>
            <li>Date: {{ $event->event_date }}</li>
            <li>Time: {{ date('H:i', strtotime($event->event_time)) }}</li>
            <li>Place: {{ $event->event_place }}</li>
            <li>Created by: {{ $event->user->name }}</li>
            @if ($event->checkAvailability($event->id))
                <li>Availability: {{ $event->showAvailability() }} of {{ $event->availability }}</li>
            @else
                <li>Availability: Full</li>
            @endif
        </ul>

        @if (count($event->participants) > 0)

            <h2>Participants</h2>
            <ul>
            @foreach ($event->participants as $participant)
                <li>{{ $participant->user->name }}</li>
            @endforeach
            </ul>

        @endif

    </main>

    <aside class="sidebar col-sm-4">

        @if (Auth::check())

            @if ($event->checkParticipantion($event->id))

                <section class="block">
                    <div class="content well">
                        {!! Form::open(array('action' => 'ParticipantController@destroy', 'method' => 'delete')) !!}

                            {!! Form::hidden('user_id', Auth::user()->id) !!}
                            {!! Form::hidden('event_id', $event->id) !!}
                            {!! Form::button('Remove me from this event', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}

                        {!! Form::close() !!}

                    </div>
                </section>

            @else

                <section class="block">
                    <div class="content well">

                        @if ($event->checkAvailability($event->id))
                            {!! Form::open(array('action' => 'ParticipantController@store')) !!}

                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                                {!! Form::hidden('event_id', $event->id) !!}
                                {!! Form::button('Sign up', ['class' => 'btn btn-success', 'type' => 'submit']) !!}

                            {!! Form::close() !!}
                        @else

                            <a href="#" class="btn btn-default disabled">Full</a>

                        @endif

                    </div>
                </section>

            @endif

        @else

            <section class="block">
                <div class="content well">
                    <p>You need to <a href="/auth/login">sign in</a> in order to sign up. Don't have an account? That sucks.. <a href="/auth/register">Create one here</a> </p>
                </div>
            </section>

        @endif



    </aside>

    <!-- Modal -->
    <div class="modal fade" id="remove-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Sure you want to delete the event; {{ $event->name }} ?</h4>
          </div>
          <div class="modal-body">
            <p>This will permanently remove the event {{ $event->name }}.</p>
            <p>You will not be able to get this event back.</p>
          </div>
          <div class="modal-footer">
            {!! Form::open(array('action' => ['EventController@destroy', $event->id], 'method' => 'delete')) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::button('Remove event', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

@endsection
