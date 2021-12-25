
@extends('main')





@section('content')

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('includes.success')
                @include('includes.errors')
                <h4 class="card-title">Create  exams(امتحانات)</h4>
                <form class="form-sample" method="post" action="{{route('addExam')}}" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Subject Info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">subject( المادة)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="material" id="material" required>
                                        @foreach($material as $mat)
                                            <option value="{{$mat->id}}">{{$mat->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('material')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">unit( وحدة او فصل)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="section" id="section" required>

                                    </select>

                                </div>
                                @error('section')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">lesson(الدرس)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="subsection" id="subsection" required>
{{--                                        @foreach($categories as $category)--}}
{{--                                            <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>

                                </div>
                                @error('subsection')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">exam name(اسم الامتحان)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="exam" class="form-control" required/>
                                </div>
                                @error('exam')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>




                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--    table of data
    --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> all Subjects added</h4>
                <p class="card-description">
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Exam Name</th>
                            <th>lesson Name</th>
                            <th>Unit Name</th>
                            <th>Subject</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mat->examsubsection as $sub)
                        @foreach($material as $mat)
                            <tr>
                                <td>{{$mat->id}}</td>
                                <td>{{$mat->name}}</td>
                                <td>{{$sub->name}}</td>
                                <td>{{$sub->section['name']}}</td>
                                <td>{{$sub->section->material['name']}}</td>
{{--                                {{dd($mat->examsubsection[0]['name']);}}--}}
{{--
                                <td>{{$mat->examsubsection[0]['name']}}</td>
                                <td>{{$mat->examsubsection[0]->section['name']}}</td>
{{--                                <td>{{$sub->section->material['name']}}</td>--}}
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function ()
            {
                $.ajaxSetup({
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                $('#material').change(function (){

                    var id = $("#material").val();
                    var url = '{{ url('ajax') }}';

                    $.ajax({
                        url:url,
                        method:'get',
                        data:{
                            section:id,

                        },

                        success:function(response){

                            $('#section').empty();
                            $.each(response.data,function (key,item)
                            {
                                $('#section').append('<option   value="'+item.id+'">'+item.name+' </option>');
                            })


                        },
                        error:function(error){
                            console.log(error)
                        }
                    });

                })
            });
        </script>
    <script>
        $(document).ready(function ()
        {
            $.ajaxSetup({
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            $('#section').change(function (){

                var id = $("#section").val();
                var url = '{{ url('ajax') }}';

                $.ajax({
                    url:url,
                    method:'get',
                    data:{
                        section:id,

                    },

                    success:function(response){

                        $('#subsection').empty();
                        $.each(response.data,function (key,item)
                        {
                            $('#subsection').append('<option   value="'+item.id+'">'+item.name+' </option>');
                        })


                    },
                    error:function(error){
                        console.log(error)
                    }
                });

            })
        });
    </script>
    @endsection
@endsection


