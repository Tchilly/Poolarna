@extends('layouts.master')

@section('title')
    All events
@endsection

@section('content')

    <main class="col-sm-12 content">
        <h1>All events</h1>

        @if (count($events) > 0)
            <table class="table table-striped">
            @foreach ($events as $event)
                <tr>
                    <td><a href="/event/{{ $event->id }}">{{ $event->name }}</a></td>
                    <td>{{ $event->showAvailability($event->id) }} of {{ $event->availability }} available</td>
                    <td>{{ $event->event_date }} {{ date('H:i', strtotime($event->event_time)) }}</td>
                    <td>
                        @if (Auth::check())
                            @if ($event->checkParticipantion($event->id))

                                {!! Form::open(array('action' => 'ParticipantController@destroy', 'method' => 'delete')) !!}

                                    {!! Form::hidden('user_id', Auth::user()->id) !!}
                                    {!! Form::hidden('event_id', $event->id) !!}
                                    {!! Form::button('Remove me', ['class' => 'btn btn-danger btn-sm', 'type' => 'submit']) !!}

                                {!! Form::close() !!}
                            @else

                                @if ($event->checkAvailability($event->id))
                                    {!! Form::open(array('action' => 'ParticipantController@store')) !!}

                                        {!! Form::hidden('user_id', Auth::user()->id) !!}
                                        {!! Form::hidden('event_id', $event->id) !!}
                                        {!! Form::button('Sign up', ['class' => 'btn btn-success btn-sm', 'type' => 'submit']) !!}

                                    {!! Form::close() !!}
                                @else

                                    <a href="#" class="btn btn-default disabled btn-sm">Full</a>

                                @endif

                            @endif
                        @else
                            <a href="/event/{{ $event->id }}" class="btn btn-success btn-sm">Sign in to sign up</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </table>

        @else

            <p class="lead">Nothing here yet, <a href="/event/create">why not start an event</a>?</p>

        @endif

        <div class="pull-right">
            <a href="/api/v1/event/get/all" class="btn btn-default btn-xs">JSON output</a>
        </div>

    </main>
@endsection

