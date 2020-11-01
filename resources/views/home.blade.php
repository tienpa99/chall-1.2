@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h2 style="text-align: center" >""welcome <b>{{Auth::user()->fullname}}</b>""</h2>
                    <center><div class="tenor-gif-embed" data-postid="4960761" data-share-method="host" data-width="50%" data-aspect-ratio="1.0873015873015872"><a href="https://tenor.com/view/magic-shaia-gif-4960761">Magic Shaia GIF</a> from <a href="https://tenor.com/search/magic-gifs">Magic GIFs</a></div><script type="text/javascript" async src="https://tenor.com/embed.js"></script></center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
