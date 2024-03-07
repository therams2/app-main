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
                                    <label for="code" class="form-label" style="margin-top: 25px;">Code:</label>
                                    <input class="form-control" type="text" id="code" style="text-transform: uppercase;" name="code" value="" wire:model="code"/>
                                    </div>
                            
                                    <div class="col-xs-12 col-md-6">
                                        <label for="descripcion" class="form-label" style="margin-top: 25px;">Concepto:</label>
                                        <input class="form-control" type="text" name="descripcion"  style="text-transform:uppercase" id="descripcion" value="" wire:model="concepto"/>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label for="cantidad" class="form-label" style="margin-top: 25px;">Cantidad:</label>
                                        <input class="form-control" type="number" id="cantidad" name="cantidad" value="0" placeholder="" wire:model="cantidad" /> 
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="precio" style="margin-top: 25px;">Precio:</label>
                                        <div class="input-group input-group-merge">
                                        <input type="number" id="precio" name="precio" value="0" class="form-control" wire:model="precio"/>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                    <label for="cantidad" class="form-label" style="margin-top: 25px;">Peso:</label>
                                    <input class="form-control" type="number" id="cantidad" name="peso" value="0" placeholder=""  wire:model="peso" />
                                    </div>

                             
                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="preciokilo" style="margin-top: 25px;">Precio Kilo:</label>
                                        <div class="input-group input-group-merge"> 
                                            <input type="number" id="preciokilo" name="preciokilo" value="0" class="form-control" wire:model="precio_kilo"/>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="costoIni" style="margin-top: 25px;" >Costo:</label>
                                        <div class="input-group input-group-merge"> 
                                            <input type="number" id="costoIni" name="costo" value="0" class="form-control" wire:model="costoIni"/>
                                        </div>
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
        <div class="card-body d-flex">
            <x-jet-input placeholder="Buscar" type="text"/>
            &nbsp
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id_modal_create" ><i  class="bx bx-add-to-queue "></i></button> 
        </div> 
       <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
            <table class="table table-striped  ">
 
                    <tbody>
                        <thead>
                            <tr>
                                <th scope="col">LOTE</th>
                                <th scope="col">CODE</th>
                                <th scope="col">CONCEPTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">COSTO</th>
                                <th scope="col">PESO</th>
                                <th scope="col">COSTO POR KILO</th> 
                                <th scope="col">ESTATUS</th> 
                                <th scope="col">ACCIONES</th> 
                            </tr>
                        </thead> 
                        <tr>
                        <td  style="text-transform:uppercase"> 1 </td>
                        <td  style="text-transform:uppercase"> 7502009740435 </td>
                        <td  style="text-transform:uppercase"> TABLETA LARITOL/ LARITOL / PIEZA /</td>
                        <td  style="text-transform:uppercase"> 10 </td>
                        <td  style="text-transform:uppercase"> $8 </td>
                        <td  style="text-transform:uppercase"> $7.50</td>
                        <td  style="text-transform:uppercase"> PRUEBA DE INGRESO DE NUEVO INVENTARIO</td>
                        <td  style="text-transform:uppercase"> -</td>
                        <td  style="text-transform:uppercase"> APROBADA (EL ESTATUS DEFINE SI SE APLICO YA EL NUEVO INGRESO DE NUEVOS ARTICULOS O SI ESTA POR PENDIENTE A APLICARLO, O SI SE CANCELO)</td>
                        <td  
                   
                        <i class="bx bx-show me-1"></i> 

                        <i class="bx bx-edit-alt me-1"></i> 

                        <i class="bx bx-trash-alt me-1" ></i> 
                        
                        </td>
                        </tr> 
                        <tr>
                        <td  style="text-transform:uppercase"> 1 </td>
                        <td  style="text-transform:uppercase"> 0110025 </td>
                        <td  style="text-transform:uppercase"> JAMON DE PAVO/ FUD </td>
                        <td  style="text-transform:uppercase"> - </td>
                        <td  style="text-transform:uppercase"> - </td>
                        <td  style="text-transform:uppercase"> $60</td>
                        <td  style="text-transform:uppercase"> 3KG</td>
                        <td  style="text-transform:uppercase"> $15</td>
                        <td  style="text-transform:uppercase"> PENDIENTE </td>
                        <td   
                        <i class="bx bx-show me-1"></i> 
                        <i class="bx bx-edit-alt me-1"></i> 
                        <i class="bx bx-trash-alt me-1" ></i> 
                        </td>
                        </tr>                    
                    </tbody>
                </table>
            </div>
        </div>
</div>
