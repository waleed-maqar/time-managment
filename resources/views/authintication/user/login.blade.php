@extends('includes.mainTemplate')
@section('content')
    <div class="card mx-auto mt-5 w-50">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        @if (session()->has('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form action="{{ route('user.login') }}" method="POST" class="p-3">
            <fieldset>
                @csrf
                <legend>User Log-in</legend>
                <div class="row">
                    <div class="col-9 form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="col-9 form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-success col-4">Login</button>
                </div>

            </fieldset>
        </form>
    </div>
@endsection
