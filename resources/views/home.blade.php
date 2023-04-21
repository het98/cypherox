@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="main">
        <center>
  <a href="{{route('product.index')}}" class="btn btn-primary">Product</a>
  @if(Auth::user()->role == 1)
  <a href="{{route('category.index')}}" class="btn btn-primary">Category</a></br>
  @endif
        </center>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection
