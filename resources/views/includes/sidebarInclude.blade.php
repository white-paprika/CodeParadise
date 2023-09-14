<form action="{{ route('books.index') }}" method="GET">
    <input type="text" name="filter[name]" id="searchbar">
    {{-- <button type="submit">Find</button> --}}

    {{-- Price --}}
    <div class="price-input-wrap">
        <div class="price-input">
  
          <div class="field">
            <span>Min</span>
            <input type="number" class="input-min" value="2500" name="filter[price_range][0]" id="min-price-input">
          </div>
  
          <div class="separator">-</div>
  
          <div class="field">
            <span>Max</span>
            <input type="number" class="input-max" value="7500" name="filter[price_range][1]" id="max-price-input">
          </div>
  
        </div>
        <div class="slider">
          <div class="progress"></div>
        </div>
        <div class="range-input">
          <input type="range" class="range-min" min="0" max="10000" value="2500" step="100" id="min-price-slider">
          <input type="range" class="range-max" min="0" max="10000" value="7500" step="100" id="max-price-slider">
        </div>
    </div>
    {{-- End Price --}}

    {{-- Sorting --}}
    <select name="sort" id="sort_select" class="form-select mt-5" style="width: 200px">
        <option selected value="created_at">Newest first</option>
        <option value="-created_at">Oldest first</option>
        <option value="price">Price: Low to High</option>
        <option value="-price">Price: High to Low</option>
        <option value="name">Name A-Z</option>
        <option value="-name">Name Z-A</option>
        <option value="release_year">Release year: old first</option>
        <option value="-release_year">Release year: new first</option>
        <option value="items_in_stock">In stock: less first</option>
        <option value="-items_in_stock">In stock: more first</option>
      </select>
    {{-- End Sorting --}}

    {{-- Genres --}}
    @foreach ($genres as $genre)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="filter[genres][]" value="{{$genre->name}}" id="flexCheck{{$genre->name}}">
        <label class="form-check-label" for="flexCheck{{$genre->name}}">
        {{$genre->name}}
        </label>
    </div>
    @endforeach
    {{-- End Genres --}}
</form>