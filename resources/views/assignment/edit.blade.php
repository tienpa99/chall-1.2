@extends('layouts.app')
@if(Auth::user()->role=='teacher')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Assignment "'.$assignment->name.'"') }}</div>

                <div class="card-body">
                    <form method="POST"  enctype="multipart/form-data" action="{{ route('assignments.update',['id'=>$assignment->id]) }}" aria-label="{{ __('Add') }}">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                class="form-control"
                                name="name" value="{{$assignment->name}}" required >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea name="content" id="" cols="43" rows="10" style="" value="">{{$assignment->content}}</textarea>
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
                                    {{ __('Save') }}
                                    @method('PUT')
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