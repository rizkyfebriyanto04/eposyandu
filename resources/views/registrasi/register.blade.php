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
                        <h4 class="card-title">Daftar Akun</h4>
                        @if (session('success'))
                            <div class="alert alert-success" id="success-alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" id="success-alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama </th>
                                        <th>Email/Username</th>
                                        <th>Role</th>
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
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                        {{-- <td>{{ $d->role }}</td> --}}
                                        <td>
                                            @if($d->role == 'orangtua')
                                                Orangtua
                                            @elseif($d->role == 'petugasppk')
                                                Petugas PPK
                                            @else
                                                Admin
                                            @endif

                                        </td>
                                        <td>
                                            <form id="delete-form-{{ $d->id }}" action="{{ route('registrasi.hapusregistrasi', $d->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data?');" class="btn btn-primary">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $d->id }}">
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
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
                    <h4 class="modal-title" id="myModalLabel33"> Tambah Data Akun</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('registrasi.action') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="NameLengkap">Nama Lengkap</label>
                        <div class="form-group">
                            <input class="form-control" id="NameLengkap" type="text" name="name" placeholder="Nama Lengkap"/>
                        </div>
                        <label for="email">Email</label>
                        <div class="form-group">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email"/>
                        </div>
                        <label for="password">Password</label>
                        <div class="form-group">
                            <input type="password" id="password-horizontal" class="form-control" name="password" placeholder="Password">
                        </div>
                        <label for="role">Role</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="roleSelect" name="role">
                                <option selected>-- Pilih --</option>
                                <option value="orangtua">OrangTua</option>
                                <option value="petugasppk">Petugas PPK</option>
                            </select>
                        </fieldset>

                        <div id="pasienDiv">
                            <label for="objectpasienfk">User</label>
                            <fieldset class="form-group">
                                <select class="choices form-select" name="objectpasienfk">
                                    @foreach ($pasien as $s)
                                        <option value="{{ $s->id }}">{{ $s->namapasien }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
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
    <div class="modal fade" id="editModal{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $d->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $d->id }}">Edit Data Akun</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('registrasi.updateregistrasi', $d->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name{{$d->id}}">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name{{$d->id}}" name="name" value="{{ $d->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email{{$d->id}}">Email</label>
                            <input type="email" class="form-control" id="email{{$d->id}}" name="email" value="{{ $d->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password{{$d->id}}">Password</label>
                            <input type="password" class="form-control" id="password{{$d->id}}" name="password">
                        </div>
                        <div class="form-group">
                            <label for="pasienid{{$d->id}}">Pasien</label>
                            <fieldset class="form-group">
                                <select class="choices form-select" id="pasienid{{ $d->id }}" name="objectpasienfk">
                                    @foreach ($pasien as $p)
                                        <option value="{{ $p->id }}" {{ $d->objectpasienfk == $p->id ? 'selected' : '' }}>
                                            {{ $p->namapasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
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

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var alertBox = document.getElementById('success-alert');

        setTimeout(function() {
            alertBox.style.display = 'none';
        }, 3000);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('roleSelect');
            const pasienDiv = document.getElementById('pasienDiv');

            pasienDiv.classList.add('hide');

            roleSelect.addEventListener('change', function () {
                if (this.value === 'orangtua') {
                    pasienDiv.classList.remove('hide');
                    pasienDiv.classList.add('show');
                } else {
                    pasienDiv.classList.remove('show');
                    pasienDiv.classList.add('hide');
                }
            });
        });
    </script>

@endsection

