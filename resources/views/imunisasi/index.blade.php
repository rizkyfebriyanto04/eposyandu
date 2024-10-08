@extends('master')

@section('content')
    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12">
                {{-- <button class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    <i data-feather="plus"></i>&nbsp;Tambah
                </button> --}}
                <br><br>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data User</h4>
                        @if (session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama User</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Berat badan</th>
                                        <th>Tinggi badan</th>
                                        <th>Imunisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1
                                    @endphp
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->namapasien }}</td>
                                        <td>{{ $d->jeniskelamin }}</td>
                                        <td>{{ $d->umur }}</td>
                                        <td>{{ $d->beratbadan == null ? 'Belum Di Isi' : $d->beratbadan . ' Kg' }}</td>
                                        <td>{{ $d->tinggibadan == null ? 'Belum Di Isi' : $d->tinggibadan . ' CM' }}</td>
                                        <td>{{ $d->imunisasi == null ? 'Belum Di Isi' : $d->imunisasi }}</td>
                                        <td>
                                            <form id="delete-form-{{ $d->id }}" action="{{ route('imunisasi.hapusimunisasi', $d->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                            @if(auth()->check() && (auth()->user()->role === 'petugasppk'))
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                                Input
                                            </button>
                                            @endif
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal2{{ $d->id }}">
                                                Edit
                                            </button>
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');" class="btn btn-primary">
                                                Hapus
                                            </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $d->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $d->id }}">Input Imunisasi</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('imunisasi.updateimunisasi', $d->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="NameLengkap">Imunisasi</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="NameLengkap" name="imunisasi" value="{{ $d->imunisasi }}" placeholder="imunisasi" >
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="editModal2{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel2{{ $d->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel2{{ $d->id }}">Edit Imunisasi</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('imunisasi.updateimunisasi', $d->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="NameLengkap">Imunisasi</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="NameLengkap" name="imunisasi" value="{{ $d->imunisasi }}" placeholder="imunisasi" >
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var alertBox = document.getElementById('success-alert');

        setTimeout(function() {
            alertBox.style.display = 'none';
        }, 3000);
    </script>

@endsection
