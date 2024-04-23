@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            @can('reward_create')
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-default" href="{{ route('frontend.rewards.create') }}">
                    <i class="fas fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.reward.title_singular') }}
                    </a>
                    <button class="btn btn-default" data-toggle="modal" data-target="#csvImportModal">
                    <i class="fas fa-upload"></i> {{ trans('global.app_csvImport') }}
                    </button>
                    @include('csvImport.modal', ['model' => 'Reward', 'route' => 'admin.rewards.parseCsvImport'])
                </div>
            @endcan
            <div class="input-group mb-5 mt-5 ">
                <input type="text" id="searchInput" class="form-control shadow-sm" placeholder="Search rewards..." aria-label="Search rewards" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                </div>
            </div>
            <div class="row mt-5" id="rewardsList">
                @foreach($rewards as $key => $reward)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            @foreach($reward->photo as $key => $media)
                            <a href="{{ route('frontend.rewards.show', $reward->id) }}" target="_blank"><img src="{{ $media->getUrl() }}" class="card-img-top" alt="Reward Image"></a>
                            @endforeach
                            <div class="card-body">
                                <h5 class="card-title">{{ $reward->name ?? '' }}</h5>
                                <p class="card-text">Category: {{ $reward->category ?? '' }}<br>
                                Points: {{ $reward->points ?? '' }}</p>
                                <div class="d-flex justify-content-left align-items-left">
                                    @can('reward_show')
                                        <a href="{{ route('frontend.rewards.show', $reward->id) }}" class="btn btn-sm btn-default"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    &nbsp;
                                    @can('reward_edit')
                                        <a href="{{ route('frontend.rewards.edit', $reward->id) }}" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    &nbsp;
                                    @can('reward_delete')
                                        <form action="{{ route('frontend.rewards.destroy', $reward->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-default"><i class="fas fa-trash"></i></button>
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
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
document.getElementById('button-addon2').onclick = function() {
    var input, filter, list, cards, title, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    list = document.getElementById("rewardsList");
    cards = list.getElementsByClassName('col-md-4');

    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-body .card-title");
        if (title) {
            txtValue = title.textContent || title.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }       
    }
};
</script>
@endsection
