@extends('main')

@section('title', 'Новый продукт')

@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Цена</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Остаток на складе</label>
                <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
                @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_visible">Видимость</label>
                <select class="form-control @error('is_visible') is-invalid @enderror" id="is_visible" name="is_visible" required>
                    @if ($product->is_visible == "Да")
                        <option value="1" {{ old('is_visible', $product->is_visible) == '1' ? 'selected' : '' }}>Видно</option>
                        <option value="0" {{ old('is_visible', $product->is_visible) == '0' ? 'selected' : '' }}>Не видно</option>
                    @else
                        <option value="0" {{ old('is_visible', $product->is_visible) == '0' ? 'selected' : '' }}>Не видно</option>
                        <option value="1" {{ old('is_visible', $product->is_visible) == '1' ? 'selected' : '' }}>Видно</option>
                    @endif
                </select>
                @error('is_visible')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <br>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('products.list') }}" class="btn btn-primary">Назад</a>
        </form>
@endsection