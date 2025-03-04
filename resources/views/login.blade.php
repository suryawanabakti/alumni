@extends('components.layouts.master')

@section('content')
    <div class="min-vh-100 d-flex justify-content-center align-items-center bg-light">
        <div class="card shadow-lg p-4 w-100" style="max-width: 400px;">
            <h2 class="text-center text-primary mb-4">Alumni Login</h2>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">NIM </label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

        </div>
    </div>
@endsection
