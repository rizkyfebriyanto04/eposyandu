@extends('master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data User</h4>
                        @if (session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="{{route('pasien.caripasien')}}" method="POST">
                                @csrf <!-- Laravel Blade directive untuk menyertakan token CSRF -->
                                <label for="caripasien" >Cari User</label>
                                <input type="text" class="form-control" name="caripasien" id="caripasien" placeholder="Masukkan nama ">
                                <button type="submit" class="btn btn-primary mt-2">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
var alertBox = document.getElementById('error-alert');

setTimeout(function() {
    alertBox.style.display = 'none';
}, 3000);
</script>
@endsection
