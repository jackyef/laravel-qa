@extends('layouts.master')

@section('title', 'Ask a question');

@section('content')
    <style>
        .vcenter {
            display: inline-block;
            vertical-align: middle;
            float: none;
        }
        #about-container {
            display: table;
        }
        .about-col {
            display: table-cell;
            vertical-align: middle;
            border: 1px solid black;
        }
        .instagram-bg{
            background: -webkit-radial-gradient(circle farthest-corner at 35% 90%, #fec564, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(circle farthest-corner at 0 140%, #fec564, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, rgba(0, 0, 0, 0) 50%), -webkit-radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, rgba(0, 0, 0, 0)), -webkit-linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);
            background: radial-gradient(circle farthest-corner at 35% 90%, #fec564, rgba(0, 0, 0, 0) 50%), radial-gradient(circle farthest-corner at 0 140%, #fec564, rgba(0, 0, 0, 0) 50%), radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, rgba(0, 0, 0, 0) 50%), radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, rgba(0, 0, 0, 0) 50%), radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, rgba(0, 0, 0, 0) 50%), radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, rgba(0, 0, 0, 0) 50%), radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, rgba(0, 0, 0, 0)), linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);
        }
        .social-buttons{
            text-align: right;
        }

    </style>
    <h3>About</h3>
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <img src="{{url('/images/about.jpg')}}"
                    class="img-rounded img-responsive img-raised"/>
            </div>
            <div class="col-sm-9">
                <h3>Jacky Efendi</h3>
                A final year student at <a href="https://pcr.ac.id" target="_blank">Politeknik Caltex Riau</a> with a GPA of 3.97, majoring in
                informatics engineering. Will graduate on October 2017.
                <br/>
                <br/>
                A web developer who primarily codes in PHP and Javascript. Aspiring to be a mobile developer as well.
                <br/>
                I love the idea of using technology to build something that can really change how people live their daily life.
                To build something that is pleasant to use by people, to change things we do in daily life, but achieve them
                in an easy and delightful manner. To do both of those things while reaching a lot of people at once. These are
                the main reasons for my fondness of the web and mobile platform.
                <br/>
                <br/>
                Currently self-studying at Udacity, Coursera, Edx, and FreeCodeCamp.
                <br/>
                <br/>
                <div class="social-buttons">
                        <a href="https://github.com/jackyef/" target="_blank"><br/>
                        <button class="btn btn-fab" style="background-color: rgb(36,41,46);">
                            <span class="fa fa-github " style="min-width: 1em;"></span>
                        </button></a>
                    <a href="http://codepen.io/jackyef/pens/public/" target="_blank">
                        <button class="btn btn-fab" style="background-color: #111;">
                            <span class="fa fa-codepen " style="min-width: 1em"></span>
                        </button></a>
                    <a href="https://www.freecodecamp.com/jackyef" target="_blank">
                        <button class="btn btn-fab" style="background-color: rgb(0,100,0);">
                            <span class="fa fa-free-code-camp " style="min-width: 1em"></span>
                        </button></a>
                    <a href="https://facebook.com/zhouyongchao" target="_blank">
                        <button class="btn btn-fab" style="background-color: #3b5998;">
                            <span class="fa fa-facebook " style="min-width: 1em"></span>
                        </button></a>
                    <a href="https://instagram.com/jackyef_" target="_blank">
                        <button class="btn btn-fab instagram-bg">
                            <span class="fa fa-instagram " style="min-width: 1em"></span>
                        </button></a>
                    <a href="https://www.linkedin.com/in/jacky-efendi-094643a1/" target="_blank">
                        <button class="btn btn-fab" style="background-color: #0077B5;">
                            <span class="fa fa-linkedin " style="min-width: 1em"></span>
                        </button></a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('sidebar')
    @include('layouts.sidebar')
@stop