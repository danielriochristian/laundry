@extends('layout')
@section('labeladmin')
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="breadcomb-wp">
      <div class="breadcomb-icon">
          <h2>List Admin</h2>
      </div>
    </div>
  </div>
@endsection
@section('admin')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="data-table-list">
        <div class="row">
          <div class="pull-right" style="padding-right:1%;">
            <button type="button"  href="#" class="create-modal btn btn-success btn-sm"> <i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>

          <br>
          <div class="table-responsive">
      <table id="contoh" class="table table-striped table-bordered datatable">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Email</th>
            <th colspan="10%">Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div id="create" class="modal fade" role="dialog">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" role="form">
            <div class="form-group row add">
            <label class="control-label col-sm-2" for="name">Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Daniel Rio Christian" required>
            <p class="error text-center alert alert-danger hidden"></p>
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="email">E-Mail</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="webmaster@gmail.com" required>
            <p class="error text-center alert alert-danger hidden"></p>
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password Here" required>
            <p class="error text-center alert alert-danger hidden"></p>
            </div>
            </div>
            <div class="form-group">
            </div>
            </form>
            </div>
            <div class="modal-footer">
            <button class="btn btn-success btn-sm" type="submit" id="add">
            <span class="glyphicon glyphicon-plus"></span>Save
            </button>
            <button class="btn btn-warning btn-sm" type="button" data-dismiss="modal">
            <span class="glyphicon glyphicon-remobe"></span>Close
            </button>
            </div>
            </div>
            </div>
          </div>
          <div id="myModal"class="modal fade" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <form class="form-horizontal" role="modal">

                <div class="form-group">
                <label class="control-label col-sm-2"for="id">ID</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="fid" disabled>
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-2"for="name">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="n">
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-2"for="email">Email</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="e"></textarea>
                </div>
                </div>

                </form>
                {{-- Form Delete Post --}}
                <div class="deleteContent">
                Are You sure want to delete <span class="title"></span>?
                <span class="hidden id"></span>
                </div>

                </div>
                <div class="modal-footer">

                <button type="button" class="btn actionBtn btn-sm" data-dismiss="modal">
                <span id="footer_action_button" class="glyphicon"></span>
                </button>

                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">
                <span class="glyphicon glyphicon"></span>close
                </button>

                </div>
                </div>
                </div>
              </div>
  </div>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    // DataTable
    $('.datatable').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian-Alternative.json"
      },
      processing: true,
      serverSide: true,
      ajax: '{{ route('user/json') }}',
      columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });
  });
  $(document).on('click', '.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Admin');
  });
  $("#add").click(function() {
    $.ajax({
      type: 'POST',
      url: 'addPost',
      data: {
        "_token": "{{ csrf_token() }}",
        'name': $('input[name=name]').val(),
        'email': $('input[name=email]').val(),
        'password': $('input[name=password]').val()
      },
      success: function(data, status) {
        $('#create').modal('hide');
        $("#name").val(''),
        $("#email").val(''),
          $("#password").val(''),
          $('.datatable').DataTable().ajax.reload(null, false);
      },
      error: function(request, status, error) {
        console.log(request.responseJSON);
        $.each(request.responseJSON.errors, function(index, value) {
          alert(value);
        });
      }
    });
  });
  // function Edit POST
  $(document).on('click', '.edit-modal', function() {
  $('#footer_action_button').text("Update");
  $('#footer_action_button').addClass('glyphicon-check');
  $('#footer_action_button').removeClass('glyphicon-trash');
  $('.actionBtn').addClass('btn-success');
  $('.actionBtn').removeClass('btn-danger');
  $('.actionBtn').addClass('edit');
  $('.modal-title').text('Edit Admin');
  $('.deleteContent').hide();
  $('.form-horizontal').show();
  $('#fid').val($(this).data('id'));
  $('#n').val($(this).data('name'));
  $('#e').val($(this).data('email'));
  $('#myModal').modal('show');
  });
// nama field
  $('.modal-footer').on('click', '.edit', function() {
    $.ajax({
      type: 'POST',
      url: 'editPost',
      data: {
  "_token": "{{ csrf_token() }}",
  'id': $("#fid").val(),
  'name': $('#n').val(),
  'email': $('#e').val()
  // 'password': $('#ps').val()
},
success: function (data, status) {
    $('.datatable').DataTable().ajax.reload(null, false);
},
error: function (request, status, error) {
    console.log(request.responseJSON);
    $.each(request.responseJSON.errors, function( index, value ) {
      alert( value );
    });
}
});
});


  // form Delete function
  $(document).on('click', '.delete-modal', function() {
  $('#footer_action_button').text(" Delete");
  $('#footer_action_button').removeClass('glyphicon-check');
  $('#footer_action_button').addClass('glyphicon-trash');
  $('.actionBtn').removeClass('btn-success');
  $('.actionBtn').addClass('btn-danger');
  $('.actionBtn').addClass('delete');
  $('.modal-title').text('Delete Post');
  $('.id').text($(this).data('id'));
  $('.deleteContent').show();
  $('.form-horizontal').hide();
  $('.name').html($(this).data('name'));
  $('#myModal').modal('show');
  });

  $('.modal-footer').on('click', '.delete', function(){
    $.ajax({
      type: 'POST',
      url: 'deletePost',
      data: {
        "_token": "{{ csrf_token() }}",
        'id': $('.id').text()
      },
      success: function (data, status) {
                $('.datatable').DataTable().ajax.reload(null, false);
            },
            error: function (request, status, error) {
                console.log($("#id").val());
                console.log(request.responseJSON);
                $.each(request.responseJSON.errors, function( index, value ) {
                  alert( value );
                });
            }
        });
    });
</script>
@endsection
