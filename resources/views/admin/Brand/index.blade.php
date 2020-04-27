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
  <div class="col-md-12">
      <div class="tile">
          <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                  <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Slug </th>
                      <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($brands as $brand)
                      <tr>
                          <td>{{ $brand->id }}</td>
                          <td>{{ $brand->name }}</td>
                          <td>{{ $brand->slug }}</td>
                          <td class="text-center">
                              <div class="btn-group" role="group" aria-label="Second group">
                                  <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                  <a href="{{ route('admin.brand.delete', $brand->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                              </div>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

@endsection