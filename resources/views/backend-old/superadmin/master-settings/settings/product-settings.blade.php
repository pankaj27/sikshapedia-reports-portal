
<div class="d-flex justify-content-between align-items-center mb-4">
    
    <div class="d-flex align-items-center">
        
        <a href="{{route('create-product')}}" class="btn btn-primary menu menu-big">Add Product</a>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

  @php($allproducts = DB::table('products')->get())
  @foreach($allproducts as $prod)
    @php($product_cost = DB::table('product_cost')->where('product_id',$prod->id)->where('product_cost_type','ONE-TIME')->first() )
    <div class="col">
      @if(strtoupper($prod->product_name) == 'STANDARD')

      <div class="card mb-4 rounded-3 shadow-sm border-warning">
        <div class="card-header py-3 text-white bg-warning border-warning">

      @elseif(strtoupper($prod->product_name) == 'PREMIUM')
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
      @else
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
      @endif
      
          <h4 class="my-0 fw-normal">{{$prod->product_name}}</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">₹{{$product_cost->product_cost}}<small class="text-muted fw-light">/year</small></h1>
          <ul class="list-unstyled mt-3 mb-4">
            @php($prodff = explode(",",$prod->product_features))
            @foreach($prodff as $features)
              <li>{{$features}}</li>
            @endforeach
          </ul>
          @php($ftr = DB::table('product_cost')->where('product_id',$prod->id)->where('product_cost_type','INSTALLMENT')->get())
          @if(!empty($ftr))
          <hr>
          <ul class="list-unstyled mt-3 mb-4">
            @foreach($ftr as $ll)
              <li>(₹{{$ll->product_cost}} for {{$ll->product_installment_number}} Installment )</li>
            @endforeach
            </ul>

          @endif
          @php($id = encrypt($prod->id))
          @if(strtoupper($prod->product_name) == 'STANDARD')

          <a href="{{ route('product.edit',$id)}}"><button type="button" class="w-100 btn btn-lg btn-warning">EDIT</button></a>
          <br>
          <br>

          <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
            document.getElementById('users-delete-{{$id}}').submit(); }else{}" href="#" class="w-100 btn btn-lg btn-danger">Delete</a>
            <form id="users-delete-{{$id}}" action="{{ route('product.delete',$id)}}" method="POST">
              @csrf
              @method('DELETE')
            </form>

          @elseif(strtoupper($prod->product_name) == 'PREMIUM')
          <a href="{{ route('product.edit',$id)}}"><button type="button" class="w-100 btn btn-lg btn-primary">EDIT</button></a>
          <br>
          <br>

          <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
            document.getElementById('users-delete-{{$id}}').submit(); }else{}" href="#" class="w-100 btn btn-lg btn-danger">Delete</a>
            <form id="users-delete-{{$id}}" action="{{ route('product.delete',$id)}}" method="POST">
              @csrf
              @method('DELETE')
            </form>
          @else
          <a href="{{ route('product.edit',$id)}}"><button type="button" class="w-100 btn btn-lg btn-primary">EDIT</button></a>
          <br>
          <br>

          <a onclick="if(confirm('Are you sure you want to permenent delete?')){ event.preventDefault();
            document.getElementById('users-delete-{{$id}}').submit(); }else{}" href="#" class="w-100 btn btn-lg btn-danger">Delete</a>
            <form id="users-delete-{{$id}}" action="{{ route('product.delete',$id)}}" method="POST">
              @csrf
              @method('DELETE')
            </form>
          @endif
          
        </div>
      </div>
    </div>

    @endforeach
    
    
  </div>