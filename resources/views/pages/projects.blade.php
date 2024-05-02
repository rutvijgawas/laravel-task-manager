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
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-10">

        <div class="card mask-custom">
          <div class="card-body p-4 text-white">

            <div class="text-center pt-3 pb-2">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                alt="Check" width="60">
              <h2 class="my-4">Project List</h2>
            </div>

            <table class="table text-white mb-0">
              <thead>
                <tr>
                  <th scope="col">Sr.NO</th>
                  <th scope="col">Projects</th>
                </tr>
              </thead>
              <tbody id="sortable"> <!-- Add id="sortable" -->
                @foreach ($projects as $k => $project)
                <tr class="fw-normal">
                    <td class="align-middle">
                        <span>{{$k+1}} )</span>
                    </td>
                    <td class="align-middle">
                            <a href="{{ route('tasks',['id' => $project->id]) }}" class="text-black">
                                <span>{{ $project->name }}</span>
                            </a>
                      </td>
                    </tr>
                @endforeach
                <!-- More tasks -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<!-- Include jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    // Initialize sortable functionality
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

});
    
</script>
@endsection
