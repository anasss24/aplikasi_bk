@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Ajukan Jadwal Konseling</h2>
  <form method="POST" action="{{ route('jadwal.store') }}">
    @csrf
    <div class="mb-3">
      <label>Siswa</label>
      <select name="siswa_id" class="form-control">
        @foreach($siswaList as $s)
          <option value="{{ $s->siswa_id }}">{{ $s->nama }} ({{ $s->nis }})</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label>Guru BK</label>
      <select name="guru_id" class="form-control">
        @foreach($guruList as $g)
          <option value="{{ $g->guru_id }}">{{ $g->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label>Waktu</label>
      <input type="datetime-local" name="jadwal_datetime" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Metode</label>
      <select name="metode" class="form-control">
        <option value="offline">Offline</option>
        <option value="online">Online</option>
      </select>
    </div>
    <button class="btn btn-primary">Ajukan</button>
  </form>
</div>
@endsection
