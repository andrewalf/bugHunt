@extends('main')

@section('title', 'Продукты')

@section('content')
    <div class="mb-3">
        <a href="{{ route('products.export') }}" class="btn btn-primary">Экспорт в CSV</a>
        <a href="{{ route('products.forms.import') }}" class="btn btn-secondary">Импорт из CSV</a>
        <a href="{{ route('products.import_example') }}" class="btn btn-info">Скачать шаблон</a>
        <a href="{{route('products.forms.create') }}" class="btn btn-success">Добавить</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Название</th>
            <th>Фото</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>В наличии</th>
            <th>Видимость</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    <img src="{{ $product->getImageUrl() }}" class="img-fluid" alt="Example Image">
                </td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->is_visible == 1? "Да": "Нет"  }}</td>
                <td>{{ $product->created_at }}</td>
                <td class="text-center">
                    <a href="{{ route('products.forms.edit', $product->id) }}" class="btn btn-sm btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                        </svg>
                    </a>

                    <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirmDelete()" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $products->onEachSide(3)->links() }}
    <script>
        function confirmDelete() {
            return confirm('Вы уверены, что хотите удалить этот продукт?');
        }
    </script>

{{--    <nav aria-label="Page navigation example">--}}
{{--        <ul class="pagination justify-content-center">--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Назад</a>--}}
{{--            </li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#">Вперёд</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </nav>--}}
@endsection