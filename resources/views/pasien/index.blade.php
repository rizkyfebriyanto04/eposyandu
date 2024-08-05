@extends('master')

@section('content')
    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12">
                <button class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    <i data-feather="plus"></i>&nbsp;Tambah
                </button>
                <br><br>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Pasien</h4>
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
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
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
                                        <td>{{ $d->tanggalahir }}</td>
                                        <td>
                                            <form id="delete-form-{{ $d->id }}" action="{{ route('pasien.hapuspasien', $d->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                {{-- <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');" style="border: none; background-color: transparent;">
                                                    <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="trash"></i>
                                                </button> --}}
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');" class="btn btn-primary">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $d->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $d->id }}">Edit Data Pasien</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('pasien.updatepasien', $d->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label for="NameLengkap">Nama Pasien</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="NameLengkap" name="namapasien" value="{{ $d->namapasien }}" placeholder="Nama Lengkap" required>
                                                        </div>

                                                        <label for="NIK">NIK</label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="NIK" name="nik" value="{{ $d->nik }}" placeholder="NIK" required>
                                                        </div>

                                                        <label for="JenisKelamin">Jenis Kelamin</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" id="JenisKelamin" name="jeniskelamin" required>
                                                                <option value="" disabled>-- Pilih --</option>
                                                                <option value="laki-laki" {{ $d->jeniskelamin == 'laki-laki' ? 'selected' : '' }}>Laki - Laki</option>
                                                                <option value="perempuan" {{ $d->jeniskelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </fieldset>

                                                        <label for="TanggalLahir">Tanggal Lahir</label>
                                                        <div class="form-group">
                                                            <input type="date" name="tanggalahir" value="{{ $d->tanggalahir }}" class="form-control mb-3 flatpickr-no-config" placeholder="Select date.." required>
                                                        </div>

                                                        <label for="Alamat">Alamat</label>
                                                        <div class="form-group">
                                                            <textarea name="alamat" class="form-control"rows="3" >{{ $d->alamat }}</textarea>
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

        <!--login form Modal -->
        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33"> Tambah Data Pasien</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('pasien.action') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="NameLengkap">Nama Lengkap</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="namapasien" placeholder="Nama Lengkap" required/>
                        </div>
                        <label for="Nik">NIK</label>
                        <div class="form-group">
                            <input class="form-control" id="Nik" type="number" name="nik" placeholder="NIK" required/>
                        </div>
                        <label for="role">Jenis Kelamin</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect" name="jeniskelamin">
                                <option selected>-- Pilih --</option>
                                <option value="laki-laki">Laki - Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </fieldset>
                        <label for="ttl">Tanggal Lahir</label>
                        <div class="form-group">
                            <input type="date" name="tanggalahir" class="form-control mb-3" placeholder="Select date.." id="tanggalahir">
                        </div>
                        <label for="alamat">Alamat</label>
                        <div class="form-group">
                            <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3" > </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1"
                            data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </section>

    <script>
        var alertBox = document.getElementById('success-alert');

        setTimeout(function() {
            alertBox.style.display = 'none';
        }, 3000);

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0]; // Format tanggal sebagai yyyy-mm-dd
            document.getElementById('tanggalahir').setAttribute('max', today);
        });
    </script>

@endsection
