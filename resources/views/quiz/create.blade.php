@extends('layouts.app')
@if(Auth::user()->role=='teacher')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Quiz') }}</div>

                <div class="card-body">
                    <form method="POST"  enctype="multipart/form-data" action="{{ route('quizzes.store') }}" aria-label="{{ __('Add') }}">
                        
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                class="form-control"
                                name="name" value="" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('hint') }}</label>

                            <div class="col-md-6">
                                 <input id="name" type="text"
                                class="form-control"
                                name="hint" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Choose File') }}</label>

                            <div class="col-md-6">
                                <input id="File" type="file" class="form-control" name="File">
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="width: 30%;">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@else
<script>window.location = "/home";</script>
@endif