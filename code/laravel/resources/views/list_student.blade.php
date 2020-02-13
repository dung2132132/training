@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
            </tr>
            </thead>
            <tbody>
            @php
            $i=1;
            @endphp
            @foreach($student as $st)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$st->code}}</td>
                    <td>{{$st->name}}</td>
                    <td>{{$st->age}}</td>
                @if($st->gender==1)
                    <td><i class="fa fa-mars"></i></td>
                @else
                    <td><i class="fa fa-venus"></i></td>
                @endif
                    <td>{{$st->email}}</td>
                    <td>{{$st->address}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">{{$student->links()}}</div>
    </div>
@endsection
