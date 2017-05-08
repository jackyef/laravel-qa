@extends('layouts.master')

@section('title', 'Laravel-based Q&A Forum');

@section('content')
    <script>
        $(document).ready(function () {
            $("#filter-picker").on('change', function(){
                window.location.href = "{{url('/?filter=')}}" + $("#filter-picker").val();
            });
        });
    </script>
    <h3>All Questions</h3>
    <div>
        <select class="selectpicker" id="filter-picker" style="background: white !important;">
            <option value="recent"   {{$filter === "recent" ? 'selected' : ''}} >Recent</option>
{{--            <option value="trending" {{$filter === "trending" ? 'selected' : ''}} >Trending</option>--}}
            <option value="open"     {{$filter === "open" ? 'selected' : ''}} >Open</option>
            <option value="answered" {{$filter === "answered" ? 'selected' : ''}} >Answered</option>
        </select>
        <!-- pagination controls -->
        <div class="pull-right">
            {{$questions->links()}}
        </div>
    </div>
    <div id="questions">
        @if (sizeof($questions) == 0)
            <div class="jumbotron">
                <center>
                    <h6>No questions found</h6>
                </center>
            </div>
        @endif
        @foreach ($questions as $question)
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2"  style="display: flex; justify-content: center; flex-direction: row">
                            <center>
                                <br/><span style="font-size: 1.7em">{{$question['votes']}}</span><br/>votes<br/><br/>
                                <span class="hidden-xs label label-{{ $question->accepted_answer_id == 0 ? 'warning' : 'success' }}">{{ $question->accepted_answer_id == 0 ? 'Open' : 'Answered' }}</span>
                                <span class="visible-xs label label-{{ $question->accepted_answer_id == 0 ? 'warning' : 'success' }}" style="padding: .3em 0 .3em 0">{!! $question->accepted_answer_id == 0 ? '<i class="fa fa-comments"></i>' : '<i class="fa fa-check"></i>' !!}</span>
                            </center>
                        </div>
                        <div class="col-sm-8 col-xs-10">
                            <br/>
                            <div class="card-title" style="font-size: 1.4em;">
                                <a href="{{url("/question/$question->id")}}">{{$question['question_title']}}</a>
                            </div>
                            <div class="card-description" style="font-size: .9em;">Asked
                                <span data-time-format="time-ago" data-time-value="{{strtotime($question['created_at'])}}"></span>
                                by <a href="{{url('/profile/'.$question['asker'])}}">{{$question['asker']}}</a>

                            </div>
                            <br/>
                            <span class="tags">
                            @foreach($question['tags'] as $tag)<a href="{{url("/tag/$tag")}}" class="tag"><span class="label label-info">#{{$tag}}</span></a>&nbsp;
                            @endforeach
                            </span>
                        </div>
                        <div class="col-sm-2 hidden-xs"  style="height:7em; display: flex; justify-content: center; flex-direction: column;">
                            <div>
                                <table>
                                    {{--<tr>--}}
                                        {{--<td><span class="fa fa-group"></span></td>--}}
                                        {{--<td>&nbsp;</td>--}}
                                        {{--<td><span style="font-size: .75em">1,204 viewers</span></td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td><span class="fa fa-comments"></span></td>
                                        <td>&nbsp;</td>
                                        <td><span style="font-size: .75em">{{$question['answers']}} answers</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
        @endforeach

        <!-- pagination controls -->
        <div class="pull-right">
            {{$questions->links()}}
        </div>

    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop