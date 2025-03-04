@extends('admin.layouts.master')

@section('title')
    List Order - {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0 text-gray-800">List Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if (session('message'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">List Order</h3>
                                <form id="searchForm" role="form" action="{{ route('admin.order.index') }}"
                                    method="GET">
                                    <div class="form-group">
                                        <label for="key">Search Order</label>
                                        <input type="text" value="{{ request()->key ?? '' }}" id="searchKey"
                                            name="key" class="form-control" placeholder="Enter order">
                                        <label for="sortBy">Sort by create at</label>
                                        <select name="sortBy" id="sortBy" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="latest" {{ request()->sortBy == 'latest' ? 'selected' : '' }}>
                                                Latest</option>
                                            <option value="oldest" {{ request()->sortBy == 'oldest' ? 'selected' : '' }}>
                                                Oldest</option>
                                        </select>
                                        <label for="sortByStatus">Sort by status</label>
                                        <select name="sortByStatus" id="sortByStatus" class="form-control">
                                            <option value="">--Please Select--</option>
                                            <option value="{{ \App\Models\Order::PENDING }}"
                                                {{ request()->sortByStatus == \App\Models\Order::PENDING ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="{{ \App\Models\Order::DELIVERED }}"
                                                {{ request()->sortByStatus == \App\Models\Order::DELIVERED ? 'selected' : '' }}>
                                                Delivered</option>
                                            <option value="{{ \App\Models\Order::SHIPPING }}"
                                                {{ request()->sortByStatus == \App\Models\Order::SHIPPING ? 'selected' : '' }}>
                                                Shipping</option>
                                            <option value="{{ \App\Models\Order::COMPLETED }}"
                                                {{ request()->sortByStatus == \App\Models\Order::COMPLETED ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="{{ \App\Models\Order::CANCELED }}"
                                                {{ request()->sortByStatus == \App\Models\Order::CANCELED ? 'selected' : '' }}>
                                                Canceled</option>
                                            <option value="{{ \App\Models\Order::REFUND }}"
                                                {{ request()->sortByStatus == \App\Models\Order::REFUND ? 'selected' : '' }}>
                                                Refund</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div id="table-content">
                                    @include('admin.pages.order.table', ['datas' => $datas])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#searchKey, #sortBy, #sortByStatus').on('input change', function() {
                let query = $('#searchKey').val();
                let sortBy = $('#sortBy').val();
                let sortByStatus = $('#sortByStatus').val();
                $.ajax({
                    url: '{{ route('admin.order.index') }}',
                    type: 'GET',
                    data: {
                        key: query,
                        sortBy: sortBy,
                        sortByStatus: sortByStatus,
                    },
                    success: function(data) {
                        $('#table-content').html(data);
                    }
                });
            });
        });
    </script>
@endsection
