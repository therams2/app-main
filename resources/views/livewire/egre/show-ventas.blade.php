

<div>
<style>
        .small-table {
            font-size: 8px; /* Tamaño de fuente más pequeño */
            /* Puedes agregar otros estilos para hacer la tabla más compacta si lo deseas */
        }
    </style>
         <!-- Create New Register Modal-->
         <div wire:ignore.self   class="modal fade" id="idModalPeso" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelPeso" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">            
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabelPeso">VENTA POR PESO</h5>
                    </div> 
                        <div class="modal-body">
                            <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                    <label for="precio_kilo" class="form-label">PRECIO DEL KILO:</label>
                                    <input class="form-control" type="number" id="precio_kilo" disabled wire:model="precio_kilo" autofocus style="text-transform: uppercase;" name="precio_kilo" value=""/>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label for="peso" class="form-label">Peso en gramos:</label>
                                        <input class="form-control" type="number" id="peso" wire:model="peso" style="text-transform:uppercase" name="peso" value=""/>
                                    </div> 
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary me-2" wire:click="changePeso" data-bs-target="#modal_articulo" data-bs-toggle="modal">Calcular</button>
                        </div>
                </div>
            </div>
        </div>


  
  <main id="main" class="main">

     
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">  
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                 

                <div class="card-body">
                  <h5 class="card-title">Carrito de Compras <span></span></h5>

                   <table class="table table-borderless">
 
                    <tbody>
                        <thead>
                            <tr>
                        
                                <th scope="col">CODE</th>
                                <th scope="col">CONCEPTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">SUBTOTAL</th>
                                <th scope="col"></th> 
                            </tr>
                        </thead> 
                        @foreach ($arrayDataCars as $arrayDataCar) 
                        <tr> 
                        <td  style="text-transform:uppercase"> {{$arrayDataCar["code"]}} </td>
                        <td  style="text-transform:uppercase"> {{$arrayDataCar["nombre"]}}/{{$arrayDataCar["descripcion"]}} </td>
                        <td  style="text-transform:uppercase"> {{$arrayDataCar["cantidad"]}}{{$arrayDataCar["idunidadtipo"] == 2 ? "GR": "" }} @if( $arrayDataCar["idunidadtipo"] !=2) <i wire:click="upItem({{$arrayDataCar["idcar"]}})" class="bx bx-chevron-up-circle me-1"></i> <i wire:click="downItem({{$arrayDataCar["idcar"]}})" class="bx bx-chevron-down-circle me-1"  ></i>@endif </td>
                        <td  style="text-transform:uppercase"> ${{number_format($arrayDataCar["precio"],2, ".", ",")}} </td>
                        <td  style="text-transform:uppercase"> ${{number_format($arrayDataCar["subtotal"],2, ".", ",")}} </td> 
                        <td> <i class="bx bx-trash-alt me-1"   wire:click="delete({{$arrayDataCar["idcar"]}})" ></i> </td>
                        </tr> 
                        @endforeach  
                        <tr>
                        
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Total</th>
                            <th scope="col">${{$total}} </th> 
                            <th scope="col"></th>

                        </tr> 
                                 
                    </tbody>
                </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12 pt-4">
              <div class="card top-selling overflow-auto"> 
                <div class="card-body pb-0">
                  <h5 class="card-title">Ultimas Ventas <span> </span></h5>

                  <table class="table table-borderless">
   
                  <tbody>
                      <thead>  
                          <tr> 
                              <th scope="col">FOLIO</th>
                              <th scope="col">TOTAL</th>
                              <th scope="col">IMPORTE</th>
                              <th scope="col">CAMBIO</th>
                              <th scope="col">FECHA</th>
                              <th scope="col">ESTATUS</th> 
                          </tr>
                      </thead> 
                      @foreach ($ventas as $venta) 
                      <tr> 
                      <td  style="text-transform:uppercase"> {{$venta["id"]}} </td>
                      <td  style="text-transform:uppercase"> {{$venta["totalventa"]}} </td>
                      <td  style="text-transform:uppercase"> {{$venta["importe"]}} </td>
                      <td  style="text-transform:uppercase"> {{$venta["cambio"]}} </td>
                      <td  style="text-transform:uppercase"> {{$venta["created_at"]}} </td> 
                      <td  style="text-transform:uppercase"> {{$venta["estatus"] == "REAL" ? "REALIZADA":"PENDIENTE"}} </td> 
                      </tr> 
                      @endforeach   
                  </tbody>
              </table>
              {{ $ventas->links() }}

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
             

            <div class="card-body">
              <h5 class="card-title">  <span>Acciones</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                 
                    <label for="code" class="form-label">BUSCAR PRODUCTO:    </label>
                    <input 
                        type="text"
                        list="streetAddressOptions"
                        wire:model="producto" 
                        class="form-control" oninput="seleccionarProducto()" > 
                    <datalist id="streetAddressOptions" >
                        @foreach($searchResults as $result)
                            <option data-key="{{ $result->code }}"  value="{{ $result->nombre }} / {{ $result->descripcion }}" ></option>
                        @endforeach
                    </datalist> 
                 
                </div><!-- End activity item-->

                <div class="col-xs-12 col-md-12">
                <label for="code" class="form-label">CODIGO DE PRODUCTO:    </label>
                <i wire:click="addItemCar"  class="bx bx-plus-circle "></i>
                <input class="form-control"  wire:keydown.enter="addItemCar" type="text" id="additem" autofocus style="text-transform: uppercase;"   @keydown.tab="addItemCar" name="additem" value="" wire:model="additem"/>
               </div>  
                </div><!-- End activity item-->

                <div class="col-xs-12 col-md-12">
                <label for="importe" class="form-label">Importe:</label>
                <input class="form-control" type="number" id="importe" style="text-transform: uppercase;" wire:model="importe" name="importe" value=""/>
                </div>

                <div class="col-xs-12 col-md-12" style="margin-bottom: 20px;">
                <label for="cambio" class="form-label">Cambio:</label>
                <input class="form-control" type="number" id="cambio" style="text-transform: uppercase;" wire:model="cambio" name="cambio" disabled value=""/>
                </div>

                <div class="col-xs-12 col-md-12" style="margin-bottom: 20px;">
                 
                <button type="button" class="btn btn-success"  wire:click="realizarVenta" >VENDER</button>
               
                <button type="button" class="btn btn-danger"  wire:click="limpiarTodo">CANCELAR</button>
                </div> 
              </div>

            </div>
          </div><!-- End Recent Activity --> 
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main --> 

@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />
 

        <script>
          
            
             
           // Livewire.emit('changeCantidad1');

            function seleccionarProducto() {
            var input               = document.querySelector('input[list="streetAddressOptions"]');
            var selectedOption      = document.querySelector('#streetAddressOptions option[value="' + input.value + '"]');
            var claveSeleccionada   = selectedOption.getAttribute('data-key');
            var ejemploComponente = @this; 
            ejemploComponente.set('additem', claveSeleccionada); 

            }

            function mostrarVentanaEmergente() {
            var numero = prompt("Por favor, introduce un número:");
            } 

            Livewire.on('mostrarModal', function () {
            $('#idModalPeso').modal('show');
            });



        </script>