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
                                <label class="col-sm-2 col-form-label">Descripcion:</label> 
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

</div>
