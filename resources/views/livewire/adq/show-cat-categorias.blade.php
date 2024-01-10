<div>
    <!-- Create New Register Modal-->
    <div wire:ignore.self class="modal fade" id="modal_categoria" tabindex="-1" role="dialog"
                aria-labelledby="createModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header  bg-secondary">
                            <h5 class="modal-title" id="createModalGender">Crear Nueva Categoria</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row mt-4">
                                <label class="col-sm-2 col-form-label">Nombre:</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" maxlength="600" style="text-transform:uppercase" wire:model.defer="nombre">
                                    @error('nombre') <span class="text-danger"
                                        style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4"> 
                            </div>
                            <div class="form-group row mt-4"> 
                                <label class="col-sm-2 col-form-label">Descripción *:</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" maxlength="600"  style="text-transform:uppercase" wire:model.defer="descripcion" >
                                    
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
            <x-jet-input placeholder="Buscar" type="text"   />
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal_categoria" >Nueva Categoria</button> 
        </div> 
       <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
            <table class="table table-striped  ">
 
                    <tbody>
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th> 
                            </tr>
                        </thead>
                        @foreach ($categorias as $categoria) 
                        <tr>
                        <td  style="text-transform:uppercase">{{$categoria->nombre}}</td>
                        <td  style="text-transform:uppercase">{{$categoria->descripcion}}</td>
                        <td> 

                            <a data-bs-toggle="modal" data-bs-target="#modal_articulo" class="dropdown-item"><i
                                    class="bx bx-show me-1"></i>Mostrar</a>

                            <a data-bs-toggle="modal" data-bs-target="#modal_articulo" class="dropdown-item"><i
                                    class="bx bx-edit-alt me-1"></i>Editar</a> 

                            <a  data-bs-toggle="modal" data-bs-target="#delete_modal_articulo" class="dropdown-item"><i
                            class="bx bx-trash-alt me-1"></i>Eliminar</a>
                        
                        </td>
                        </tr> 
                        @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
</div>
