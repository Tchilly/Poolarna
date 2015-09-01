@extends('layouts.master')

@section('title')
  Create an event
@endsection

@section('content')
    <main class="col-sm-12 content">
        <h1>Create an event</h1>

        {!! Form::open(array('action' => 'EventController@store')) !!}
            <div class="form-group">
                {!! Form::label('name', 'Event name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Event name']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 4]) !!}
              </div>
              <div class="form-group">
                {!! Form::label('availability', 'Availability') !!}
                {!! Form::number('availability', old('availability'), ['class' => 'form-control', 'placeholder' => '4']) !!}
                <p class="help-block">Number of seats availible, exclude the driver.</p>
              </div>
              <div class="form-group">
                {!! Form::label('event_date', 'Date of event') !!}
                {!! Form::date('event_date', old('event_date'), ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) !!}
                <p class="help-block">Event date, yyyy-mm-dd</p>
              </div>
              <div class="form-group">
                {!! Form::label('event_time', 'Time of event') !!}
                {!! Form::time('event_time', old('event_time'), ['class' => 'form-control', 'placeholder' => 'HH:MM']) !!}
                <p class="help-block">Event date, hh:mm</p>
              </div>
              <div class="form-group">
                {!! Form::label('event_place', 'Place of event') !!}
                {!! Form::text('event_place', old('event_place'), ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                <p class="help-block">Place of the event, ex. an address.</p>
              </div>
              {!! Form::button('Create the event', ['class' => 'btn btn-success btn-lg', 'type' => 'submit']) !!}
        {!! Form::close() !!}

    </main>
@endsection

