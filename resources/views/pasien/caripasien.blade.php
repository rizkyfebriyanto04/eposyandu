@extends('master')

@section('content')
<section class="section">
    <div class="container">
        <div class="row" id="table-head">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pasien</h4>
                        @if (session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form action="{{route('pasien.caripasien')}}" method="POST">
                                @csrf <!-- Laravel Blade directive untuk menyertakan token CSRF -->
                                <label for="caripasien" >Cari Pasien</label>
                                <input type="text" class="form-control" name="caripasien" id="caripasien" placeholder="Masukkan nama pasien">
                                <button type="submit" class="btn btn-primary mt-2">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
