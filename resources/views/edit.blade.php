@extends('main')
@section('content')
    <div class="container mt-5">
        <h5>Edit Food</h5>

        <form class="forms-sample mt-3" action="/update/{{ $food->id }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    aria-describedby="emailHelp" autofocus required value="{{ old('name', $food->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="3" required>{{ old('description', $food->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea type="text" class="form-control @error('ingredients') is-invalid @enderror" id="ingredients"
                    name="ingredients" rows="3" required>{{ old('ingredients', $food->ingredients) }}</textarea>
                @error('ingredients')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                    name="price" value="{{ old('price', $food->price) }}" required>
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rate" class="form-label">Rate</label>
                <input type="number" class="form-control @error('rate') is-invalid @enderror" id="rate" name="rate"
                    value="{{ old('rate', $food->rate) }}" required>
                @error('rate')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="types" class="form-label">Types</label>
                <input type="text" class="form-control @error('types') is-invalid @enderror" id="types" name="types"
                    value="{{ old('types', $food->types) }}" required>
                @error('types')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary mr-2"><i class="ti-save"></i>
                    Save</button>
                <a href="/" class="btn btn-danger"><i class="ti-close"></i>
                    Cancel</a>
            </div>
        </form>
    </div>
@endsection
