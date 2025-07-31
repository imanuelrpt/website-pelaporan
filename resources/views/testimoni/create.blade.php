@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Berikan Testimoni Anda</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('testimoni.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="testimoni" class="form-label">Testimoni</label>
                            <textarea name="testimoni" id="testimoni" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="rating">
                                <input type="radio" name="rating" id="rating-5" value="5" required><label for="rating-5">☆</label>
                                <input type="radio" name="rating" id="rating-4" value="4"><label for="rating-4">☆</label>
                                <input type="radio" name="rating" id="rating-3" value="3"><label for="rating-3">☆</label>
                                <input type="radio" name="rating" id="rating-2" value="2"><label for="rating-2">☆</label>
                                <input type="radio" name="rating" id="rating-1" value="1"><label for="rating-1">☆</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}
.rating > input {
    display: none;
}
.rating > label {
    position: relative;
    width: 1.1em;
    font-size: 3rem;
    color: #FFD600;
    cursor: pointer;
}
.rating > label::before {
    content: "\2605";
    position: absolute;
    opacity: 0;
}
.rating > label:hover:before,
.rating > label:hover ~ label:before {
    opacity: 1 !important;
}
.rating > input:checked ~ label:before {
    opacity: 1;
}
.rating:hover > input:checked ~ label:before {
    opacity: 0.4;
}
</style>
@endsection
