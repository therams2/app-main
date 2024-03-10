<div>
         <!-- Create New Register Modal-->
        <div wire:ignore.self class="modal fade" id="id_modal_create" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">            
                    <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Ingreso de Inventario</h5>
                    </div> 
                        <div class="modal-body">
                            <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                    <label for="code" class="form-label">Code:</label>
                                    <input class="form-control" type="text" id="code" style="text-transform: uppercase;" name="code" value=""/>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label for="nombre" class="form-label" style="margin-top: 25px;">Nombre:</label>
                                        <input class="form-control" type="text" id="nombre"  style="text-transform:uppercase" name="nombre" value=""/>
                                    </div>
                            
                                    <div class="col-xs-12 col-md-6">
                                        <label for="descripcion" class="form-label" style="margin-top: 25px;">Concepto/Marca:</label>
                                        <input class="form-control" type="text" name="descripcion"  style="text-transform:uppercase" id="descripcion" value="" />
                                    </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary me-2" wire:click="save" data-bs-target="#modal_articulo"  data-bs-toggle="modal">Guardar</button>
                                <button type="button" class="btn btn-outline-secondary me-2 "data-bs-target="#modal_articulo"  data-bs-toggle="modal" >Cerrar</button>
                        </div>
                </div>
            </div>
        </div>


        <div class="card mb-4">
        
       <hr class="my-0" />
        <div class="card-body">

        <div class="row">
            <div class="col">
            <div class="col-xs-12 col-md-12">
                <label for="code" class="form-label">CODIGO DE PRODUCTO:    </label>
                <i wire:click="addItemCar"  class="bx bx-plus-circle "></i>
                <input class="form-control"  wire:keydown.enter="addItemCar" type="text" id="additem" autofocus style="text-transform: uppercase;" name="additem" value="" wire:model="additem"/>
                
               </div> 

                <div class="col-xs-12 col-md-12">
                <label for="code" class="form-label">Importe:</label>
                <input class="form-control" type="text" id="code" style="text-transform: uppercase;" name="code" value=""/>
                </div>

                <div class="col-xs-12 col-md-12">
                <label for="code" class="form-label">Cambio:</label>
                <input class="form-control" type="text" id="code" style="text-transform: uppercase;" name="code" value=""/>
                </div>
                
                

                <div class="col-xs-12 col-md-12">
                 
                <button type="button" class="btn btn-success">Realizar Venta</button>
                <button type="button" class="btn btn-danger">Cancelar</button>
                </div>

               

            </div>

            <div class="col">
               
                 <!--Table-->
                 <div class="table-responsive">
            <table class="table table-bordered">
 
                    <tbody>
                        <thead>
                            <tr>
                        
                                <th scope="col">CODE</th>
                                <th scope="col">CONCEPTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PRECIO UNI</th>
                                <th scope="col"></th> 
                            </tr>
                        </thead> 
                        @foreach ($arrayDataCars as $arrayDataCar) 
                        <tr> 
                        <td  style="text-transform:uppercase"> {{$arrayDataCar->code}} </td>
                        <td  style="text-transform:uppercase"> {{$arrayDataCar->descripcion}} </td>
                        <td  style="text-transform:uppercase"> 1 </td>
                        <td  style="text-transform:uppercase"> {{$arrayDataCar->precio}} </td>
                        <td> <i class="bx bx-trash-alt me-1" ></i> </td>
                        </tr> 
                        @endforeach  
                        <tr>
                        
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Total</th>
                            <th scope="col"></th> 
                        </tr> 
                                 
                    </tbody>
                </table>


            </div>
        </div>


       
            </div>
        </div>
</div>
