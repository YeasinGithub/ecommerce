@extends('layouts.admin_master')
@section('brands')
    active

@endsection
@section('admin_content')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Ecommerce</a>
        <span class="breadcrumb-item active">Brands</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm">
          <div class="col-md-8">
            <div class="card pd-20 pd-sm-40">
          <div class="card-header">Brand List</div>
          <div class="card-body">
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-25p">Brand Image</th>
                  <th class="wd-25p">Brand Name Eng</th>
                  <th class="wd-25p">Brand Name Ban</th>
                  <th class="wd-25p">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($brands as $brand)
                <tr>
                  <td>
                    <img src="{{asset($brand->brand_image)}}" style="width: 100px; height: 60px;">
                  </td>
                  <td>{{$brand->brand_name_en}}</td>
                  <td>{{$brand->brand_name_bn}}</td>
                  <td>
                    <a href="{{url('admin/brand-edit/'.$brand->id)}}" class="btn btn-info btn-sm" title="edit"><i class="fa fa-pencil"></i></a>

                    <a href="{{url('admin/brand-delete/'.$brand->id)}}" class="btn btn-danger btn-sm" title="delete" id="delete"><i class="fa fa-trash"></i></a>
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
              <div class="card-header">Add New Brand +</div>
              <div class="card-body">
                <form method="post" action="{{route('brand-store')}}" enctype="multipart/form-data">
                  @csrf
                <div class="form-group">
                  <label class="form-control-label">Brand Name English: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="brand_name_en" value="{{old('brand_name_en')}}" placeholder="Enter Brand Name">

                  @error('brand_name_en')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Brand Name Bangla: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="brand_name_bn" value="{{old('brand_name_bn')}}" placeholder="Enter Enter Brand Name">

                  @error('brand_name_bn')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-control-label">Brand Image: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="file" name="brand_image">

                  @error('brand_image')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-layout-footer">
                  <button type="submit" class="btn btn-info" style="cursor: pointer;">Add New</button>
                </div><!-- form-layout-footer -->
              </form>
              </div>
            </div>
          </div>


        </div><!-- row -->

        <!-- row -->

      </div><!-- sl-pagebody -->
    </div>
@endsection
