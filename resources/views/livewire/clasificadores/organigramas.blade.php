<div>
    <!-- Encabezado-->
 
    <div class="col-md-12 col-md-offset-2">
        <div class="card-body d-flex">
          
            <button type="button" class="btn btn-success ml-auto" data-bs-toggle="modal" 
                data-bs-target="#create_modal_gender"  wire:click="$emit('asignarIdParent',({{0}}) )" >
                Nueva Dependencia
            </button>
        </div>
    </div>

 
    <!-- Deactivate Register Modal-->
    <div wire:ignore.self class="modal fade" id="deactivate_modal_gender" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger font-weight-bold">
                    <h5 class="modal-title" style="color:#ffffff;">Suspender Nivel</h5>
                </div>
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" wire:click="deactivate" data-dismiss="modal">Desactivar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create New Register Modal-->
    <div wire:ignore.self class="modal fade" id="create_modal_gender" tabindex="-1" role="dialog"
        aria-labelledby="createModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalGender">Crear Nuevo Nivel</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">Nombre del Primer Nivel:</label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control" maxlength="600" wire:model.defer="nombre">
                            @error('nombre') <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                     

                      
                    </div> <div class="form-group row mt-4">
                         

                         <label class="col-sm-2 col-form-label">ID Padre:</label>
                         
                         <div class="col-sm-6">
                             <input type="text" class="form-control" maxlength="600" wire:model.defer="idparent">
                             @error('idparent') <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                             @enderror
                         </div>
 
                       
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success close-modal" wire:click="save"
                        wire:loading.attr="disabled">Guardar Nivel</button>
                </div>
            </div>
        </div>
    </div>
 
    <table class="table">
    <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nivel</th>
                <th scope="col">Orden</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estatus</th>
                <th scope="col">Padre</th>
                <th scope="col">Acciones</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($niveles as $nivel)
            <tr style="font-weight:bold;">
                <td>{{$nivel->id}} </td>
                <td>{{$nivel->nivel}} </td>
                <td>{{$nivel->orden}} </td>
                <td>{{$nivel->nombre}} </td>
                <td>{{$nivel->estatus}} </td>
                <td>{{$nivel->idparent}} </td>
                <td class="td-actions text-right">

                    <button data-bs-toggle="modal" 
                    data-bs-target="#create_modal_gender"
                    wire:click="$emit('asignarIdParent',({{$nivel->id}}) )" class="btn btn-success mr-1">
                        Nuevo 
                    </button>


                    <button data-bs-toggle="modal" 
                    data-bs-target="#deactivate_modal_gender"
                    wire:click="$emit('asignarIdNivel',({{$nivel->id}}) )" class="btn btn-danger mr-1">
                       Desactivar 
                    </button>


                </td>
            </tr>
              @endforeach
          </tbody>
        </table>
 
</div>
</div>