@section('sidebar')
        <div class="form-group label-floating">
            @if (Session::has('username'))
            <form action="{{url('/ask')}}" method="GET" class="">
                <label for="question">Ask your question here</label>
                <input required type="text" name="question" class="form-control" placeholder="Ex: How do I..., Have anyone ever..., etc."/>
                <button class="btn btn-block btn-primary"><i class="fa fa-comment"></i> Ask a question</button>
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

        @if(Session::get('is_admin') === 1)
        <hr/>
        <h5><i class="fa fa-cog"></i> Admin tools</h5>
        <form action="{{url('/add-tags')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            Add new tags:
            <select class="tags-picker form-control" id="tags" name="tags[]" multiple required>
            </select>
            <script>
                $(".tags-picker").tokenize2({
                    tokensMaxItems: 0,
                    dataSource: 'select',
                    placeholder: 'Add new tags here',
                    tokensAllowCustom: true,
                    searchFromStart: false,
                    delimiter: [',', ' ', '\t', '\n', '\r\n'],
                });
            </script>
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Add tags</button>
        </form>
        @endif
@stop
