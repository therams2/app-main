<div>
            <div wire:ignore.self class="modal" tabindex="-1"id="modal_confirm"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Confirmación</h5>
                    
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea aprobar el lote de inventario nuevo?.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="aprobado">Aprobar</button>
                    <button type="button" class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">  Cerrar</button>  
                </div>
                </div>
            </div>
            </div> 


            <div wire:ignore.self class="modal" tabindex="-1"id="modal_delete"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Confirmación</h5>
                    
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea cancelar el lote de inventario nuevo?.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="cancelar">Aceptar</button>
                    <button type="button" class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">  Cerrar</button>  
                </div>
                </div>
            </div>
            </div> 


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
                                    <input class="form-control" type="text" id="code"   style="text-transform: uppercase;" name="code" value="" wire:model="code"  />
                                    </div>
                            
                                    <div class="col-xs-12 col-md-6">
                                        <label for="descripcion" class="form-label" style="margin-top: 25px;">Concepto:</label>
                                        <input class="form-control" type="text" name="descripcion"  style="text-transform:uppercase" id="descripcion" value="" wire:model="concepto"  disabled  />
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label for="cantidad" class="form-label" style="margin-top: 25px;">Cantidad:</label>
                                        <input class="form-control" type="number" id="cantidad" name="cantidad" value="0" placeholder="" wire:model="cantidadnuevo" @if($disableItems) disabled  @endif/> 
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="precio" style="margin-top: 25px;">Precio Actual:</label>
                                        <div class="input-group input-group-merge">
                                        <input type="number" id="precio" name="precio" value="0" class="form-control" wire:model="precionuevo" @if($disableItems) disabled  @endif/>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="costonuevo" style="margin-top: 25px;" >Costo:</label>
                                        <div class="input-group input-group-merge"> 
                                            <input type="number" id="costonuevo" name="costonuevo" value="0" class="form-control" wire:model="costonuevo"/>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                    <label for="pesonuevo" class="form-label" style="margin-top: 25px;">Peso {{$labelUnidadMedida}}:</label>
                                    <input class="form-control" type="number" id="pesonuevo" name="pesonuevo" value="0" placeholder=""  wire:model="pesonuevo" @if(!$disableItems) disabled  @endif/>
                                    </div>

                                   
                             
                                    <div class="col-xs-12 col-md-6">
                                        <label class="form-label" for="preciokilonuevo" style="margin-top: 25px;">Precio Kilo Actual:</label>
                                        <div class="input-group input-group-merge"> 
                                            <input type="number" id="preciokilonuevo" name="preciokilonuevo" value="0" class="form-control" wire:model="preciokilonuevo" @if(!$disableItems) disabled  @endif/>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#id_modal_create" wire:click="onclickModal()"><i  class="bx bx-add-to-queue "></i></button> 
        </div> 
       <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
            <table class="table">
                    <tbody>
                        <thead>
                            <tr>
                                <th scope="col">LOTE</th>
                                <th scope="col">CODE</th>
                                <th scope="col">CONCEPTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PESO</th>
                                <th scope="col">COSTO</th>
                                <th scope="col">PRECIO NUEVO</th>
                                <th scope="col">PRECIO NUEVO POR KILO</th> 
                                <th scope="col">ESTATUS</th>
                                <th scope="col">ACCIONES</th>
                            </tr>
                        </thead> 
                        @foreach ($ingresosInv as $ingresoInv) 
                        <tr style="{{ $ingresoInv->estatus == 'PTE' ? 'background-color: #F4FF81;' : ($ingresoInv->estatus == 'APB' ? 'background-color: #B9F6CA':'background-color: #EEEEEE') }}"> 
                            <td  style="text-transform:uppercase"> {{$ingresoInv->id}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->code}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->nombre.' '.$ingresoInv->descripcion}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->cantidadnuevo}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->pesonuevo}}{{($ingresoInv->id_unidad_medida == 1 ? " KG":($ingresoInv->id_unidad_medida == 2 ? " GR":""))}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->costonuevo}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->precionuevo}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->preciokilonuevo}}</td>
                            <td  style="text-transform:uppercase"> {{$ingresoInv->estatus == 'PTE' ? 'PENDIENTE': ($ingresoInv->estatus == 'APB' ? "APROBADO":"CANCELADO")}}</td>
                            <td> @if($ingresoInv->estatus == 'PTE') <i title="Aprobar" wire:click="loadSelectedItem({{$ingresoInv}})" class="bx bx-check me-1" data-bs-toggle="modal" data-bs-target="#modal_confirm"></i>  
                            
                            <i title="Cancelar" wire:click="itemSelected({{$ingresoInv->id}})" class="bx bx-block me-1" data-bs-toggle="modal" data-bs-target="#modal_delete"></i>
                            @endif </td>
                            </tr> 
                        @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
</div>
@livewireScripts

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />