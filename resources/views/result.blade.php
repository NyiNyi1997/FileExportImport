@foreach ($profiles as $profile)
Employee Name: <span>{{$profile->employee['name']}}</span><br>
Age :<span>{{$profile->age}}</span><br>
Height :<span>{{$profile->height}}</span><br>
Father Name :<span>{{$profile->father_name}}</span><br>
Email:<span>{{$profile->employee['email']}}</span><br>
Salary :<span>{{$profile->employee['salary']}}</span><br>
@endforeach