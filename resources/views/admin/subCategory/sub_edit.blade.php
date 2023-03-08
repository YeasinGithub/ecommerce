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
    <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Ecommerce</a>
    <span class="breadcrumb-item active">Sub Category Update</span>
  </nav>

  <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Update Sub Category</h6>
        <form action="{{ route('update-sub-category') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $editSubCats->id }}">
        <div class="row row-sm">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="form-control-label">Select Category: <span class="tx-danger">*</span></label>
                  <select class="form-control select2-show-search" data-placeholder="Select One" name="category_id">
                  <option label="Choose one"></option>
                  @foreach($categories as $cat)
                  <option value="{{$cat->id}}" {{ $cat->id == $editSubCats->category_id ? 'selected': '' }}>{{ ucwords($cat->category_name_en) }}</option>
                  @endforeach
                </select>
                    </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="form-control-label">Sub Category Name English: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="subcategory_name_en" value="{{ $editSubCats->subcategory_name_en }}" placeholder="Category Name English">
                      @error('subcategory_name_en')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
              </div>  

              <div class="col-md-4">
                  <div class="form-group">
                      <label class="form-control-label">Sub Category Name Bangla: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="subcategory_name_bn" value="{{ $editSubCats->subcategory_name_bn }}" placeholder="Category Name Bangla">
                      @error('subcategory_name_bn')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
              </div> 
        <div class="form-layout-footer mt-3">
          <button class="btn btn-info mg-r-5" type="submit" style="cursor: pointer;">Update Data</button>
        </div><!-- form-layout-footer -->
        </div><!-- form-layout-footer -->
      </form>
      </div>
      </div> 


    </div>
@endsection
