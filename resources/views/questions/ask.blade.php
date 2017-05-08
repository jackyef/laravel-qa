@extends('layouts.master')

@section('title', 'Ask a question');

@section('content')
    <style>
        .tags-picker{
            border: 0px solid black;
        }
        .tag-error{
            display: none;
            color: red;
        }
        /*tokenizer item*/
        .token{
            /*color: cornflowerblue;*/
            /*background-color: lightblue !important;*/
            /*font-family: "Roboto", "Helvetica", "Arial", sans-serif;*/
            /*font-size: .7em;*/
            border: 0px solid black !important;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('#btn-custom').on('click', function(){
                if($('.tokens-container').children().length <= 2){
//                    console.log('token container no tags');
                    $('.tag-error').show().effect('shake');
                    $('.tokens-container').focus();
                    return false;
                } else {
                    $('.tag-error').hide();
                }
            });
        });
    </script>
    <h3>Ask a question</h3>
    <form id="askForm" action="{{url('ask')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group label-floating">
            <label class="control-label" for="question_title">Question title</label>
            <input class="form-control" type="text" name="question_title" value="{{$question ?: ''}}" required/>
        </div>
        <div class="form-group label-floating">
            <label class="control-label" for="first_post">Describe your question</label>
            <textarea class="form-control" rows="7" name="first_post" required></textarea>
        </div>

        <div class="form-group" id="tags-div">
            Tags: <span class="tag-error">You need to use at least one tag!</span>
            <select class="tags-picker form-control" id="tags" name="tags[]" multiple required>
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
                    displayNoResultsMessage: true,
                    noResultsMessageText: '&nbsp; No tags found. Try typing different term.'
                });
            </script>

        </div>

        <div class="form-group right">
            <button type="submit" id="btn-custom" class="btn-block btn btn-primary">Ask!</button>
        </div>
    </form>

@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop