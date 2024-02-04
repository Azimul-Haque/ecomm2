@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-2">
      <div class="row">
        <div class="btn-group-vertical col-md-12" role="group" aria-label="...">
          <button type="button" class="btn btn-success btn-block">
            <i class="fa fa-tachometer" aria-hidden="true"></i> Admin Dashboard<br/> {{ date('F d, Y') }}</button>
          <a href="{{ route('warehouse.dashboard') }}" class="btn btn-default btn-block">Dashboard</a>
          <a href="{{ route('warehouse.dueorders') }}" class="btn btn-default btn-block"><i class="fa fa-list-ol" aria-hidden="true"></i> Pending Orders <span class="label label label-primary">{{ $due_orders }}</span></a>
          <a href="{{ route('warehouse.deliveredorders') }}" class="btn btn-default btn-block"><i class="fa fa-list-ul" aria-hidden="true"></i> Delivered Orders <span class="label label label-primary">{{ $completed_orders }}</span></a>
          <a href="{{ route('warehouse.addproduct') }}" class="btn btn-default btn-block"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
          <a href="{{ route('warehouse.categories') }}" class="btn btn-default btn-block"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Categories</a>
          <a href="{{ route('warehouse.customers') }}" class="btn btn-default btn-block"><i class="fa fa-users" aria-hidden="true"></i> Customer List</a>
          <a href="#" class="btn btn-default btn-block"><i class="fa fa-line-chart" aria-hidden="true"></i> Report</a>
          <a href="#" class="btn btn-default btn-block"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
        </div>
      </div>
    </div>
    <div class="col-md-10">
      @yield('warehousecontent')
    </div>
  </div>
@endsection