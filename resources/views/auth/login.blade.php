@extends('layouts.master')

@section('title')
  Sign in
@endsection

@section('content')

    <main class="col-sm-12 content">

        <h1>Sign in</h1>

        {!! Form::open(array('url' => 'auth/login')) !!}
            <div class="form-group">
                {!! Form::label('email', 'Email address') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Your email address']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your password']) !!}
              </div>

              <p>Don't have an account? <a href="/auth/register">Create one here.</a></p>

              {!! Form::button('Sign in', ['class' => 'btn btn-default', 'type' => 'submit']) !!}

        {!! Form::close() !!}

    </main>
@endsection

