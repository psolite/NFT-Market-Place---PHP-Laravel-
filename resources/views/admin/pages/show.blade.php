@extends('admin.layouts.master')
@section('title')
    Edit Page
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Page
        @endslot
        @slot('title')
            Edit Page
        @endslot
    @endcomponent
    <form id="page" action="{{ route('admin.page.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $page->title }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Page Content</label>
                            <input type="hidden" class="form-control" id="content" name="content">
                            <div class="snow-editor" id="editor4" style="height: 300px;">
                                {!! $page->content !!}
                            </div> <!-- end Snow-editor-->
                            <script>
                                var form = document.getElementById("page"); // get form by ID
                                form.onsubmit = function() { // onsubmit do this first
                                    var myEditor1 = document.querySelector('#editor4')
                                    var html1 = myEditor1.children[0].innerHTML
                                    var name1 = document.getElementById('content'); // set name input var
                                    name1.value = html1; // populate name input with quill data

                                }
                            </script>


                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-success w-sm">Save Changes</button>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/quill/quill.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/project-create.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
