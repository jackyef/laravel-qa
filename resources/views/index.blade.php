@extends('layouts.master')

@section('title', 'Laravel-based Q&A Forum');

@section('content')
    <div>
        <select class="selectpicker" style="background: white !important;">
            <option>Recent</option>
            <option>Trending</option>
            <option>Open</option>
            <option>Answered</option>
        </select>
    </div>
    <div id="questions">

        <div class="card">
        <div class="content">
            <div class="row" style="display: flex; justify-content: center; flex-direction: row">
                <div class="col-sm-2 hidden-xs">
                    <center>
                        <br/><span style="font-size: 1.7em">3</span><br/>votes<br/><br/>
                        <span class="label label-warning">Open</span>
                    </center>
                </div>
                <div class="col-sm-8">
                    <br/>
                    <div class="card-title" style="font-size: 1.4em;">
                        <a href="#">How do I check if a variable is empty in PHP?</a>
                    </div>
                    <div class="card-description" style="font-size: .9em;">Asked 3 mins ago by Jacky</div>
                    <br/>
                    <span class="tags">
                        <a href="{{url('#')}}" class="tag"><span class="label label-info">#php</span></a>
                        <a href="{{url('#')}}" class="tag"><span class="label label-info">#apache</span></a>
                    </span>
                </div>
                <div class="col-sm-2 hidden-xs" style="align-self: center;">
                    <div  style="vertical-align: middle">
                        <table style="top:50%; position: relative;">
                            <tr>
                                <td><span class="fa fa-group"></span></td>
                                <td>&nbsp;</td>
                                <td><span style="font-size: .75em">1,204 viewers</span></td>
                            </tr>
                            <tr>
                                <td><span class="fa fa-comments"></span></td>
                                <td>&nbsp;</td>
                                <td><span style="font-size: .75em">4 answers</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="content">
            <div class="row" style="display: flex; justify-content: center; flex-direction: row">
                <div class="col-sm-2 hidden-xs">
                    <center>
                        <br/><span style="font-size: 1.7em">94</span><br/>votes<br/><br/>
                        <span class="label label-success">Answered</span>
                    </center>
                </div>
                <div class="col-sm-8">
                    <br/>
                    <div class="card-title" style="font-size: 1.4em;">
                        <a href="#">How do I check if a variable is empty in PHP?</a>
                    </div>
                    <div class="card-description" style="font-size: .9em;">Asked 3 mins ago by Jacky</div>
                    <br/>
                    <span class="tags">
                        <a href="{{url('#')}}" class="tag"><span class="label label-info">#php</span></a>
                        <a href="{{url('#')}}" class="tag"><span class="label label-info">#apache</span></a>
                    </span>
                </div>
                <div class="col-sm-2 hidden-xs" style="align-self: center;">
                    <div  style="vertical-align: middle">
                        <table style="top:50%; position: relative;">
                            <tr>
                                <td><span class="fa fa-group"></span></td>
                                <td>&nbsp;</td>
                                <td><span style="font-size: .75em">94,212 viewers</span></td>
                            </tr>
                            <tr>
                                <td><span class="fa fa-comments"></span></td>
                                <td>&nbsp;</td>
                                <td><span style="font-size: .75em">24 answers</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>

    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop