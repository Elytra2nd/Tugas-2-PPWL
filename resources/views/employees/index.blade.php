
@extends('employees.layout')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Employee Management System</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Position</th>
            <th>Salary</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($employees as $employee)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->position }}</td>
            <td>{{ $employee->salary }}</td>
            <td>
                <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $employees->links() !!}

@endsection
