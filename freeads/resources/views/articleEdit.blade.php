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
                <div class="card">

                    <form action="" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input type="text" name="title" required placeholder="Title "><br><br>
                        <label><b>Photo :</b> </label>
                        <input type="file"  name="photo" required>
                        <input type="textarea" name="description" required placeholder="Descritpion" size="50"><br><br>
                        <input type="text" name="price" required placeholder="Price (€)"><br><br>

                        <input type="submit" value="Modify your article">

                    </form>

                </div>
            </div>
        </div>
</div>


@endsection



