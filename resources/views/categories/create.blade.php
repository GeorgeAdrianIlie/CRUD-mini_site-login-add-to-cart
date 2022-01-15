@extends('layouts.app')

@section('content')

<div class="card" style="width: 58rem;">
<form action="{{route("category.store")}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name" class="ml-4 mt-3">Name</label>
      <input name="name" type="text" id="name" class="form-control ml-3 mr-3 w-75" placeholder="Enter category name">
    </div>
    <div class="form-group">
        <label for="meta_denumire" class="ml-4 mt-2 ">Meta_denumire</label>
        <input name="meta_denumire" type="text" id="meta_denumire" class="form-control ml-3 mr-3 w-75" placeholder="Enter category meta_denumire">
      </div>
      <div class="form-group" >
        <label for="descriere" class="ml-4 mt-2">Descriere</label>
        <input name="descriere" type="text" id="descriere" class="form-control ml-3 mr-3 w-75" placeholder="Enter category descriere">
      </div>
      <div class="form-group">
        <label for="tag" class="ml-4 mt-2">Tag</label>
        <input name="tag" type="text" id="tag" class="form-control ml-3 mr-3 w-75" placeholder="Enter category tags">
      </div>
      <button class="btn btn-primary mt-2 ml-5 mb-3 " type="submit">Submit</button>
  </form>
  </div>
@endsection