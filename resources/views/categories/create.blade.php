@extends('layouts.app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        {{isset($category) ? 'Edit Category' : 'Create Category'}}

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
        <form action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}" method="post">

            @csrf
            @if (isset($category))
            @method('PUT')

            @endif

           <div   class="from-group">
            <label for="name">Name</label>

            <input type="text" id="name" class="form-control" name="name" value="{{isset($category) ? $category->name : ''}}">

           </div>

           <div class="form-group">

               <button class="btn btn-success mb-2">
                   {{isset($category) ? 'Update Category' : 'Add Category'}}
               </button>
           </div>
        </form>
    </div>
</div>

@endsection
