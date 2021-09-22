@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="card card-default">
    <div class="card-header">
        Categories
    </div>
    <div class="card-body">
      @if ($categories->count() > 0)
      <table class="table">
        <thead>
            <th>Name</th>
            <th>Posts Count</th>
            <th>Action</th>

        </thead>
        <tbody>
            @foreach ($categories as $category  )
            <tr>
                <td>{{$category->name}}</td>
                <td>{{$category->posts->count()}}</td>
                <td>
                    <div class="button-group d-flex">
                    <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-info">Edit</a>
                     <button class="btn btn-sm btn-danger" onclick="handleDelete({{$category->id}})">Delete</button>
                    </div>
                </td>
            </tr>




            @endforeach

        </tbody>
    </table>
      @else
      <h3 class="text-center">No Category Yet</h3>

      @endif
        <form action="" method="POST" id="deleteCategoryForm">
            @csrf
            @method('DELETE')

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are You sure to Delete This Category?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                      <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
    </div>
</div>

@endsection



@section('scripts')

<script>
function handleDelete(id){
    var form = document.getElementById('deleteCategoryForm')
    form.action = '/categories/' + id

    $('#deleteModal').modal('show')
}
</script>

@endsection
