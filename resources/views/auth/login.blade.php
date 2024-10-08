@extends('layouts.app')
@section('title','login')

@section('content')

<div class='container '>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                  <form action="{{route('dashboard.login.submit') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                         <label for="email" class="form-label">Email address</label>
                         <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="text-center">

                        <button type="submit" class="btn btn-primary w-50">Login</button>
                    </div>

                  </form>
                </div>
              </div>

            </div>
        </div>
    </div>
</div>
