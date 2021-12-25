@if(Session::has('success'))
    <div class="row mr-2 ml-2">
        <button type="text" class="alert alert-success text-center"
                id="type-error">{{Session::get('success')}}</button>
    </div>
@endif
