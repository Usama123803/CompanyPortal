@extends('layouts.company.login.app')

@section('title', 'Admin Login')

@section('content')
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" style="background-color:#d4edda;" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" style="background-color:#f5cfcf;" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h1 class="mb-0"><b>Admin Login</b></h1>
            </div>
            <div class="card-body login-card-body">

                <form action="{{ route('login') }}" method="post">
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
