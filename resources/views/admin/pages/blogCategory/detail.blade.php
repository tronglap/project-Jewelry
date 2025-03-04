@extends('admin.layouts.master')

@section('title')
    {{ $data['name'] }}
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0 text-gray-800">Blog Category Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Blog Category Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            @if (session('danger'))
                                <div class="alert alert-danger">{{ session('danger') }}</div>
                            @endif
                            <div class="card-footer" style="background: transparent">
                                <a href="{{ route('admin.blogCategories.index') }}">
                                    <button type="submit" class="btn btn-primary">Back to list</button>
                                </a>
                            </div>
                            <!-- form start -->
                            <form role="form" method="post"
                                action="{{ route('admin.blogCategories.update', ['blogCategory' => $data->id]) }}">
                                <div class="card-body">
                                    <p>Created at: {{ $data['created_at'] }}</p>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') ?? $data['name'] }}"
                                            class="form-control" id="name" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="{{ old('slug') ?? $data['slug'] }}"
                                            class="form-control" id="slug" placeholder="Enter slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="">---Please Select---</option>
                                            <option {{ old('status') ?? $data['status'] == '1' ? 'selected' : '' }}
                                                value="1">Show
                                            </option>
                                            <option {{ old('status') ?? $data['status'] == '0' ? 'selected' : '' }}
                                                value="0">Hide
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                var name = $(this).val();

                $.ajax({
                    method: 'POST', //method of form
                    url: "{{ route('admin.blogCategories.slug') }}", // action of form
                    data: {
                        slug: name,
                        _token: '{{ csrf_token() }}'
                    }, //input name
                    success: function(result) {
                        $('#slug').val(result.slug);
                    }
                })
            })
        });
    </script>
@endsection
