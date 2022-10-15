@extends('includes.mainTemplate')
@section('content')
    <div class="card mx-auto mt-5 w-50">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <form action="{{ route('user.store') }}" method="POST" class="p-3">
            <fieldset>
                @csrf
                <legend>User Register</legend>
                <div class="row">
                    <div class="col-9 form-group">
                        <label for="name">User Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="col-9 form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email"
                            value="{{ old('email') }}">
                    </div>
                    <div class="col-9 form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="col-9 form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary col-4">Register</button>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
