@extends('main')

@section('title', 'Импорт продуктов из CSV')

@section('content')
    <form action="{{ route('products.import.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="csv_file">Выберите CSV файл для импорта</label>
            <input type="file" class="form-control @error('csv_file') is-invalid @enderror" id="csv_file" name="csv_file" required>
            @error('csv_file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Импортировать</button>
        <a href="{{ route('products.list') }}" class="btn btn-primary">Назад</a>
    </form>
@endsection