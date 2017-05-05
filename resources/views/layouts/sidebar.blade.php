@section('sidebar')
        {{--<div class="panel">--}}
        {{--<div class="panel-body">--}}
        {{--<div class="panel-content">--}}
        <div class="form-group label-floating">
            @if (Session::has('username'))
                    <form action="{{url('/ask')}}" method="GET" class="">
                        <label for="question">Ask your question here</label>
                        <input required type="text" name="question" class="form-control" placeholder="Ex: How do I..., Have anyone ever..., etc."/>
                        <button class="btn btn-block btn-primary">Ask a question</button>
                    </form>
                    @else
                        <h3>Join the community to ask questions!</h3>
                        <button class="btn btn-block btn-primary" onclick="$('#loginModal').modal('show');"><span class="fa fa-sign-in"></span> Login/Signup</button>
                    @endif

                </div>

                <h5>Most popular tags:</h5>
                <span class="tags">
                    @foreach (Session::get('popular_tags') as $tag)
                        <a href="{{url("/tag/$tag->tag")}}" class="tag"><span class="label label-info">#{{$tag->tag}}</span></a>
                        &nbsp;
                    @endforeach
                    &nbsp;
                </span>
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop
