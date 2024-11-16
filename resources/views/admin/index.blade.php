@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body" style="text-align: center";>
                <h1>Selamat Datang {{ Auth::user()->nama }}</h1>
            </div>
        </div>
    </div>
@endsection
