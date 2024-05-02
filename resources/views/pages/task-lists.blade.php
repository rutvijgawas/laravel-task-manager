@extends('layouts.app')

@section('css')
<style>
body {
    background-color: black;
}

.mask-custom {
  background: rgba(24, 24, 16, 0.2);
  border-radius: 2em;
  backdrop-filter: blur(25px);
  border: 2px solid rgba(255, 255, 255, 0.05);
  background-clip: padding-box;
  box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
} 

</style>
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-10">

        <div class="card mask-custom">
          <div class="card-body p-4 text-white">

            <div class="text-center pt-3 pb-2">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                alt="Check" width="60">
              <h2 class="my-4">Task List</h2>
            </div>


            <form class="d-flex justify-content-center align-items-center mb-4" action="{{ route('task.store',['project_id'=>$projectId]) }}" method="post">
                @csrf
            <div data-mdb-input-init class="form-outline flex-fill">
                <label class="form-label" for="form2">New task...</label>
                <input type="text" id="form2" name="new_task" class="form-control" />
            </div>
            <!-- <div data-mdb-input-init class="form-outline flex-fill ms-3">
                <label class="form-label" for="form3">Set Priority...</label>
                <input type="text" id="form3" name="priority" class="form-control" />
            </div> -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info ms-2 mt-4">Add</button>
            </form>

            <table class="table text-white mb-0">
              <thead>
                <tr>
                  <th scope="col">Task</th>
                  <th scope="col">Priority</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="sortable"> <!-- Add id="sortable" -->
                  @for($i = 0; $i < count($taskLists); $i++)
                    @php
                        $priorityClass = '';
                        if ($taskLists[$i]['priority'] < 3) {
                            $priorityClass = 'bg-danger'; // Highest priority
                            $priority = 'High';
                        } elseif ($taskLists[$i]['priority']  < 6) {
                            $priorityClass = 'bg-warning'; // Medium priority
                            $priority = 'Medium';
                        } else {
                            $priorityClass = 'bg-success'; // Low priority
                            $priority = 'Low';
                        }
                    @endphp
                    <tr class="fw-normal">
                      <td class="align-middle">
                        <span>{{ $taskLists[$i]['title'] }}</span>
                      </td>
                      <td class="align-middle">
                        <h6 class="mb-0"><span class="badge {{ $priorityClass }}" >
                            #{{ $taskLists[$i]['priority'] }} {{$priority}}
                        </span></h6>
                      </td>
                      <form action="{{ route('task.destroy', ['task' => $taskLists[$i]['id']]) }}" method="POST" >
                      <td class="align-middle">
                          @csrf
                          @method('DELETE')
                          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger" >Delete</button>
                        </form>
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-success ms-1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $taskLists[$i]['id'] }}">Edit</button>
                      </td>

                      <form id="sortable-form{{ $taskLists[$i]['id'] }}">
                          <input type="hidden" name="id" value="{{ $taskLists[$i]['id'] }}">
                          <input type="hidden" name="priority" value="{{ $taskLists[$i]['priority'] }}">
                      </form>
                    </tr>
                    @endfor
                <!-- More tasks -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @foreach ($taskLists as $taskList)
  <div class="modal fade" id="exampleModal{{$taskList['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('task.update',['task'=>$taskList['id']]) }}" method="post">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Task Title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Title</label>
              <input type="text" name="task" class="form-control" id="exampleFormControlInput1" placeholder="Task Title" value="{{ $taskList['title'] }}" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</section>
@endsection

@section('js')
<!-- Include jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    // Initialize sortable functionality
    // $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    // Enable drag and drop functionality
    $( "#sortable" ).sortable({
      update: function( event, ui ) {
        // Update the order of the tasks in the database
        var priority = $( "#sortable" ).sortable( "toArray" );
        var taskData = [];
        $('#sortable tr').each(function(index) {
          var taskId = $(this).find('input[name="id"]').val();
          var priority = index + 1;
          taskData.push({ id: taskId, priority: priority });
        });
        console.log(taskData);
        $.ajax({
          url: "{{ route('task.updatePriority') }}",
          type: "PUT",
          data: {
            _token: "{{ csrf_token() }}",
            data: taskData
          },
          success: function(response) {
            if (response.success) {
                location.reload();
            }
          }
        });
    }
  })
});
    
</script>
@endsection
