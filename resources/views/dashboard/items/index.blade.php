@extends('dashboard_layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Items</h6>
                    <!-- Button aligned to the right -->
                    <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Item</a>

                  @include('dashboard.items.create')
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{asset('/image')}}/{{ $item->image }}" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $item->description }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->price }}</p>
                                        <p class="text-xs text-secondary mb-0">{{ $item->currency }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                    @if($item->is_active==0)
                                          <span class="badge badge-sm bg-gradient-danger">Inactive</span>
                                    @elseif($item->is_active==1)

                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                    @else
                                    <span class="">N/A</span>
                                    @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $item->date }}</span>
                                    </td>
                                    <td class="align-middle">
                                        
                                           
                                            <i class="fa fa-edit text-blue" data-bs-toggle="modal" data-bs-target="#editItem{{$item->id}}" ></i>  | 
                                              <i class="fa fa-trash text-danger" data-bs-toggle="modal" data-bs-target="#deleteItem{{$item->id}}"></i>
                                            @include('dashboard.items.delete')
                                            @include('dashboard.items.edit')

                                            
                                      
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const isUnlimitedCheckbox = document.getElementById('is_unlimited');
    const quantityField = document.getElementById('quantity-field'); 

 
    if (isUnlimitedCheckbox.checked) {
      quantityField.style.display = 'none';
    }

   
    isUnlimitedCheckbox.addEventListener('change', function() {
      if (this.checked) {
        quantityField.style.display = 'none'; 
      } else {
        quantityField.style.display = 'block'; 
      }
    });
  });
</script>

