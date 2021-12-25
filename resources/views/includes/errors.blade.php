@if(Session::has('error'))
    <div class="row mr-2 ml-2">
        <button type="text" class="alert alert-danger text-center"
                id="type-error">{{Session::get('error')}}</button>
    </div>
@endif
