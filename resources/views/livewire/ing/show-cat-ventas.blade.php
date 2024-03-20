<div> 
    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">TICKETS</h5>
              <div>
                  <label for="fecha">Fecha:</label>
                  <input wire:model="fecha" type="text" id="fecha" class="form-control" />
              </div>
              <div class="table-responsive">
              <!-- Default Table -->
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">FOLIO</th>
                    <th scope="col">HORA</th>
                    <th scope="col">IMPORTE</th>
                    <th scope="col">CAMBIO</th>
                    <th scope="col">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ventas as $venta)
                  <tr wire:click="miMetodo({{$venta->id}})" style="{{$venta["estatus"] == 'POS' ? 'background-color: #F4FF81;' : '' }}">
                  <th scope="row"># {{str_pad($venta["id"], 5, '0', STR_PAD_LEFT)}} </th>
                  <td style="text-transform:uppercase"> {{date('H:i:s', strtotime($venta["created_at"]))}}</td> 

                    <td style="text-transform:uppercase">${{$venta->importe}}</td>
                    <td style="text-transform:uppercase">${{$venta->cambio}}</td>
                    <td style="text-transform:uppercase">${{$venta->totalventa}}</td>

                  </tr>
                  @endforeach
               
                </tbody>
              </table>
              {{ $ventas->links() }}
              </div>
              <p>TOTAL DEL DIA ${{$totalDia}}</p>

              <!-- End Default Table Example -->
            </div>
          </div> 
        </div>

        <div class="col-lg-6"> 
          <div class="card">
            <div class="card-body">
            <h5 class="card-title"># {{str_pad($idticket, 5, '0', STR_PAD_LEFT)}}</h5>
              <!-- Small tables -->
              <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">CODE</th>
                    <th scope="col">CONCEPTO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">SUBTOTAL</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($arrayData as $arrayDataP) 
                  <tr>
                    <th scope="row"> {{$arrayDataP->code}}</th> 
                    <td style="text-transform:uppercase">{{$arrayDataP->concepto}}</td>
                    <td style="text-transform:uppercase">{{$arrayDataP->cantidad}}</td>
                    <td style="text-transform:uppercase">${{$arrayDataP->precio}}</td>
                    @if($arrayDataP->idunidadtipo == 2)
                    <td style="text-transform:uppercase">${{$arrayDataP->precio}}</td> 
                    @else
                    <td style="text-transform:uppercase">${{$arrayDataP->precio * $arrayDataP->cantidad}}</td>  
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
