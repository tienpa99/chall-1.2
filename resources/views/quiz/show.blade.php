@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detail Quiz  "'.$quiz->name.'"') }}</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <p style="margin-top: 7px;">{{$quiz->name}}</p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Hint') }}</label>

                            <div class="col-md-6">
                             <p style="margin-top: 7px;">{{$quiz->hint}}</p>
                         </div>
                     </div>
                     @if(session('content'))
                     <div class="form-group row">
                        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File Content') }}</label>

                        <div class="col-md-6">
                            <p>{{ session('content') }}</p>
                        </div>
                    </div>
                    @endif
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
        <div clas  s="card-header">
            {{-- Alert successfull --}}
            @if (session('alert-suc'))
            <div class="alert alert-success" role="alert">
                {{ session('alert-suc')}}

            </div>
            @endif
            @if (session('alert-fail'))
            <div class="alert alert-danger" role="alert">
                {{ session('alert-fail')}}

            </div>
            @endif
        </div>

        <div class="card-body">

            <div class="form-group row">
                <form action="{{ route('quizzes.answer',['id'=>$quiz->id]) }}" style="margin-left: 90px;" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="answer" class="col-md-4 col-form-label text-md-right">
                            {{ __('Answer') }}
                        </label>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8">
                                    <input id="name" type="text"
                                    class="form-control"
                                    name="name" value="" width="100%" required >                              
                                    
                                </div>

                                <div class="col-md-4">
                                    <input type="submit" style="margin-top: 5px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


</div>
@endsection