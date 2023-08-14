@extends('template')

@section('css')
  {!! loadDataTableCss(); !!}
@endsection

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Category</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Add Category</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form name="categoryForm" data-url="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category" autocomplete="off" >
                </div>
                <div class="form-group">
                  <label for="category_name">Image (200kb)</label>
                  <div class="custom-file">
                    <input type="file" name="category_image" id="category_image" class="custom-file-input" id="category_image" accept="image/*" >
                    <label class="custom-file-label" for="category_image">Choose file</label>
                  </div>
                </div>
                <div class="col-sm-12" id="show_image">
                  {{-- <img src="" style="height:200px;width:100%;border:1px solid; padding:5px;"> --}}
                </div>
                <div class="col-sm-12 mt-4">
                  <button type="submit" class="float-right btn btn-primary">Submit</button>  
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="categoryTable" class="table table-bordered table-striped" data-url="{{route('category.create')}}">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th style="width:100px !important;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection

  @section('script')
  {!! loadDataTableJs() !!}
  <script type="text/javascript" src="{{ url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script type="text/javascript" src="{{url('assets/dist/js/custom/category.js')}}"></script>

  @endsection