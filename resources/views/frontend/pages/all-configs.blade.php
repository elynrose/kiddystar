@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('configuration_create')
                <div class="mb-3 d-flex justify-content-between">
                    <a class="btn btn-success" href="{{ route('frontend.configurations.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.configuration.title_singular') }}
                    </a>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                        {{ trans('global.app_csvImport') }}
                    </button>
                    @include('csvImport.modal', ['model' => 'Configuration', 'route' => 'admin.configurations.parseCsvImport'])
                </div>
            @endcan
            <input type="text" id="searchInput" class="form-control mb-3" onkeyup="searchConfiguration()" placeholder="Search for configurations...">
            <div id="configurationsList" class="row">
                @foreach($configurations as $configuration)
                <div class="col-md-12 mb-4 search-item">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Start Date: {{ $configuration->start_date ?? 'N/A' }}</h6>
                            <p class="card-text">Points Per Dollar: {{ $configuration->points_per_dollar ?? 'N/A' }}</p>
                            <div class="d-flex justify-content-right align-items-center">
                             
                                &nbsp;
                                @can('configuration_edit')
                                    <a href="{{ route('frontend.configurations.edit', $configuration->id) }}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                                @endcan 
                                &nbsp;
                                @can('configuration_delete')
                                    <form action="{{ route('frontend.configurations.destroy', $configuration->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@parent
<script>
function searchConfiguration() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let configurationsList = document.getElementById("configurationsList");
    let searchItems = configurationsList.getElementsByClassName("search-item");

    for (let i = 0; i < searchItems.length; i++) {
        let title = searchItems[i].querySelector(".card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            searchItems[i].style.display = "";
        } else {
            searchItems[i].style.display = "none";
        }
    }
}
</script>
@endsection
