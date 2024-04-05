@extends('layout')

@section('content')

    <h2>Index</h2>

    <div class="row">
        <div class="col s12">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In pulvinar gravida ante. Ut pellentesque, eros in vestibulum dapibus, elit risus volutpat elit, quis iaculis justo nibh non tellus. Nulla est enim, dapibus consequat metus at, condimentum finibus sem. Phasellus ut lacus massa. Quisque lectus mauris, volutpat quis justo vel, aliquam consectetur sem. Vestibulum vulputate eros et massa mattis laoreet. Suspendisse id est et est gravida ornare.

Ut consectetur, erat eget congue aliquet, velit ex hendrerit massa, quis consectetur erat magna at urna. Cras vel urna elit. Pellentesque sodales consequat elementum. In hac habitasse platea dictumst. Integer nunc nunc, volutpat et urna nec, consectetur vulputate tortor. Ut viverra arcu vel sapien cursus feugiat nec vel risus. Sed ut nibh justo.</p>
        </div>
        <div class="col s6">
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator responsive-img" src="{{ Storage::url('images/index_1.jpg') }}">
            </div>
        </div>
        <div class="col s6">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator responsive-img" src="{{ Storage::url('images/index_2.jpg') }}">
            </div>
        </div>
    </div>
    <div class="container center">
        <p><a href="produtos" class="btn waves-effect large red black">Link qualquer</a></p>
    </div>
    
@endsection
