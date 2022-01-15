@extends('layouts.app')

@section('content')


@if (Auth::user() && Auth::user()->role=="ADMIN")
<div class="mb-5 ">
    <a class="btn btn-success" href="{{route("category.create");}}">
        CREATE NEW
    </a>
</div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Meta description</th>
            <th scope="col">Description</th>
            <th scope="col">Tag</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
          <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->meta_denumire}}</td>
            <td>{{$category->descriere}}</td>
            <td>{{$category->tag}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('category.edit', $category->id);}}" >EDIT</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategoryModal{{$category->id}}">
                    DELETE
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="deleteCategoryModal{{$category->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Delete category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to do that ?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        <form action="{{route('category.destroy', $category->id);}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-primary" >YES</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
    
    </table>
      
    @elseif(Auth::user() && Auth::user()->role=="CUSTOMER")

    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$category->name}}</h5>
                                <p class="card-text">{{$category->descriere}}</p>
                                <a href="{{route("category.show", $category->id)}}" class="btn btn-primary">Product list</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @endif
@endsection