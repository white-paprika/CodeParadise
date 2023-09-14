<table class="table table-bordered">
  <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Path</th>
          <th scope="col">Items in stock</th>
          <th scope="col">Release year</th>
          <th scope="col">Translator</th>
          <th scope="col">Genre</th>
          <th scope="col">Interact</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($books as $book)
      <tr>
          <th scope="row"> {{$book->id}} </th>
          <td>{{$book->name}}</td>
          <td>{{$book->description}}</td>
          <td>{{$book->price}}</td>
          <td>{{$book->path}}</td>
          <td>{{$book->items_in_stock}}</td>
          <td>{{$book->release_year}}</td>
          <td>{{$book->translator}}</td>
          <td>{{$book->genre->name}}</td>
  
          <td>
            <a href="{{ route('admin.books.edit', ['book'=>$book]) }}">Edit</a>
            <form action="{{ route('admin.books.destroy', ['book'=>$book]) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
  </tbody>
</table>