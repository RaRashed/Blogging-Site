@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="card card-default">
    <div class="card-header">
        Tags
    </div>
    <div class="card-body">
      @if ($tags->count() > 0)
      <table class="table">
        <thead>
            <th>Name</th>

            <th>Action</th>

        </thead>
        <tbody>
            @foreach ($tags as $tag  )
            <tr>
                <td>{{$tag->name}}</td>
                <td>{{$tag->posts->count()}}</td>

                <td>
                    <div class="button-group d-flex">
                    <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-sm btn-info">Edit</a>
                     <button class="btn btn-sm btn-danger" onclick="handleDelete({{$tag->id}})">Delete</button>
                    </div>
                </td>
            </tr>




            @endforeach

        </tbody>
    </table>
      @else
      <h3 class="text-center">No tag Yet</h3>

      @endif
        <form action="" method="POST" id="deleteTagForm">
            @csrf
            @method('DELETE')

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are You sure to Delete This Tag?
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
    var form = document.getElementById('deleteTagForm')
    form.action = '/tags/' + id

    $('#deleteModal').modal('show')
}
</script>

@endsection
