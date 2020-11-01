@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
              @if(Auth::user()->role == 'teacher')
                <button style="float: right; width: 10%;"><a href="{{route('addMember2')}}">add</a></button>
              @endif
            </div>
            <div class="card-body">
               @if (session('success'))
               <div class="alert alert-success" role="alert">
                  {{ session('success') }}
               </div>
               @endif
               
                @if (session('success-add-member'))
               <div class="alert alert-success" role="alert">
                  {{ session('success-add-member') }}
               </div>
               @endif
              @if (session('success-update'))
               <div class="alert alert-success" role="alert">
                  {{ session('success-update') }}
               </div>
               @endif
               <table class="table table-striped">
                  <thead>
                     <tr id="showDetail">
                        <th scope="col">ID</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" style="text-align: center">Infomation</th>
                    @if(Auth::user()->role == 'teacher')
                        <th scope="col" style="text-align: center">Action</th>
                    @endif
                     </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                     <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->fullname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td style="text-align: center"><a href="{{route('views',['id'=>$user->id])}}">Link</a></td>
                    @if(Auth::user()->role == 'teacher' & $user->role != 'teacher')
                        <td style="text-align: center">
                            <button><a href="{{route('edit',['id'=>$user->id])}}">Edit</a></button>
                            <button><a href="{{route('delete',['id'=>$user->id])}}" onclick="return confirm('xoá không?');">Delete</a></button>

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