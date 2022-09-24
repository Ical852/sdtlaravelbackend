@extends('main')
@section('content')
    <div class="container mt-5">
        <h5>Edit Food</h5>

        <form class="forms-sample mt-3" action="/updatepic/{{ $food->id }}" method="POST" enctype="multipart/form-data">
            @csrf

            <p>Current Image : </p>
            <img src="{{ $food->picture_path }}" alt="" srcset="" style="width: 100px">

            <div class="form-group mt-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    value="{{ old('image') }}" required>
                @error('image')
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
