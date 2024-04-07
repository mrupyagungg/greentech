<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="d-flex align-items-center justify-content-between mb-5">
    <h1>artikel</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">
        Tambah Artikel
    </button>
</div>

<div class="row">
    @foreach ($articles as $item)
        <div class="col-md-4">
            <div class="card border-0 mb-3">
                <img src="{{ url('storage/' . $item->image)}}" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="mb-0 text-secondary">{{ $item->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="modal" id="addItem" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('artikel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title">Judul</label>
                        <input type="text" id="title" name="title" value="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image">Image</label>
                        <input type="file" accept="image/*" id="image" name="image" value="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
