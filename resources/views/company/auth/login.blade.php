@extends('layouts.company.login.app')

@section('title', 'Company Login')

@section('content')

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="mb-0"><b>Company Login</b></h1>
            </div>
            <div class="card-body login-card-body">

                <form action="{{ route('company.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginEmail" type="email" name="email" class="form-control" value="" placeholder="" />
                            <label for="loginEmail">Email</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                    </div>

                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input id="loginPassword" type="password" name="password" class="form-control" placeholder="" />
                            <label for="loginPassword">Password</label>
                        </div>
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
    