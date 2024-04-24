@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('category_create')
                <div class="mb-4">
                    <a class="btn btn-success" href="{{ route('frontend.categories.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.category.title_singular') }}
                    </a>
                </div>
            @endcan
            <input type="text" id="searchInput" class="form-control mb-4" onkeyup="searchCategories()" placeholder="Search for categories...">
            <div id="categoriesList" class="row">
                @foreach($categories as $category)
                <div class="col-md-4 mb-4 search-item">
                    <div class="card">
                        <div class="card-header">{{ $category->name }}</div>
                        <div class="card-body">
                           
                            @if($category->photo)
                            <div class="text-center">
                                <img src="{{ $category->photo->getUrl() }}" class="img-fluid">
                            </div>
                            @endif
                            <div class="mt-3 align-items-center">
                                @can('category_show')
                                    <a class="btn btn-default btn-sm" href="{{ route('frontend.categories.show', $category->id) }}"><i class="fas fa-eye"></i></a>
                                @endcan
                                @can('category_edit')
                                    <a class="btn btn-default btn-sm" href="{{ route('frontend.categories.edit', $category->id) }}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('category_delete')
                                    <form action="{{ route('frontend.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function searchCategories() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let categoriesList = document.getElementById("categoriesList");
    let searchItems = categoriesList.getElementsByClassName("search-item");

    for (let i = 0; i < searchItems.length; i++) {
        let card = searchItems[i].querySelector(".card-header");
        if (card.innerText.toUpperCase().indexOf(filter) > -1) {
            searchItems[i].style.display = "";
        } else {
            searchItems[i].style.display = "none";
        }
    }
}
</script>
@endsection
