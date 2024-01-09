@if ($item['submenu'] == [])
 <!-- Nodo Padre Sin Hijos-->
 
<li><i class="fas fa-angle-right rotate"></i>
                <button  type="button"  wire:click="asignarIdParent({{$item['id']}})" class="btn rounded-pill btn-success" data-bs-toggle="modal"  data-bs-target="#create_modal_item"    style="padding:2px;"><i
                    class="material-icons">add</i></button>


                    <button  type="button"  wire:click="asignarIdNivel({{$item['id']}})"   data-bs-toggle="modal"  data-bs-target="#deactivate_modal_item" class="btn rounded-pill btn-danger mr-1" style="padding:2px;"><i
                    class="material-icons">brightness_3</i></button>

                <span><i  wire:click="$emit('asignarIdParent',({{$item['id']}}) )"></i>{{ $item['nombre'] }}</span>
@else
<!-- Nodo Con Hijos-->
 
<form class="form-inline">
    <div class="form-group">
        <li><i class="fas fa-angle-right rotate"></i> 
                    <button  type="button"  wire:click="asignarIdParent({{$item['id']}})" class="btn rounded-pill btn-success" data-bs-toggle="modal"  data-bs-target="#create_modal_item"     style="padding:2px;"><i
                    class="material-icons">add</i></button>


                    <button  type="button"  wire:click="asignarIdNivel({{$item['id']}})"   data-bs-toggle="modal"  data-bs-target="#deactivate_modal_item" class="btn rounded-pill btn-danger mr-1" style="padding:2px;"><i
                    class="material-icons">brightness_3</i></button>

                    <span><i  data-bs-toggle="collapse"  ></i>{{ $item['nombre'] }}</span>
                    <ul >

                @foreach ($item['submenu'] as $submenu)

                @if ($submenu['submenu'] == [])     <!-- Ultimo nivel-->

                <li><i class="fas fa-angle-right rotate"></i>
              

                <button  type="button"  wire:click="asignarIdParent({{$submenu['id']}})" class="btn rounded-pill btn-success" data-bs-toggle="modal"  data-bs-target="#create_modal_item"     style="padding:2px;"><i
                    class="material-icons">add</i></button>


                    <button  type="button"  wire:click="asignarIdNivel({{$submenu['id']}})"   data-bs-toggle="modal"  data-bs-target="#deactivate_modal_item" class="btn rounded-pill btn-danger mr-1" style="padding:2px;"><i
                    class="material-icons">brightness_3</i></button>
                    <span><i></i>{{ $submenu['nombre'] }}</span>
                @else

                @include('menu-item', [ 'item' => $submenu ])

                @endif

                @endforeach

            </ul>
        </li>

    </div>
</form>
 
@endif