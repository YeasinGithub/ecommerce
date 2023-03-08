@extends('layouts.admin_master')
@section('categories')
    active show-sub

@endsection
@section('add-category')
    active

@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Ecommerce</a>
        <span class="breadcrumb-item active">Catogories</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
          <div class="col-md-8">
            <div class="card pd-20 pd-sm-40">
          <div class="card-header">Category List</div>
          <div class="card-body">
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-25p">Category Icon</th>
                  <th class="wd-25p">Category Name Eng</th>
                  <th class="wd-25p">Category Name Ban</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td>
                    <span><i class="{{ $category->category_icon }}"></i></span>
                  </td>
                  <td>{{$category->category_name_en}}</td>
                  <td>{{$category->category_name_bn}}</td>
                  <td>
                    <a href="{{url('admin/category-edit/'.$category->id)}}" class="btn btn-info btn-sm" title="edit"><i class="fa fa-pencil"></i></a>

                    <a href="{{url('admin/category-delete/'.$category->id)}}" class="btn btn-danger btn-sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
                 </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
        </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">Add New Category +</div>
              <div class="card-body">
                <form method="post" action="{{route('category-store')}}">
                  @csrf
                <div class="form-group">
                  <label class="form-control-label">Category Icon: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="category_icon" value="{{old('category_icon')}}" placeholder="Enter Category Icon">

                  @error('category_icon')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Category Name English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="category_name_en" value="{{old('category_name_en')}}" placeholder="Enter Category Name Eng">

                  @error('category_name_en')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Category Name Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="category_name_bn" value="{{old('category_name_bn')}}" placeholder="Enter Category Name Ban">

                  @error('category_name_bn')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-layout-footer">
                  <button type="submit" name="submit" class="btn btn-info" style="cursor: pointer;">Add Category</button>
                </div><!-- form-layout-footer -->
              </form>
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>
@endsection
