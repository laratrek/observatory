@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('alert-success') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $site)
                                <tr>
                                    <th>{{ $site->id }}</th>
                                    <th>{{ $site->name }}</th>
                                    <th>{{ $site->url }}</th>
                                    <th>
                                        @foreach ($site->pings as $ping)
                                            <span class="badge badge-{{ $ping->status_code == 200 ? 'success' : 'danger' }}">
                                                {{ $ping->status_code != 0 ? $ping->status_code : 'Fatal' }}
                                            </span>
                                        @endforeach
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
