@extends('template')
 
@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Daftar Pertanyaan</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('pertanyaans.create') }}">Pengajuan Pertanyaan</a>
            </div>
        </div>
    </div>
 
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
 
    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">No</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
        </tr>
        @foreach ($pertanyaans as $pertanyaan)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $pertanyaan->pertanyaan }}</td>
            <td>{{ $pertanyaan->jawaban }}</td>
        </tr>
        @endforeach
    </table>
 
    {!! $pertanyaans->links() !!}
 
@endsection