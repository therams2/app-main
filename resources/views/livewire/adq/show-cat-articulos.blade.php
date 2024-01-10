<div>
 

   <!-- Create New Register Modal-->
   <div wire:ignore.self class="modal fade" id="modal_articulo" tabindex="-1" role="dialog" wire:click="updateArrayItems"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                        <div class="mb-3 col-md-6">
                                <label for="code" class="form-label">Code</label>
                                <input class="form-control" type="text" id="code"  style="text-transform:uppercase"  name="code" value=""  @if($isDisabled) disabled  @endif
                                    autofocus wire:model="code" />
                                    @error('code') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>
                                   

                            <div class="mb-3 col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input class="form-control" type="text" id="nombre"  style="text-transform:uppercase" name="nombre" value=""  @if($isDisabled) disabled  @endif
                                    autofocus wire:model="nombre" />
                                    @error('nombre') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                                  
                            </div>
                    
                            <div class="mb-3 col-md-6">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input class="form-control" type="text" name="descripcion"  style="text-transform:uppercase" id="descripcion" value=""  @if($isDisabled) disabled  @endif
                                    wire:model="descripcion" />
                                    @error('descripcion') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input class="form-control" type="number" id="cantidad" name="cantidad" value="" placeholder=""  @if($isDisabled) disabled  @endif
                                    wire:model="cantidad" />
                                    @error('cantidad') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="costoIni">Costo Inicial</label>
                                <div class="input-group input-group-merge">
                                    <input type="number" id="costoIni" name="costoIni" class="form-control" @if($isDisabled) disabled  @endif
                                      wire:model="costoIni" />
                                    
                                </div>
                                @error('costoIni') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="precio">Precio</label>
                                <div class="input-group input-group-merge">
                                 
                                    <input type="number" id="precio" name="precio" class="form-control" @if($isDisabled) disabled  @endif
                                      wire:model="precio" />
                                     
                                </div>
                                    @error('precio') 
                                    <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                            <label class="form-label" for="categoria">Categoria</label>
                            <div class="input-group">
                             
                                <select class="select2 form-select" wire:model="id_categoria" @if($isDisabled) disabled  @endif>
                                    <option value="-1">SELECCIONA</option>
                                    @foreach ($getCategorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach
                                </select>
                                                                                                  
                            </div>
                            </div> 

                            
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Unidad de Medida</label>
                                <select class="select2 form-select" wire:model="id_unidad_medida"  @if($isDisabled) disabled  @endif>
                                    <option value="-1">SELECCIONA</option>
                                    <option value="1">LITROS</option>
                                    <option value="2">GRAMOS</option>
                                    <option value="3">CM</option>
                                    <option value="4">M</option>
                                    <option value="5">ML</option>
                                </select>
                          
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
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" wire:click="changeAction()"  data-bs-target="#modal_articulo">Nuevo Articulo</button> 
        </div> 
       <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
            <table class="table table-striped  ">
 
                    <tbody>
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Articulo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Costo Inicial</th>
                                <th scope="col">Precio</th>
                                
                                <th scope="col">Acciones</th> 
                            </tr>
                        </thead> 

                        @foreach ($articulos as $articulo) 
                        <tr> 
                            <td  style="text-transform:uppercase">{{$articulo->code}}</td>
                            <td  style="text-transform:uppercase">{{$articulo->nombre}}</td>
                            <td  style="text-transform:uppercase">{{$articulo->descripcion}}</td>
                            <td  style="text-transform:uppercase">{{$articulo->cantidad}}</td>
                            <td  style="text-transform:uppercase">{{$articulo->costo_ini}}</td>
                            <td  style="text-transform:uppercase">{{$articulo->precio}}</td>  
                           
                            <td> 

                                <a wire:click="view({{$articulo->id}})"         data-bs-toggle="modal" data-bs-target="#modal_articulo" class="dropdown-item"><i
                                        class="bx bx-show me-1"></i>Mostrar</a>

                                <a wire:click="showEdit({{$articulo->id}})"     data-bs-toggle="modal" data-bs-target="#modal_articulo" class="dropdown-item"><i
                                        class="bx bx-edit-alt me-1"></i>Editar</a> 

                                <a wire:click="assignId({{$articulo->id}})"     data-bs-toggle="modal" data-bs-target="#delete_modal_articulo" class="dropdown-item"><i
                                class="bx bx-trash-alt me-1"></i>Eliminar</a>
                            </td>
                        </tr>
                        @endforeach           
                    </tbody>
                </table>
            </div>
        </div>
</div>