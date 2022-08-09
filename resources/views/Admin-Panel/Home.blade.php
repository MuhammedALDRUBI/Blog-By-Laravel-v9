@extends('layouts.admin-dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Welcome To Your Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6>You are logged in! , Chose An Operation To do from Navbar</h6>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
