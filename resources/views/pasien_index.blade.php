@extends('layouts.app_modern', ['title' => 'Data Pasien']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Pasien</h5>
    <div class="card-body">
      {{-- <h3>Data pasien</h3> --}}
      <a href="/pasien/create" class="btn btn-primary">Tambah Data</a>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>NO</th>
            <th>No Pasien</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Tgl Buat</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> @foreach ($pasien as $item) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->no_pasien }}</td>
            <td>
              @if ($item->foto)
                <a href="{{ Storage::url($item->foto) }}" target="blank">
                  <img src="{{ Storage::url($item->foto) }}" width="50">
                </a>
              @endif
              {{ $item->nama }}
            </td>
            <td>{{ $item->umur }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
              <a href="/pasien/{{ $item->id }}/edit" class="btn btn-warning btn-sm">
                Edit
              </a>
              <form action="/pasien/{{ $item->id }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm ml-2" 
                  onclick="return confirm('Yakin ingin menghapus data?')">
                  Hapus
                </button>
              </form>
            </td>
          </tr> 
          @endforeach 
        </tbody>
      </table>
      </div>
      {!! $pasien->links() !!}
    </div>
</div> 
@endsection