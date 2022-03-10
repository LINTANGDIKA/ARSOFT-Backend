@extends('Layouts.Layout')
@section('content')
@include('Partials.Navbar')
<div class="container">
    <a href="/add/data" style="text-decoration: none; color: white">
        <button class="btn btn-primary mt-5 ">
        <i class="bi bi-plus-lg"></i>
        &nbsp;
        Add Data
    </button></a>
    <table class="table mt-5 ">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Detail</th>
            <th scope="col">Status</th>
            <th class="col"></th>
            <th class="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $item['id'] }}</th>
                <td>{{ $item['title'] }}</td>
                <td>{{ $item['detail'] }}</td>
                <td>{{ $item['status'] }}</td>
                <td><button class="btn btn-warning"><a href="/update/data/{{ $item['id'] }}" class="link">Update Data</a></button></td>
                <td><button class="btn btn-danger"><a href="/delete/data/{{ $item['id'] }}" class="link">Delete Data</a></button></td>
                <td><button class="btn btn-primary"><a href="/done/{{ $item['id'] }}" class="link">Done</a></button></td>
                <td><button class="btn btn-warning"><a href="/onchange/{{ $item['id'] }}" class="link">On Change</a></button></td>
              </tr>
            @endforeach

        </tbody>
      </table>
</div>
@endsection
