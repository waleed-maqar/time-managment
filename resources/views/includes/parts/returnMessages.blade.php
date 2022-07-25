<span class="col-1 btn btn-dark float-right element-close" data-element=".return-messages">X</span>
@if ($messages)
    <ul class="col-11">
        @foreach ($messages as $error)
            @foreach ($error as $message)
                <li class="list-group-item list-group-item-danger">{{ $message }}</li>
            @endforeach
        @endforeach
    </ul>
    <div class="offset-2"></div>
@endif
