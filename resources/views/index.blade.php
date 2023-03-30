<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keluarga Budi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://nugrahamedia.web.id/nugrahamedia.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('/css/silsilah.css') }}">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col text-center app-brand text-dark py-3 mb-3">
                <h1>Silsilah Keluarga Budi</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <table class="table table-sm">
                    <thead>
                        <tr class='app-table-header'>
                            <th>ID</th>
                            <th>Gen. Ke</th>
                            <th>Orang Tua</th>
                            <th>Anak Ke</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="dataKeluarga"></tbody>
                </table>
                <section class="mt-5">
                    <h3 class='text-center'>Penelusuran Kerabat</h3>
                    <div class="row">
                        <div class="col-lg-3">
                            <select id="namaKeluarga" class="form-control"></select>
                        </div>
                        <div class="col-lg-3">
                            <select id="hubungan" class="form-control">
                                <option value="">Pilih Kerabat</option>
                                <option value="anak">Semua Anak</option>
                                <option value="anakL">Anak Laki-Laki</option>
                                <option value="anakP">Anak Perempuan</option>
                                <option value="cucu">Semua Cucu</option>
                                <option value="cucuL">Cucu Laki-laki</option>
                                <option value="cucuP">Cucu Perempuan</option>
                                <option value="paman">Paman</option>
                                <option value="bibi">Bibi</option>
                                <option value="sepupu">Semua Sepupu</option>
                                <option value="sepupuL">Sepupu Laki-laki</option>
                                <option value="sepupuP">Sepupu Perempuan</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <span id="kerabat"></span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col mt-5 mb-0 text-center bg-gray">
                developed by: nugroho.redbuff@gmail.com
            </div>
        </div>
    </div>
    
    <!-- Modals -->
    <div class="modal" tabindex="-1" id="modalKeluarga">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Keluarga</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('klgTambah') }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" id="fkg_method">
                    <input type="hidden" name="id" id="fkg_id">
                    <input type="hidden" name="parentId" id="fkg_parentId">
                    <input type="hidden" name="generasiKe" id="fkg_generasiKe">
                    <div class="form-group">
                        <input type="text" name="urutKe" id="fkg_urutKe" class="form-control" placeholder="anak Ke">
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama" id="fkg_nama" class="form-control" placeholder="Nama Anak">
                    </div>
                    <div class="form-group bg-info py-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jnKelamin" id="jnkL" value="Laki-laki" checked>
                            <label class="form-check-label" for="jnkL">Laki-laki</label>
                          </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jnKelamin" id="jnkP" value="Perempuan">
                            <label class="form-check-label" for="jnkP">Perempuan</label>
                          </div>
                    </div>
                    <div class="text-end mr-3 mt-3">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
    <!-- Modals -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <script>
        const apiurl = "{{ url('/api') }}";
        const updurl = "{{ route('klgMrubah',":id") }}";
        const delurl = "{{ route('klgMusnah',":id") }}";
    </script>
    <script src="{{ url('/js/index.js') }}"></script>
  </body>
</html>