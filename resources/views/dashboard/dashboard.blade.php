
@extends('main')

@section('content')

    <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">Number of Students(الطلاب)</p>
                    <p class="fs-30 mb-2">{{$students}}</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total subjects(مواد)</p>
                    <p class="fs-30 mb-2">{{$material}}</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-light-danger">
                <div class="card-body">
                    <p class="mb-4">Total Exams(امتحانات)</p>
                    <p class="fs-30 mb-2">{{$exam}}</p>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Total results (نتايج)</p>
                    <p class="fs-30 mb-2">{{$result}}</p>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

@endsection
