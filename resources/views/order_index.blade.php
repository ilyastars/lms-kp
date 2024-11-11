@extends('layouts.app_modern', ['title' => 'Data Skema']) 
@section('content') 
<div class="card">
  <h5 class="card-header">Data Skema</h5>
    <div class="card-body">
      {{-- <h3>Data skema</h3> --}}
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Skema</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Harga</th>
            <th>Tgl Buat</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody> @foreach ($skema as $item) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kd_skema }}</td>
            <td>
              @if ($item->foto)
                <a href="{{ Storage::url($item->foto) }}" target="blank">
                  <img src="{{ Storage::url($item->foto) }}" width="50">
                </a>
              @endif
              {{ $item->nama }}
            </td>
            <td>{{ $item->level }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
              <a href="/order/{{ $item->id }}/daftar" class="btn btn-warning btn-sm">
                Daftar
              </a>
            </td>
          </tr> 
          @endforeach 
        </tbody>
      </table>
      {!! $skema->links() !!}
    </div>
</div> 
@endsection