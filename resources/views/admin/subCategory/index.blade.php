@extends('layouts.admin_master')
@section('categories')
    active show-sub

@endsection
@section('subcategory')
    active

@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Ecommerce</a>
        <span class="breadcrumb-item active">Sub Catogory</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
          <div class="col-md-8">
            <div class="card pd-20 pd-sm-40">
          <div class="card-header">Sub Category List</div>
          <div class="card-body">
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-25p">Category Name</th>
                  <th class="wd-25p">Sub Category Eng</th>
                  <th class="wd-25p">Sub Category Ban</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subCategories as $subCat)
                <tr>
                  <td>{{$subCat->category->category_name_en}}</td>
                  <td>{{$subCat->subcategory_name_en}}</td>
                  <td>{{$subCat->subcategory_name_bn}}</td>
                  <td>
                    <a href="{{url('admin/sub-category-edit/'.$subCat->id)}}" class="btn btn-info btn-sm" title="edit"><i class="fa fa-pencil"></i></a>

                    <a href="{{url('admin/sub-category-delete/'.$subCat->id)}}" class="btn btn-danger btn-sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
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
              <div class="card-header">Add New Sub Category +</div>
              <div class="card-body">
                <form method="post" action="{{route('sub-category-store')}}">
                  @csrf
                <div class="form-group">
                  <label class="form-control-label">Select Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2-show-search" data-placeholder="Select One" name="category_id">
                  <option label="Choose one"></option>
                  @foreach($categories as $cat)
                  <option value="{{$cat->id}}">{{ ucwords($cat->category_name_en) }}</option>
                  @endforeach
                </select>

                  @error('category_id')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Sub Category Name English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="subcategory_name_en" value="{{old('subcategory_name_en')}}" placeholder="Enter Sub Category Name Eng">

                  @error('subcategory_name_en')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Sub Category Name Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="subcategory_name_bn" value="{{old('subcategory_name_bn')}}" placeholder="Enter Sub Category Name Ban">

                  @error('subcategory_name_bn')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-layout-footer">
                  <button type="submit" name="submit" class="btn btn-info" style="cursor: pointer;">Add New</button>
                </div><!-- form-layout-footer -->
              </form>
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>
@endsection
