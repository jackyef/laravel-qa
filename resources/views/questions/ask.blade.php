@extends('layouts.master')

@section('title', 'Ask a question');

@section('content')
    <style>
        .tags-picker{
            border: 0px solid black;

        }
    </style>
    <h3>Ask a question</h3>
    <form action="{{url('ask')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group label-floating">
            <label class="control-label" for="question_title">Question title</label>
            <input class="form-control" type="text" name="question_title" value="{{$question ?: ''}}" required/>
        </div>
        <div class="form-group label-floating">
            <label class="control-label" for="first_post">Describe your question</label>
            <textarea class="form-control" rows="7" name="first_post" required></textarea>
        </div>

        <div class="form-group">
            Tags:
            <select class="tags-picker form-control" id="tags[]" name="tags[]" multiple required>
                @foreach($allowed_tags as $tag)
                    <option value="{{$tag->id}}">#{{$tag->tag}}</option>
                @endforeach
            </select>
            <script>
                $(".tags-picker").tokenize2({
                    tokensMaxItems: 5,
                    dataSource: 'select',
                    placeholder: 'Type something to start',
                    searchFromStart: false,
                });
            </script>

        </div>

        <div class="form-group right">
            <button type="submit" class="btn-block btn btn-primary">Ask!</button>
        </div>
    </form>

@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop