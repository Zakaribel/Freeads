@extends('layouts.app')

@section('content')



<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form action="" method="POST" enctype="multipart/form-data">

                    @csrf

                    <input type="text" name="title" required placeholder="Title "><br><br>
                    <label><b>Photo :</b> </label>
                    <input type="file" name="photo" required>
                    <input type="textarea" name="description" required placeholder="Descritpion" size="50"><br><br>
                    <input type="text" name="price" required placeholder="Price (€)"><br><br>

                    <input type="submit" value="Submit your article">

                </form>

            </div>
        </div>
    </div>
</div>


@endsection