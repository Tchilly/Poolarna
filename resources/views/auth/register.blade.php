@extends('layouts.master')

@section('title')
  Register
@endsection

@section('content')

    <main class="col-sm-12 content">

        <h1>Register</h1>

        {!! Form::open(array('url' => 'auth/register')) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Your full name']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Your email address']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your password']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Password confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password']) !!}
            </div>

              {!! Form::button('Register', ['class' => 'btn btn-success', 'type' => 'submit']) !!}

        {!! Form::close() !!}

    </main>

@endsection

