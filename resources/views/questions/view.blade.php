@extends('layouts.master')

@section('title')
    {{$question->question_title}}
@stop

@section('content')
    <style>
        .tags-picker{
            border: 0px solid black;

        }
        .post{
            font-size: 1.3em;
            padding: .6em;
        }
        .poster{
            font-size: .8em;
            color: gray;
            /*text-align: right;*/
            line-height: 1.5em;
        }
        .unvoted{
            color: lightgray;
            transition-duration: .3s;
        }
        .unvoted:hover{
            color: #333399;
            transition-duration: .3s;
        }
        .btn-accept{
            opacity: .5;
        }
        .btn-accept:hover{
            opacity: 1;
        }

    </style>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=626065587603555";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <h3>{{$question->question_title}}</h3>
    Tags:<span class="tags">                     &nbsp;
        @foreach($question_tags as $tag)
            <a href="{{url("/tag/$tag")}}" class="tag"><span class="label label-info">#{{$tag}}</span></a>
        @endforeach
    </span>
    <br/>
    <div class="row" id="{{$answers[0]->id}}">
        <div class="col-xs-12">
            <div class="col-xs-10 post">
                {!! nl2br($first_post->post_content) !!}
            </div>

            <div class="col-xs-2">
                <center>
                    &nbsp;<a href="
                            {{ (!$answers[0]->voted) ? url("/vote/".$answers[0]->id) : url("/unvote/".$answers[0]->id)}}"
                            {!! ($answers[0]->voted) ? 'data-toggle="tooltip" data-placement="top" title="You already voted for this post"' : '' !!}><span class="
                             @if (!$answers[0]->voted)
                                unvoted
                            @endif
                            fa fa-3x fa-caret-up"></span></a>
                    <br/><span style="font-size: 1.7em">{{$first_post->votes}}</span><br/><span class="hidden-xs">votes<br/></span><br/>
                    <span class="hidden-xs label label-{{ $question->accepted_answer_id == 0 ? 'warning' : 'success' }}">{{ $question->accepted_answer_id == 0 ? 'Open' : 'Answered' }}</span>
                    <span class="visible-xs label label-{{ $question->accepted_answer_id == 0 ? 'warning' : 'success' }}" style="padding: .3em 0 .3em 0">{!! $question->accepted_answer_id == 0 ? '<i class="fa fa-comments"></i>' : '<i class="fa fa-check"></i>' !!}</span>
                </center>
                <br/>
            </div>
        </div>
        {{--<div class="col-xs-12">--}}
            {{--<!-- comments here -->--}}

            {{--<!-- form to add comments here -->--}}
            {{--<form action="{{url('/comment')}}">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}"/>--}}
                {{--<input type="hidden" name="post_id" value="{{$first_post->id}}"/>--}}
                {{--<input type="text" class="form-control" placeholder="Comment here... (max 200 characters)" />--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
    <hr/>
    @if($question->accepted_answer_id !== 0)
        <h3>Accepted answer <i class="fa fa-check" style="color: rgb(76, 175, 80);"></i></h3>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-10 post">
                    {!! nl2br($accepted_answer->post_content) !!}
                </div>
                <div class="col-xs-2">
                    <center>
                        &nbsp;<a href="
                                {{ (!$accepted_answer->voted) ? url("/vote/$accepted_answer->id") : url("/unvote/".$accepted_answer->id)}}"
                                {!! ($accepted_answer->voted) ? 'data-toggle="tooltip" data-placement="top" title="You already voted for this post"' : '' !!}><span class="
                                 @if (!$accepted_answer->voted)
                                    unvoted
                                @endif
                                    fa fa-3x fa-caret-up"></span></a>
                        <br/><span style="font-size: 1.7em">{{$accepted_answer->votes}}</span><br/><span class="hidden-xs">votes<br/></span><br/>
                        @if (Session::get('id') === $first_post->user_id && $question->accepted_answer_id === 0)
                            <form action="{{url("/question/accept-answer")}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <input type="hidden" name="post_id" value="{{$accepted_answer->id}}">
                                <button class="btn btn-success btn-sm btn-round"><span class="fa fa-check-box"></span><span class="hidden-xs"> Accept</span></button>
                            </form>
                        @endif
                        @if ($question->accepted_answer_id === $accepted_answer->id)
                            <span class="hidden-xs label label-sm label-success"><span class="fa fa-check"></span> Answer</span>
                            <span class="visible-xs label label-sm label-success" style="padding: .3em 0 .3em 0"><span class="fa fa-check"></span></span>
                        @endif
                    </center>
                    <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-sm-12 poster">
                        answer given by
                        <a href="{{url("/profile/$accepted_answer->username")}}">
                            {{$accepted_answer->username}}</a> on <span data-time-format="time-ago" data-time-value="{{strtotime($accepted_answer->created_at)}}"></span>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
    @endif
    <h3>Answers ({{$answers->count()-1}})</h3>
    <hr/>
    <div class="pull-right">
        {{$answers->links()}}
    </div>
    <div class="clearfix"></div>
    <div>
        @foreach($answers as $answer)
            @if ($answer->id == $first_post->id) @continue @endif <!-- not showing the first post twice -->
            <div class="row" id="{{$answer->id}}">
                <div class="col-xs-12">
                    <div class="col-xs-10 post">
                        {!! nl2br($answer->post_content) !!}
                    </div>
                    <div class="col-xs-2">
                        <center>
                            &nbsp;<a href="
                                    {{ (!$answer->voted) ? url("/vote/$answer->id") : url("/unvote/".$answer->id)}}"
                                    {!! ($answer->voted) ? 'data-toggle="tooltip" data-placement="top" title="You already voted for this post"' : '' !!}><span class="
                                     @if (!$answer->voted)
                                        unvoted
                                    @endif
                                    fa fa-3x fa-caret-up"></span></a>
                            <br/><span style="font-size: 1.7em">{{$answer->votes}}</span><br/><span class="hidden-xs">votes<br/></span><br/>
                            @if (Session::get('id') === $first_post->user_id && $question->accepted_answer_id === 0)
                                <form action="{{url("/question/accept-answer")}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="question_id" value="{{$question->id}}">
                                    <input type="hidden" name="post_id" value="{{$answer->id}}">
                                    <button class="btn btn-success btn-xs btn-round btn-accept" style="padding: .5em"><span class="fa fa-check"></span><span class="hidden-xs"> Accept</span></button>
                                </form>
                            @endif
                            @if ($question->accepted_answer_id === $answer->id)
                                <span class="hidden-xs label label-sm label-success"><span class="fa fa-check"></span> Answer</span>
                                <span class="visible-xs label label-sm label-success" style="padding: .3em 0 .3em 0"><span class="fa fa-check"></span></span>
                            @endif
                        </center>
                        <br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-12 poster">
                            answer given by
                            <a href="{{url("/profile/$answer->username")}}">
                                {{$answer->username}}</a> on <span data-time-format="time-ago" data-time-value="{{strtotime($answer->created_at)}}"></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
        @endforeach
    </div>

    <div class="pull-right">
        {{$answers->links()}}
    </div>
    <div class="clearfix"></div>

    @if (Session::has('username'))
        @if ($question->accepted_answer_id === 0)
        <form action="{{url("/question/answer")}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <div class="form-group">
                <label class="control-label" for="first_post">Give your answer</label>
                <textarea class="form-control" rows="7" name="post_content" required></textarea>
            </div>
            <div class="form-group right">
                <button type="submit" class="btn-block btn btn-success"><span class="fa fa-comments"></span> Answer</button>
            </div>
        </form>
        @endif
    @else
        <h3>Think you know the answer? Join the community to start contributing!</h3>
        <button class="btn btn-block btn-primary" onclick="$('#loginModal').modal('show');"><span class="fa fa-sign-in"></span> Login/Signup</button>
    @endif

@stop

@section('sidebar')
    @extends('layouts.sidebar')
    <div class="row">
        <div class="col-sm-12"
             data-mobile-iframe="true">
            <a class="fb-xfbml-parse-ignore" target="_blank"
               href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current())}}&amp;src=sdkpreparse">
                <button class="btn btn-xs btn-primary"><span class="fa fa-share"></span> Share this question on Facebook</button>
            </a>

            {{--<div class="fb-share-button"--}}
                 {{--data-href="{{url()->current()}}"--}}
                 {{--data-layout="button_count"--}}
                 {{--data-size="small"--}}
                 {{--data-mobile-iframe="true">--}}
                {{--<a class="fb-xfbml-parse-ignore" target="_blank"--}}
                   {{--href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current())}}&amp;src=sdkpreparse">--}}
                    {{--Share--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="row hidden-xs">
        <div class="col-sm-4" style="color:gray">asked</div>
        <div class="col-sm-8"><span data-time-format="time-ago" data-time-value="{{strtotime($question->created_at)}}"></span></div>
    </div>

    <div class="row hidden-xs">
        <div class="col-sm-4" style="color:gray">by</div>
        <div class="col-sm-8">
            <a href="{{url("/profile/$first_post->username")}}">
                {{$first_post->username}}
            </a></div>
    </div>
    <div class="row hidden-xs">
        <div class="col-sm-4" style="color:gray">active</div>
        <div class="col-sm-8"><span data-time-format="time-ago" data-time-value="{{strtotime($last_post->created_at)}}"></span></div>
    </div>
    <div class="row hidden-xs">
        <div class="col-sm-4" style="color:gray">votes</div>
        <div class="col-sm-8">{{$first_post->votes}}</div>
    </div>
    <hr/>
    @parent
@stop