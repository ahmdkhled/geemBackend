
@extends('main')





@section('content')

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('includes.success')
                @include('includes.errors')
                <h4 class="card-title">Create  Questions(السؤال)</h4>
                <form class="form-sample" method="post" action="{{route('addQuestion')}}" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Subject Info
                    </p>
                    <div class="row">
{{--                        subject--}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">subject( المادة)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="material" id="material" required>
                                        <option value="">اختر المادة</option>
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
{{--                        unit--}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">unit( وحدة او فصل)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="section" id="section" required>
                                        <option value="">اختر الوحدة او الفصل</option>
                                    </select>

                                </div>
                                @error('section')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
{{--                lessson               ****   --}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">lesson(الدرس)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="subsection" id="subsection" required>
                                        <option value="">اختر الدرس</option>
                                    </select>

                                </div>
                                @error('subsection')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror

                            </div>
                        </div>
{{--       ************************    exam *************************--}}
                        <div class="col-md-6">
                            <div class="form-group row">

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group row">


                                <label class="col-sm-4 col-form-label">Question text(السؤال)</label>
                                <div class="col-sm-9">
                                    <textarea type="textarea" name="question" class="form-control" required>

                                    </textarea>
                                </div>
                                @error('exam')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">choice 1(الاختيار الاول)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="choice1" class="form-control" required/>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="check1">
                                        right choice
                                    </label>
                                    @error('check1')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                @error('choice1')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">choice 2(الاختيار التاني)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="choice2" class="form-control" required/>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="check2">
                                        right choice
                                    </label>
                                    @error('check2')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                @error('choice2')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">choice 3(الاختيار التالت)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="choice3" class="form-control" required/>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="check3">
                                        right choice
                                    </label>
                                    @error('check3')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                @error('choice3')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">choice 4(الاختيار الرابع)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="choice4" class="form-control" required/>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  name="check4">
                                        right choice
                                    </label>
                                    @error('check4')
                                    <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                @error('choice4')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="examcheck" id="optionsRadios3" value="1" >
                                            final exam
                                        </label>
                                        <small>check if final exam</small>
                                    </div>
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
                            <th>Subject</th>
                            <th>Unit Name</th>
                            <th>lesson Name</th>
                            <th>Exam question number</th>
                            <th>Exam type</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @foreach($mat->examsubsection as $sub)--}}
                            @foreach($question as $qes)
                                @if(filled($qes->exam) && filled($qes->exam->subsection) && filled($qes->exam->subsection->section) && filled($qes->exam->subsection->section->material))
                                <tr>
                                    <td>{{$qes->exam->subsection->section->material->id}}</td>
                                    <td>{{$qes->exam->subsection->section->material->name}}</td>
                                    <td>{{$qes->exam->subsection->section->name}}</td>
                                    <td>{{$qes->exam->subsection->name}}</td>
                                    <td>{{$qes['COUNT(id)']}}</td>
                                    <td>{{$qes->exam->type ? $qes->exam->type : "غير محدد"}}</td>

{{--                                    <td>{{$sub->section->material['name']}}</td>--}}

                                </tr>
                                @endif
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
                        material:id,

                    },

                    success:function(response){

                        $('#section').empty();
                        $('#section').append('<option   value="">'+"اختر الفصل"+' </option>')
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
            $('#subsection').change(function (){

                var id = $("#subsection").val();
                var url = '{{ url('ajax') }}';

                $.ajax({
                    url:url,
                    method:'get',
                    data:{
                        subsection:id,

                    },

                    success:function(response){
                        console.log()
                        $('#exam').empty();
                        $.each(response.data,function (key,item)
                        {

                        })
                        for (var i = 0; i < response.data.length; i++) {
                            // outputfromserver[i] can be used to get each value
                            $('#exam').append('<option   value="'+response.data[i][0].id+'">'+response.data[i][0].name+' </option>');
                        }


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


