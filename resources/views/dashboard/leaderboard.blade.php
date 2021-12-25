
@extends('main')

@section('content')


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Leader Board students</h4>
                <p class="card-description">
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>points</th>
                            <th>Total Exam number</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($leaderboard as $led)

                                <tr>
                                    <td>{{$led->id}}</td>
                                    <td>{{$led->user->name}}</td>
                                    <td>{{$led['SUM(result)']}}</td>
                                    <td>{{$led['count(exam_id)']}}</td>
                                    <td>{{$led->user->email}}</td>
                                    {{--                                {{dd($mat->examsubsection[0]['name']);}}--}}
                                    {{--
                                                                    <td>{{$mat->examsubsection[0]['name']}}</td>
                                                                    <td>{{$mat->examsubsection[0]->section['name']}}</td>
                                    {{--                                <td>{{$sub->section->material['name']}}</td>--}}

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
