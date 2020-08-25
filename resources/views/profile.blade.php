@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>User Profile</h1>
        </div>
        <div class="row">
            <form action="profile" method="post">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group">
                    <label for="employee_id">Employee ID</label>
                    <select  name='id'>
                    @foreach ($employee as $employee)
                        <option value="{{$employee->id}}">
                        {{$employee->id}}
                        </option>
                    @endforeach
                    </select>
                    <br>
                    <label for="position_name">Age</label><br>
                    <input type="text"  id="posotion_name" name="age" placeholder="Age" value="{{ old('department_name') }}"> 

                    </div>
                    <label for="position_name">Height</label><br>
                    <input type="text"  id="posotion_name" name="height" placeholder="Height" value="{{ old('department_name') }}"><br>

                    <label for="position_name">Father Name</label><br>
                    <input type="text"  id="posotion_name" name="father_name" placeholder="Father Name" value="{{ old('department_name') }}">

                     </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
        <div class="col-md-8" >
            <table class="table table-responsive common-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee ID</th>
                        <th>Age</th>
                        <th>Height</th>
                        <th>Father Name</th>    
                        <th>Created at</th>
                        <th>Updated at</th>  
                    </tr>
                </thead>
                <tbody>
                @foreach ($profile as $profile)

                   
                        <tr>
                            <td><a href="{{url('/profile',$profile->id)}}">{{ $profile->id }}</td></a>
                            <td>{{ $profile->employee['name']}}</td>
                            <td>{{ $profile->age }}</td>
                            <td>{{ $profile->height }}</td>
                            <td>{{ $profile->father_name }}</td>
                            <td>{{ $employee->created_at }}</td>
                            <td>{{ $employee->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        
    </div>
@endsection