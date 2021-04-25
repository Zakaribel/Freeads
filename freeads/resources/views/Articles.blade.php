@extends('layouts.app')

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session()->get('success') }}
    </div>
    @endif
    

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($annonces->count())
            @foreach($annonces->sortByDesc('created_at') as $value)

            <div class="card" style="margin: 30px; padding: 15px;border:3px solid;">
                <p> <b> Author :</b> {{$value->user->name}}</p>


                <div class="card">
                <label style="text-align: center;"><b> Title :</b> {{$value->title}} </label>
                </div>

                <div class="card">
                <label style="height: 100px;margin-top:1%;text-align:center"><b> Description :</b> <br><br> {{$value->description}} </label>
                <div style="text-align: center;">
                 <img src="{{ public_path('img/').$value->photo }}" height="100px" width="200px" >
                 </div>

                </div>
                
                <div class="card">
                <label style="text-align: right;margin-right:2%;"><b> Price :</b> {{$value->price}} </label>
                </div>
                <a class="btn btn-info" href="{{'/articleEdit?id='.$value->id}}"> Edit</a>
                <a class="btn btn-danger" href="{{'/articleDelete?id='.$value->id}}"> Delete</a>

            

            </div>

            @endforeach

            @else

            <p>No articles published yet.</p>

            @endif

        </div>
    </div>
</div>

</div>

@endsection