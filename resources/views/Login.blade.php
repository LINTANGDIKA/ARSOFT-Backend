@extends('Layouts.Layout')
@section('content')
<div class="admin">
    <div class="imageContent">
        <h1 class="bi bi-person-circle text-center titleAdmin"></h1>
    </div>
    <div class="formLogin">
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                    required>
            </div>
            <div class="mb-5">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <button type="submit" class="btnuseremail">Submit</button>
        </form>
    </div>
</div>
@endsection

