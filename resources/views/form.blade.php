@extends('Layouts.Layout')
@section('content')
@include('Partials.Navbar')
<div class="container">
    <h1 class="text-center mt-5">Add New Data</h1>
    <form style="padding: 0 10rem" method="POST">
        @csrf
        @if ($data == false)
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="">
          </div>
          <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <input type="text" class="form-control" id="detail" name="detail" style="height: 5rem"  value="">
          </div>
        @else
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="{{ $data->title }}">
          </div>
          <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <input type="text" class="form-control" id="detail" name="detail" style="height: 5rem"  value="{{ $data->detail }}">
          </div>
        @endif

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection
