@extends('layouts.app') 

@section('title', 'Company Login')

@section('content')
<div class="login-container">
    <div class="login-form">
        <h2>Company Login</h2>
        <form action="{{ route('company.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="company_code">Company Code</label>
                <input type="text" name="company_code" id="company_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection