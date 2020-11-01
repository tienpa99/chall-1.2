@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Assignment "'.$assignment->name.'"') }}</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <p style="margin-top: 7px;">{{$assignment->name}}</p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                             <p style="margin-top: 7px;">{{$assignment->content}}</p>
                         </div>
                     </div>

                     <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Link File') }}</label>

                        <div class="col-md-6">
                            <a href="{{$assignment->path}}"><p>Link File</p>   </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
              @if (session('erorr-file'))
              <div class="alert alert-danger" role="alert">
                {{ session('erorr-file')}}
            </div>
            @endif
            @if (session('submit-ok'))
            <div class="alert alert-success" role="alert">
                {{ session('submit-ok')}}
            </div>
            @endif
            <div class="card-header">
                <div class="row justify-content-center">

                @if(Auth::user()->role =='student')
                    <div class="col-md-7">
                        {{ __("Student's submit") }}
                    </div>

                    <div class="col-md-5">
                        <form action="{{route('studentSubmit',['id'=>$assignment->id])}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="file" name="FileSend" id="FileSend" required="true">
                            <input type="submit" value="submit">
                        </form>
                    </div>

                @endif
                @if(Auth::user()->role =='teacher')
                    <div class="col-md-12">
                        {{ __("Student's submit") }}
                    </div>
                @endif
                </div>
            </div>
                
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">List</th>
                            <th scope="col">Name</th>
                            <th scope="col">Submit File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submits as $submit)
                        <tr>
                            <th scope="row">{{$submit->id}}</th>
                            <td>{{$submit->user}}</td>
                            <td><a href="{{$submit->path}}">Link</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

  </div>
</div>
</div>
</div>


</div>
@endsection