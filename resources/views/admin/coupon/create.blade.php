@extends('layouts.admin_master')
@section('coupon')
    active
@endsection
@section('admin_content')
     <!-- ########## START: MAIN PANEL ########## -->
     <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">SHopMama</a>
          <span class="breadcrumb-item active">Coupon</span>
        </nav>

        <div class="sl-pagebody">
          <div class="row row-sm">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">Coupon List</div>
                <div class="card-body">
                <div class="table-wrapper">
                  <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Coupon Name</th>
                        <th class="wd-25p">Coupon Discount</th>
                        <th class="wd-25p">Validity</th>
                        <th class="wd-25p">Status</th>
                        <th class="wd-20p">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($coupons as $item)
                      <tr>
                        <td>{{ $item->coupon_name }}</td>
                        <td>{{ $item->coupon_discount }}%</td>
                        <td>
                            {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
                            </td>
                        <td>
                            @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                            <span class="badge badge-pill badge-success">Valid</span>
                          @else
                          <span class="badge badge-pill badge-danger">Invalid</span>
                        @endif
                    </td>
                        <td>
                          <a href="{{ url('admin/coupon-edit/'.$item->id) }}" class="btn btn-sm btn-primary" title="edit data"> <i class="fa fa-pencil"></i></a>

                          <a href="{{ url('admin/coupon-delete/'.$item->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data"><i class="fa fa-trash"></i></a>
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
                <div class="card-header">Add New Coupon</div>
                  <div class="card-body">
                <form action="{{ route('coupon-store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label class="form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="coupon_name" value="{{ old('coupon_name') }}" placeholder="Enter coupon name">
                      @error('coupon_name')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Coupon Discount(%) <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="coupon_discount" value="{{ old('coupon_discount') }}" placeholder="Enter coupon discount" min="1" max="99">
                      @error('coupon_discount')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Coupon Validity Date <span class="tx-danger">*</span></label>
                        <input class="form-control" type="date" name="coupon_validity" value="{{ old('coupon_validity') }}"  min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        @error('coupon_validity')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      </div>


                    <div class="form-layout-footer">
                      <button type="submit" class="btn btn-info">Add New</button>
                    </div><!-- form-layout-footer -->
                  </form>
                  </div>
              </div>
            </div>
          </div>
        </div>


    </div>
@endsection
