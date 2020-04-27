@extends('admin.app')


@section('title')
{{$pageTitle}}
@endsection

@section('content')
<div class="app-title">
  <div>
  <h1><i class="fa fa-dashboard"></i> {{$pageTitle}}</h1>
  <p>{{$subTitle}}</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item"><a href="#">{{$pageTitle}}</a></li>
  </ul>
</div>

    
@include('admin.partials.flashMessage')
<div class="row">
  <div class="col-md-8 mx-auto">
      <div class="tile">
          <h3 class="tile-title">{{ $subTitle }}</h3>
          <form action="{{ route('admin.brand.store') }}" method="POST" role="form" enctype="multipart/form-data">
              @csrf
              <div class="tile-body">
                  <div class="form-group">
                      <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                      <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name') }}"/>
                      @error('name') {{ $message }} @enderror
                  </div>
                  <div class="form-group">
                      <label class="control-label">Brand Logo</label>
                      <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo"/>
                      @error('logo') {{ $message }} @enderror
                  </div>
              </div>
              <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Brand</button>
                  &nbsp;&nbsp;&nbsp;
                  <a class="btn btn-secondary" href="{{ route('admin.brand.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection