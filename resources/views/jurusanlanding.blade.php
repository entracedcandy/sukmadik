<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pilih Jurusan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100" style="background: url('/img/background.jpg') center/cover no-repeat;">
    <div class="bg-white rounded p-5 shadow text-center" style="min-width: 400px;">
        <h3 class="mb-4 fw-bold">Pilih Jurusan</h3>

        @foreach($jurusan as $j)
            <form action="{{ route('pilih.jurusan', ['id_jurusan' => $j->id_jurusan,'id_kampus' => $id_kampus]) }}" method="POST" class="mb-2">
                @csrf
                <input type="hidden" name="kampus_id" value="{{ $j->id }}">
                <button class="btn btn-primary w-100">{{ $j->nama_jurusan }}</button>
            </form>
        @endforeach
    </div>
</body>
</html>
