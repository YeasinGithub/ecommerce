@extends('layouts.admin_master')
@section('admin_content')
@section('shipping') active show-sub @endsection
@section('add-district') active @endsection

     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">district</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">district List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Division Name</th>
                        <th class="wd-30p">district Name</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($districts as $item)
                      <tr>
                        <td>{{ $item->division->division_name }}</td>
                        <td>{{ $item->district_name }}</td>
                        <td>
                          <a href="{{ url('admin/district-edit/'.$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                          <a href="{{ url('admin/district-delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-wrapper -->
              </div>
              </div><!-- card -->
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">Add New district</div>
                  <div class="card-body">
                <form action="{{ route('district-store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-control-label">Select Division: <span class="tx-danger">*</span></label>
                        <select class="form-control select2-show-search" data-placeholder="Select One" name="division_id">
                          <option label="Choose one"></option>
                          @foreach ($divisions as $division)
                          <option value="{{ $division->id }}">{{ ucwords($division->division_name) }}</option>
                          @endforeach
                        </select>
                        @error('division_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    <div class="form-group">
                      <label class="form-control-label">district Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="district_name" value="{{ old('district_name') }}" placeholder="Enter district_name">
                      @error('district_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">district Create</button>
                    </div><!-- form-layout-footer -->
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    @endsection

