@extends('main')
@section('content')
    <div class="container mt-5 mb-5">

        @if (session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a href="/create">
            <button class="btn btn-primary"><i class="fa fa-plus"></i> New Food</button>
        </a>
        <table class="table table-striped table-responsive mt-3">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Ingredients</th>
                    <th scope="col">Price</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Types</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($food as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->ingredients }}</td>
                        <td>RP. {{ number_format($item->price) }}</td>
                        <td>{{ $item->rate }}</td>
                        <td>{{ $item->types }}</td>
                        <td>
                            <img src="{{ $item->picture_path }}" alt="" height="100" width="100">
                        </td>
                        <td>
                            <a href="/edit/{{ $item->id }}">
                                <button class="btn btn-success"><i class="fa fa-edit"></i> Edit</button>
                            </a>
                            <a href="/editpic/{{ $item->id }}">
                                <button class="btn btn-info text-white mt-2 mb-2"><i class="fa fa-image"></i> Picture
                                    Edit</button>
                            </a>
                            <form action="/delete/{{ $item->id }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('delete data?')"><i class="fa fa-trash"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h5>No Data Found</h5>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
