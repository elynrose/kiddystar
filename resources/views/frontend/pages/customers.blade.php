@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
       
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5> {{ trans('global.menu_children') }}</h5>
                    <input type="text" id="searchInput" class="form-control w-auto" onkeyup="quickSearch()" placeholder="Search...">
                </div>

                <div class="card-body p-2">
                    <div id="userCardsList" class="d-flex flex-wrap justify-content-start">
                        @if($userCards->isNotEmpty())
                       
                        @foreach($userCards as $userCard)
                        <div class="col-md-4 mt-3">
                            <div class="card mb-4 shadow-sm mb-5 bg-white rounded">
                           
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center"><a href="{{ route('scan', $userCard->card->code) }}" class="card-link">{{ $userCard->children->first_name ?? '' }}  {{ $userCard->children->last_name ?? '' }}</a>  <span class="badge badge-default badge-pill">Points: {{ App\Models\TotalPoint::points($userCard->card_id) }}</span></li>
                                </ul>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted number">{{ $userCard->card->code ?? 'N/A' }}</h6>
                                    <a href="{{ route('frontend.add_points', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-star yellow"></i> {{ trans('global.add_stars') }}</a>
                                    <a href="{{ route('frontend.add_claims', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-gift"></i> {{ trans('global.claim_stars') }}</a>
                                    <a href="{{ route('frontend.children.edit', ['child'=>$userCard->children_id]) }}" class="btn btn-default btn-sm"><i class="fas fa-user-edit"></i></a>

                                  

                                        @can('user_card_delete')
                                            <form action="{{ route('frontend.user-cards.destroy', $userCard->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endcan
                                   </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                       <div class="small text-muted py-3 px-2"> {{_(':/ Looks like you dont have any customers here. Order cards and begin scanning.')}}</div>
                        @endif
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
function quickSearch() {
  let input = document.getElementById("searchInput");
  let filter = input.value.toUpperCase();
  let list = document.getElementById("userCardsList");
  let cards = list.getElementsByClassName("card");
  for (let i = 0; i < cards.length; i++) {
    let title = cards[i].querySelector(".card-title");
    if (title.innerText.toUpperCase().indexOf(filter) > -1) {
      cards[i].style.display = "";
    } else {
      cards[i].style.display = "none";
    }
  }
}
</script>
@endsection
