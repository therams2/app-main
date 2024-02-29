<div>
 

   <!-- Create New Register Modal-->
   <div wire:ignore.self class="modal fade" id="modal_articulo" tabindex="-1" role="dialog" wire:click="updateArrayItems"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content"> 
                
                    <div class="modal-header bg-primary">
                        @if ($isEdit) 
                        <h5 class="modal-title" id="exampleModalLabel">Editar Articulo</h5>
                        @elseif($isDisabled)
                        <h5 class="modal-title" id="exampleModalLabel">Detalle Articulo</h5>
                        @elseif (!$isEdit) 
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Articulo</h5> 
                        @endif
                    </div> 
                <div class="modal-body">
                    <div class="row">

                            <div class="col-xs-12 col-md-6">
                          
                                <label for="generarCodigo" class="form-label">¿Generar código?:</label>
                                <input type="checkbox" id="generarCodigo" name="generarCodigo"  wire:model="generacode"
                                    @if($isDisabled) disabled @endif />
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label for="code" class="form-label">Code:</label>
                                <input class="form-control" type="text" id="code"  style="text-transform:uppercase"  name="code" value=""  @if($isDisabled) disabled  @endif
                                    @if($generacode) disabled @endif autofocus wire:model="code" />
                                    
                                    @error('code') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>
                            

                            <div class="col-xs-12 col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input class="form-control" type="text" id="nombre"  style="text-transform:uppercase" name="nombre" value=""  @if($isDisabled) disabled  @endif
                                    autofocus wire:model="nombre" />
                                    @error('nombre') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                                  
                            </div>
                    
                            <div class="col-xs-12 col-md-6">
                                <label for="descripcion" class="form-label">Concepto/Marca:</label>
                                <input class="form-control" type="text" name="descripcion"  style="text-transform:uppercase" id="descripcion" value=""  @if($isDisabled) disabled  @endif
                                    wire:model="descripcion" />
                                    @error('descripcion') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label class="form-label">Unidad:</label>
                                <select class="select2 form-select" wire:model="idunidadtipo"  @if($isDisabled) disabled  @endif>
                                    <option value="1">PIEZA</option>
                                    <option value="2">PESO</option>
                                    <option value="3">CAJA</option>
                                    <option value="4">PAQUETE</option>
                                </select>
                          
                            </div> 

                            @if($isEneableItems)
                                
                            <div class="col-xs-12 col-md-6">
                                <label for="cantidad" class="form-label">Peso:</label>
                                <input class="form-control" type="number" id="cantidad" name="peso" value="0" placeholder=""  @if($isDisabled) disabled  @endif
                                    wire:model="peso" />
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label class="form-label">Unidad De Medida:</label>
                                <select class="select2 form-select" wire:model="id_unidad_medida"  @if($isDisabled) disabled  @endif>
                                    <option >SELECCIONA</option>
                                    <option value="1">KG</option>
                                    <option value="2">GR</option> 
                                </select>
                            </div> 
                            <div class="col-xs-12 col-md-6">
                                <label class="form-label" for="costoIni">Costo:</label>
                                <div class="input-group input-group-merge">
                                 
                                    <input type="number" id="costoIni" name="costo" value="0" class="form-control" @if($isDisabled) disabled  @endif
                                      wire:model="costoIni" />
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-md-6">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input class="form-control" type="number" id="cantidad" name="cantidad" value="0" placeholder=""  @if($isDisabled) disabled  @endif
                                    wire:model="cantidad" />
                                    @error('cantidad') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label class="form-label" for="precio">Precio:</label>
                                <div class="input-group input-group-merge">
                                 
                                    <input type="number" id="precio" name="precio" value="0" class="form-control" @if($isDisabled) disabled  @endif
                                      wire:model="precio" />
                                     
                                </div>
                                    @error('precio') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>
                          
                            
                            @endif



                            <div class="col-xs-12 col-md-6">
                            <label class="form-label" for="categoria">Categoria: *</label>
                            <div class="input-group">
                             
                                <select class="select2 form-select" wire:model="id_categoria" @if($isDisabled) disabled  @endif>
                                    @foreach ($getCategorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>                                                                  
                            </div>
                            </div> 

                           </div>
                        <div class="mt-2">
                        @if(!$isDisabled)
                        @if ($isEdit)
                        <button type="submit" class="btn btn-primary me-2" wire:click="edit" data-bs-dismiss="modal">Guardar Cambios</button> 
                        @else
                        <button type="submit" class="btn btn-primary me-2" wire:click="save"  >Guardar</button> 
                        @endif
                        @endif
                        <button type="button" class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">  Cerrar</button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

<!-- Suspend Modal -->
<div wire:ignore.self  class="modal fade" id="sleep_modal_person" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suspender</h5>
        
          </button>
      </div>
      <div class="modal-body">
        <p>¿Está Seguro de Suspender este Articulo?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="suspender" >Suspender</button>
      </div>
    </div>
  </div>
</div>


<!-- Delete Modal -->
<div wire:ignore.self  class="modal fade" id="delete_modal_articulo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        
          </button>
      </div>
      <div class="modal-body">
        <p>¿Está Eliminar este Articulo?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="delete" >Eliminar</button>
      </div>
    </div>
  </div>
</div>



    <div class="card mb-4">
        <div class="card-body d-flex">
            <x-jet-input placeholder="Buscar" type="text" wire:model="search" />
            &nbsp
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" wire:click="changeAction()"  data-bs-target="#modal_articulo"><i  class="bx bx-add-to-queue "></i></button> 
        </div> 
        <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
                <table class="table   table-striped">
    
                        <tbody>
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">Concepto/Marca</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Acciones</th> 
                                </tr>
                            </thead> 

                            @foreach ($articulos as $articulo) 
                            <tr> 
                                <td  style="text-transform:uppercase">{{$articulo->code}}</td>
                                <td  style="text-transform:uppercase">{{$articulo->nombre}}</td>
                                <td  style="text-transform:uppercase">{{$articulo->descripcion == null ? "-" : $articulo->descripcion}}</td>
                                <td    style="text-transform:uppercase">{{ $articulo->cantidad == 0 ? "-": $articulo->cantidad}} {{  $articulo->idunidadtipo ==  1 ? "PZA" :  ( $articulo->idunidadtipo ==  2 ? "":($articulo->idunidadtipo ==  3 ? "CAJA":"PAQ") ) }}</td>
                                <td  align ='right' style="text-transform:uppercase">${{number_format($articulo->precio,2, ".", ",")}}</td>  
                                <td  align ='right' style="text-transform:uppercase">${{number_format($articulo->costo_ini,2, ".", ",")}}</td>  
                                <td  align ='right' style="text-transform:uppercase">{{$articulo->peso}} {{$articulo->id_unidad_medida == 1 ? "KG" : ($articulo->id_unidad_medida == 2  ? "GR" : "-") }}</td>  
                               

                                <td> 

                                    <i wire:click="view({{$articulo->id}})"    data-bs-toggle="modal" data-bs-target="#modal_articulo"  title="Visualizar" 
                                            class="bx bx-show me-1"></i> 

                                    <i  wire:click="showEdit({{$articulo->id}})"   data-bs-toggle="modal" data-bs-target="#modal_articulo"  title="Editar" 
                                            class="bx bx-edit-alt me-1"></i> 
                                <i wire:click="assignId({{$articulo->id}})"  data-bs-toggle="modal" data-bs-target="#delete_modal_articulo" title="Eliminar" 
                                    class="bx bx-trash-alt me-1"></i> 
                                </td>
                            </tr>
                            @endforeach           
                        </tbody>
                    </table>
            </div>

        </div>
        {{ $articulos->links() }}

</div>