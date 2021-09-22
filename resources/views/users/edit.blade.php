@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My Profile</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif





      <form action="{{route('users.update-profile')}}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
          </div>
          <div class="form-group">
            <label for="about">About Me</label>
            <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{$user->about}}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Profile</button>

      </form>
    </div>
</div>
@endsection
