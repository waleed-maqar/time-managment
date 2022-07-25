@extends('includes.mainTemplate')
@section('page-name', 'Home')
@section('content')
    <div class="ml-5 p-3 add-new-task">
        @include('includes.parts.addtaskform')
    </div>
    <div class="ml-5 p-3 update-task">
    </div>
    <span class="btn element-show add-task" custom-title="Add New Task" data-element=".add-new-task"><i
            class="fa-solid fa-plus"></i></span>
    <div class="main-site-container" id="main-site-container">
        @include('includes.pages.year')
    </div>
@endsection
