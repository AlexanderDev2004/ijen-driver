@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <form method="POST" action="{{ route('admin.login.post') }}">

            @csrf
            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
        </form>
    </div>
</div>
@endsection
