@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('task_create')
                <div class="mb-3">
                    <a class="btn btn-default" href="{{ route('frontend.tasks.create') }}">
                    <i class="fas fa-plus"></i> {{ trans('cruds.task.title_singular') }}
                    </a>
                </div>
            @endcan
            <input type="text" id="searchInput" class="form-control mb-3" onkeyup="searchTasks()" placeholder="Search tasks...">
            <div class="row" id="tasksList">
                @foreach($tasks as $task)
                    <div class="col-md-12 search-item">
                        <div class="card mb-4">
                   
                            <div class="card-body">
                                <h5> {{ $task->task_name }} ({{ $task->points }})</h5>
                                {{ App\Models\Task::OCCOURANCE_SELECT[$task->occourance] ?? '' }}<br>Assigned To: 
                                    @foreach($task->assigned_tos as $assigned)
                                       <span class="badge badge-success"> {{ $assigned->first_name }} </span>
                                    @endforeach</p>
                                <div class="align-items-left">
                                @foreach($task->assigned_tos as $assigned)
                                <a href="{{ route('frontend.completed')}}" data-task="{{$task->id}}" data-child="{{$assigned->pivot->child_id}}" class="btn btn-default btn-sm done" id="btn-{{$task->id}}_{{$assigned->pivot->child_id}}"><i class="fas fa-star yellow fa-{{$task->id}}_{{$assigned->pivot->child_id}}"></i> {{ trans('cruds.task.give') }}  {{ $assigned->first_name }} {{ trans('cruds.task.stars') }} </a>
                                    @endforeach
                                    @can('task_edit')
                                        <a href="{{ route('frontend.tasks.edit', $task->id) }}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('task_delete')
                                        <form action="{{ route('frontend.tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-default btn-sm" onclick="return confirm('{{ trans('global.areYouSure') }}');"><i class="fas fa-trash"></i></button>
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
function searchTasks() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let tasksList = document.getElementById("tasksList");
    let searchItems = tasksList.getElementsByClassName("search-item");

    for (let i = 0; i < searchItems.length; i++) {
        let card = searchItems[i].querySelector(".card-header");
        if (card) {
            let txtValue = card.textContent || card.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                searchItems[i].style.display = "";
            } else {
                searchItems[i].style.display = "none";
            }
        }
    }
}



$(document).ready(function() {
    // Event handler for click on links with class 'done'
    $('a.done').click(function(event) {
        event.preventDefault(); // Prevent the default action of the link

        // Extract values from data attributes
        var taskId = $(this).data('task');
        var childId = $(this).data('child');

        if(taskId && childId) {
            // AJAX request configuration
            $.ajax({
                url: '/completed',  // Ensure this URL matches your Laravel route
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),  // CSRF token
                    task: taskId,
                    child: childId
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                    console.log('AJAX request succeeded:', data);
                    // Add class 'completed' to the clicked element
                    $('.fa-'+ taskId+'_'+childId).addClass('fa-check');
                    $('#btn-'+ taskId+'_'+childId).addClass('disabled');
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log('AJAX request failed:', textStatus, errorThrown);
                    console.log(textStatus);
                }
            });
        } else {
            alert('Values not available');
        }
    });
});


</script>
@endsection
