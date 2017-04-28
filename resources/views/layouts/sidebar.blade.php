@section('sidebar')
    {{--<div class="panel">--}}
        {{--<div class="panel-body">--}}
            {{--<div class="panel-content">--}}
                <div class="form-group label-floating">
                    <form action="{{url('/ask')}}" method="POST" class="">
                        <label for="question">Ask your question here</label>
                        <input type="text" name="question" class="form-control" placeholder="Ex: How do I..., Have anyone ever..., etc."/>
                        <a href="{{url('/ask')}}" class="btn btn-block btn-primary">Ask a question</a>
                    </form>
                </div>

                <h5>Most popular tags:</h5>
                <span class="tags">
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#php</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#apache</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#mongodb</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#angularjs</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#laravel</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#mysql</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#javascript</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#reactjs</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#react-native</span></a>
                    <a href="{{url('#')}}" class="tag"><span class="label label-info">#jquery</span></a>
                </span>
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop
