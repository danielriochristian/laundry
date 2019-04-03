@extends('layout')
@section('labelorder')
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="breadcomb-wp">
      <div class="breadcomb-icon">
          <h2>Create Order</h2>
      </div>
    </div>
  </div>
@endsection
@section('order')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="data-table-list">
        <form action="/postorder" method="post" enctype="multipart/form-data" class="form-horizontal">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner">
                      <p>Nama</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <div class="nk-int-st">
                      <input type="text" name="nama" class="form-control" placeholder="Waginem">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner">
                      <p>No. Handphone</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <div class="nk-int-st">
                      <input type="text" name="hp" class="form-control" placeholder="0878423424xxx">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner form-rlt-mg">
                      <p>Alamat</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <div class="nk-int-st">
                      <textarea class="form-control" rows="3" name="alamat" class="alamat" placeholder="Jl. Nin aja dulu siapa tau cocok RT 02/RW 12"></textarea>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner">
                      <p>Berat</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                  <div class="nk-int-st">
                      <input type="text" name="berat" class="form-control" placeholder="2">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner">
                      <p>Jenis Pakaian</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <div class="nk-int-st">
                    <select name="jenis" id="jenis" class="form-control">
                      <?php $jenis = DB::table('jenis_pakaian')->get(); ?>
                      @foreach ($jenis as $j)
                      <option value="{{$j -> id}}">{{$j -> jenis_pakaian}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="floating-numner">
                      <p>Pengharum</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <div class="nk-int-st">
                  <select name="pengharum" id="pengharum" class="form-control">
                    <?php $pengharum = DB::table('pengharum')->get(); ?>
                    @foreach ($pengharum as $p)
                      <option value="{{$p -> id}}">{{$p -> nama_pengharum}}</option>
                    @endforeach

                  </select>
                </div>
              </div>
          </div>

      <div class="card-footer">
          <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Submit
          </button>
          <button type="reset" class="btn btn-danger btn-sm">
              <i class="fa fa-ban"></i> Reset
          </button>
      </div></div>
      </form>
  </div>
</div>
@endsection
