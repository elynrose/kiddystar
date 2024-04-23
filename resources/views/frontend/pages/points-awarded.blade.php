@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-3">{{_('Points Awarded')}}</h5>
                    <input type="text" id="searchInput" class="form-control" onkeyup="quickSearch()" placeholder="Search by name...">
                </div>

                <div class="card-body">
                    <div class="list-group" id="pointsList">
                        @foreach($points as $point)
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                              <p class="mb-1">{{ $point->user->first_name ?? 'N/A' }} {{ $point->user->last_name ?? 'N/A' }}</p>
                            </div>
                            <p class="mb-1">Amount Spent: {{ $point->amount_spent }}</p>
                            <p class="mb-1">Points: {{ $point->points }}</p>
                            <p class="mb-1">Card: {{ $point->card->code ?? 'N/A' }}</p>
                            <small>{{ $point->created_at->diffForHumans() }}</small>
                        </a>
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
function quickSearch() {
  var input, filter, list, items, a, i, txtValue;
  input = document.getElementById("searchInput");
  filter = input.value.toUpperCase();
  list = document.getElementById("pointsList");
  items = list.getElementsByTagName("a");
  for (i = 0; i < items.length; i++) {
    a = items[i];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      items[i].style.display = "";
    } else {
      items[i].style.display = "none";
    }
  }
}
</script>
@endsection
