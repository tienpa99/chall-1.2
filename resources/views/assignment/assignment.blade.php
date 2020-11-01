@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
              @if(Auth::user()->role == 'teacher')
                <button style="float: right; width: 10%;"><a href="{{route('assignments.create')}}">add</a></button>
              @endif
            </div>
            <div class="card-body">
               @if (session('success'))
               <div class="alert alert-success" role="alert">
                  {{ session('success') }}
               </div>
               @endif
               
                @if (session('create-ok'))
               <div class="alert alert-success" role="alert">
                  {{ session('create-ok') }}
               </div>
               @endif
              @if (session('edit-ok'))
               <div class="alert alert-success" role="alert">
                  {{ session('edit-ok') }}
               </div>
               @endif
               <table class="table table-striped">
                  <thead>
                     <tr id="showDetail">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Content</th>
                        <th scope="col" style="text-align: center">Detail</th>

                    @if(Auth::user()->role == 'teacher')
                        <th scope="col" style="text-align: center">Action</th>
                    @endif
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($assignments as $assignment)
                     <tr>
                        <th scope="row">{{$assignment->id}}</th>
                        <td>{{$assignment->name}}</td>
                        <td>{{$assignment->content}}</td>
                        <td style="text-align: center"><a href="{{route('assignments.show',['assignment'=>$assignment->id])}}">Link</a>
                        @csrf</td>
                    @if(Auth::user()->role == 'teacher')
                        <td style="text-align: center">
                          <div class="row justify-content-center">
                              <form action="{{route('assignments.edit',['id'=>$assignment->id])}}"  >
                                
                                @csrf
                                <input type="submit" value="Edit">
                            </form>
                            <div class="col-6-md">
                              <form action="{{route('assignments.destroy',['id'=>$assignment->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete">
                            </form>
                            </div>
                          </div>

                        </td>
                    @endif
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