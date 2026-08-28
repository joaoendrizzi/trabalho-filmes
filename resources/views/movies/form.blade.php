@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="title">Título</label>
        <input class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="year">Ano</label>
        <input class="form-control @error('year') is-invalid @enderror" id="year" name="year" type="number" min="1888" max="{{ date('Y') + 5 }}" value="{{ old('year', $movie->year) }}" required>
        @error('year')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="category_id">Categoria</label>
        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
            <option value="">Selecione</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $movie->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="trailer_url">Trailer</label>
        <input class="form-control @error('trailer_url') is-invalid @enderror" id="trailer_url" name="trailer_url" type="url" value="{{ old('trailer_url', $movie->trailer_url) }}">
        @error('trailer_url')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="synopsis">Sinopse</label>
        <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis" rows="5" required>{{ old('synopsis', $movie->synopsis) }}</textarea>
        @error('synopsis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="cover_image">Capa</label>
        <input class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" type="file" accept="image/*">
        @error('cover_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($movie->cover_image)
            <img class="img-thumbnail mt-3" src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" style="max-height: 180px">
        @endif
    </div>
</div>
<div class="d-flex gap-2 mt-4">
    <button class="btn btn-dark" type="submit">Salvar</button>
    <a class="btn btn-outline-secondary" href="{{ route('movies.index') }}">Cancelar</a>
</div>
