

<div>
<style>
        .small-table {
            font-size: 8px; /* Tamaño de fuente más pequeño */
            /* Puedes agregar otros estilos para hacer la tabla más compacta si lo deseas */
        }
        #imageButton {
            width: 60px; /* Cambia el ancho de la imagen */
            height: 30px; /* Cambia el alto de la imagen */
        }

    
    .table-custom tbody tr th td {
        font-weight: bold; /* Texto más negrita */
    }
    
    </style>
         
         <div wire:ignore.self   id="idModalPeso" tabindex="-1" role="dialog" class="modal hide fade in" data-bs-keyboard="false" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabelPeso" aria-hidden="true"  data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">            
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title"  >VENTA POR PESO</h5>
                    </div> 
                        <div class="modal-body">
                            <div class="row">

                            <div class="col-xs-12 col-md-6">
                                        <label for="peso" class="form-label">PESO EN GRAMOS:</label>
                                        <input class="form-control" type="text" id="inpeso" wire:keydown.enter="changePeso"   wire:model="peso"  style="text-transform:uppercase" name="peso" value=""/>
                                    </div> 

                                    <div class="col-xs-12 col-md-6">
                                    <label for="precio_kilo" class="form-label">PRECIO DEL KILO:</label>
                                    <input class="form-control" type="number" id="precio_kilo" disabled wire:model="precio_kilo"  style="text-transform: uppercase;" name="precio_kilo" value=""/>
                                    </div> 
                            </div>
                    </div>
                   
                </div>
            </div>
        </div>


        <div wire:ignore.self   id="idModalIngEfectivo" tabindex="-1" role="dialog" class="modal hide fade in" data-bs-keyboard="false" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabelPeso" aria-hidden="true"  data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">            
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title"  >INGRESO DE EFECTIVO</h5>
                    </div> 
                        <div class="modal-body">
                            <div class="row">

                            <div class="col-xs-12 col-md-6">
                                        <label for="peso" class="form-label">EFECTIVO:</label>
                                        <input class="form-control" type="text" id="inEfectivo" wire:keydown.enter="inputMoneyToCar"   wire:model="efectivo"  style="text-transform:uppercase" name="peso" value=""/>
                                    </div>  

                                    <div class="col-xs-12 col-md-6">
                                    <label for="precio_kilo" class="form-label">CONCEPTO:</label>
                                    <input class="form-control" type="text"  disabled   style="text-transform: uppercase;"   value="OTROS"/>
                                    </div>  
                          </div>
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
                <h5 class="card-title"><b>CARRITO DE COMPRAS</b> <span></span></h5>

                  <table class="table ">
                      <thead>
                          <tr>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;">CODE</th>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;">CONCEPTO</th>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;">CANTIDAD</th>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;">PRECIO</th>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;">SUBTOTAL</th>
                              <th scope="col" style="text-transform:uppercase; color: black; font-weight: bold;"></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($arrayDataCars as $arrayDataCar)
                          <tr style= 'background-color: #000000 '  >
                              <td style="text-transform:uppercase; color: white; font-weight: bold;" >{{$arrayDataCar["code"]}}</td>
                              <td style="text-transform:uppercase; color: white; font-weight: bold;">{{$arrayDataCar["nombre"]}}/{{$arrayDataCar["descripcion"]}}</td>
                              <td style="text-transform:uppercase; color: white; font-weight: bold;">{{$arrayDataCar["cantidad"]}}{{$arrayDataCar["idunidadtipo"] == 2 ? "GR": "" }} @if( $arrayDataCar["idunidadtipo"] !=2) <i wire:click="upItem({{$arrayDataCar["idcar"]}})" class="bx bx-chevron-up-circle me-1"></i> <i wire:click="downItem({{$arrayDataCar["idcar"]}})" class="bx bx-chevron-down-circle me-1"></i>@endif</td>
                              <td style="text-transform:uppercase; color: white; font-weight: bold;">${{number_format($arrayDataCar["precio"],2, ".", ",")}}</td>
                              <td style="text-transform:uppercase; color: white; font-weight: bold;">${{number_format($arrayDataCar["subtotal"],2, ".", ",")}}</td>
                              <td><i class="bx bx-trash-alt me-1" wire:click="delete({{$arrayDataCar["idcar"]}})"></i></td>
                          </tr>
                          @endforeach
                          <tr>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th style="text-transform:uppercase; color: black; font-weight: bold;">Total</th>
                              <th style="text-transform:uppercase; color: black; font-weight: bold;">${{$total}}</th> 
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
                  <h5 class="card-title">PENDIENTES <span> </span></h5>

                  <table class="table table-borderless">
   
                  <tbody>
                      <thead>  
                          <tr> 
                              <th scope="col">FOLIO</th>
                              <th scope="col">TOTAL</th>
                              <th scope="col">IMPORTE</th>
                              <th scope="col">CAMBIO</th>
                              <th scope="col">HORA</th>
                              <th scope="col"></th>
                             
                          </tr>
                      </thead> 
                      @foreach ($pospuestos as $pospuesto) 
                      <tr style="{{$pospuesto["estatus"] == 'POS' ? 'background-color: #F4FF81;' : 'background-color:#DCEDC8' }}"> 
                      <td  style="text-transform:uppercase">#{{str_pad($pospuesto["id"], 5, '0', STR_PAD_LEFT)}}</td>
                      <td  style="text-transform:uppercase">${{$pospuesto["totalventa"]}} </td>
                      <td  style="text-transform:uppercase">${{$pospuesto["importe"]}} </td>
                      <td  style="text-transform:uppercase">${{$pospuesto["cambio"]}} </td>
                      <td  style="text-transform:uppercase"> {{date('H:i:s', strtotime($pospuesto["created_at"]))}} </td> 
                      <td  style="text-transform:uppercase">  @if($pospuesto["estatus"] == "POS")<i title="Cargar Venta" wire:click="cargarventa({{$pospuesto["id"]}})" class="bx bx-arrow-from-bottom me-1"></i> @endif </td> 
                       </tr> 
                      @endforeach   
                  </tbody>
              </table>
                {{ $pospuestos->links() }}
                <h1></h1>

                </div>

              </div>
            </div><!-- End Top Selling -->


 
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
      <!-- Budget Report -->
          <div class="card">
             
          <div class="card-body pb-0" style="background-color: black;">
          <h5 class="card-title" style="color: #53F81A;">TOTAL: <span> ${{$total}}</span></h5>
          <h5 class="card-title" style="color: white;">CAMBIO: <span> ${{$cambio}}</span></h5>
            </div>

          </div> 
          <div class="my-3"></div> <!-- Este div añade el espacio -->
          <div class="card">
             

            <div class="card-body">
                <h5 class="card-title">  <span>BUSCAR PRODUCTO:</span></h5>

                  <div class="activity">

                <div class="activity-item d-flex">
                 
                  
                    <input 
                      id='buscardor'
                        type="text"
                        list="streetAddressOptions"
                        wire:model="producto" 
                        style="background-color:#F5F5F5  "
                        class="form-control" oninput="seleccionarProducto()"
                         /> 
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

                <div class="col-xs-12 col-md-12" style="margin-bottom: 20px;">
                <label for="importe" class="form-label">Importe:</label>
                <input class="form-control" type="number" id="importe" style="text-transform: uppercase;"   wire:keydown.enter="realizarVenta" wire:model="importe" name="importe" value=""/>
                </div>

               
                <div class="col-xs-12 col-md-12" style="margin-bottom: 20px;">
                <label for="imageButton">
                <input type="image" wire:click="changeImporte(20)" src="{{asset('img/20.jpg')}}" alt="Upload Image" id="imageButton">
                </label>
                <input   type="file" name="image" style="display: none;"> 

                <label for="imageButton">
                <input type="image"  wire:click="changeImporte(50)"  src="{{asset('img/50.jpg')}}" alt="Upload Image" id="imageButton">
                </label>
                <input type="file" name="image" style="display: none;"> 

                <label for="imageButton">
                <input type="image"  wire:click="changeImporte(100)" src="{{asset('img/100.jpg')}}" alt="Upload Image" id="imageButton">
                </label>
                <input  type="file" name="image" style="display: none;"> 
                <label for="imageButton">
                <input type="image"  wire:click="changeImporte(200)" src="{{asset('img/200.jpg')}}" alt="Upload Image" id="imageButton">
                </label>
                <input  type="file" name="image" style="display: none;"> 
                <label for="imageButton">
                <input type="image"  wire:click="changeImporte(500)" src="{{asset('img/500.png')}}" alt="Upload Image" id="imageButton">
                </label>
                <input  type="file" name="image" style="display: none;"> 
                </div> 

                <div class="col-xs-12 col-md-12" style="margin-bottom: 20px;">
                <button type="button" id='relventa' class="btn btn-success btn-lg"  wire:click="realizarVenta" ><i  title="Realizar Venta" class="bx bx-dollar "></i></button>
                <button type="button" id='canventa' class="btn btn-danger btn-lg"   wire:click="limpiarTodo"><i     title="Cancelar Venta" class="bx bx-x-circle "></i></button>
                <button type="button" id='posventa' class="btn btn-warning btn-lg"  wire:click="posponer"><i        title="Posponer Venta" class="bx bx-hourglass "></i></button>
                <button type="button" id="introdinero" class="btn btn-info btn-lg"  wire:click="inputMoney"><i      title="Introducir Efectivo" class="bx bx-money "></i></button>
                
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
          
          document.addEventListener('keydown', function(event) {
              // Verificar si la tecla presionada es F6
              if (event.keyCode === 117) {
                document.getElementById("buscardor").focus();
              }
              if (event.keyCode === 118) {
                document.getElementById("additem").focus();
              }
              if (event.keyCode === 119) {
                document.getElementById("importe").focus();
              }

              if (event.keyCode === 120) {
                var boton = document.getElementById("relventa");
                if (boton) {
                  boton.click();
                }
              }

              if (event.keyCode === 121) {
                var boton = document.getElementById("canventa");
                if (boton) {
                  boton.click();
                }
              }

              if (event.keyCode === 122) { 
                var boton = document.getElementById("posventa");
                if (boton) {
                  boton.click();
                } 
              }

              if (event.keyCode === 123) {
                var boton = document.getElementById("introdinero");
                if (boton) {
                  boton.click();
                }
              }
            });

            function seleccionarProducto() {
            var input               = document.querySelector('input[list="streetAddressOptions"]');
            var selectedOption      = document.querySelector('#streetAddressOptions option[value="' + input.value + '"]');
            var claveSeleccionada   = selectedOption.getAttribute('data-key');
            var ejemploComponente = @this; 
            ejemploComponente.set('additem', claveSeleccionada); 
            document.getElementById("additem").focus();
            }

            function mostrarVentanaEmergente() {
            var numero = prompt("Por favor, introduce un número:");
            } 
            

            Livewire.on('mostrarModal2', function () {
            $('#idModalIngEfectivo').modal('show');
            $('#idModalIngEfectivo').modal({backdrop: 'static', keyboard: false})  
            $('#idModalIngEfectivo').on('shown.bs.modal', function () {
                $('#inEfectivo').focus();
                });
            });



            Livewire.on('mostrarModal', function () {
            $('#idModalPeso').modal('show');
            $('#idModalPeso').modal({backdrop: 'static', keyboard: false})  
            $('#idModalPeso').on('shown.bs.modal', function () {
                $('#inpeso').focus();
                });
            });

            Livewire.on('ocultarModal', function () { 
              $('#idModalPeso').modal('hide');
              $('#additem').focus();
             
            });

            Livewire.on('ocultarModal2', function () { 
              $('#idModalIngEfectivo').modal('hide');
              $('#additem').focus();
            });

            Livewire.on('f5', function () { 
              window.location.reload();
            });

 
        </script>