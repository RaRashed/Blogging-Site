@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        {{isset($tag) ? 'Edit tag' : 'Create tag'}}

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="card-body">
        <form action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}" method="post">

            @csrf
            @if (isset($tag))
            @method('PUT')

            @endif

           <div   class="from-group">
            <label for="name">Name</label>

            <input type="text" id="name" class="form-control" name="name" value="{{isset($tag) ? $tag->name : ''}}">

           </div>

           <div class="form-group">

               <button class="btn btn-success mb-2">
                   {{isset($tag) ? 'Update tag' : 'Add tag'}}
               </button>
           </div>
        </form>
    </div>
</div>

@endsection
