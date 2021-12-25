
@extends('main')

@section('content')

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                @include('includes.success')
                @include('includes.errors')
                <h4 class="card-title">Create and Show Subjects(المواد)</h4>
                <form class="form-sample" method="post" action="{{route('addMaterial')}}" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Subject Info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Subject Name(المادة)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="subject" class="form-control" required/>
                                </div>
                                @error('subject')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">section(القسم)</label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="category" required>
                                        <option value="">اختر القسم</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @error('category')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">photo( صورة المادة)</label>
                            <div class="col-sm-9">
                            <input type="file" name="img" class="form-control" required>

                            </div>
                            @error('img')
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
                            <th>Subject Name</th>
                             <th>section</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($materials as $mat)
                        <tr>
                            <td>{{$mat->id}}</td>
                            <td>{{$mat->name}}</td>
                            <td>{{$mat->category['name']}}</td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
