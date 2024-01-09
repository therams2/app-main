<div>

    <div class="card mb-4">
        <h5 class="card-header">Organigramas de las Dependencias</h5>
        <!-- Account -->
        <div class="card-body">
            <!-- Encabezado-->
            <div class="col-md-12">
                <div class="col-md-12 col-md-offset-2">


                    <button type="button" class="btn btn btn-outline-success ml-auto" data-bs-toggle="modal"
                        data-bs-target="#create_modal_item" wire:click="asignarIdParentFromNew(0)">
                        Nueva Dependencia
                    </button>


                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">Dependencia:</label>
                        <div class="col-sm-10">
                            <select class="form-control" wire:model="iddependencia">
                                <option value="">SELECCIONA</option>

                                @php

                                $dependencias = \DB::table('cat_organigramas')->select( 'id' , 'nombre')
                                ->where('idparent',0)
                                ->where('estatus',1)
                                ->get();
                                @endphp
                                @foreach($dependencias as $dependencia)
                                <option value="{{ $dependencia->id }}">{{$dependencia->nombre}}</option>
                                @endforeach
                            </select>
                            @error('iddependencia') <span class="text-danger" style="font-size: 12px;">{{
                                      $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>



            </div>


            <!-- Deactivate Register Modal-->
            <div wire:ignore.self class="modal fade" id="deactivate_modal_item" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger font-weight-bold">
                            <h5 class="modal-title" style="color:#ffffff;">Suspender Área</h5>
                        </div>
                        <img class="card-img-top" src="{{asset('img/advertencia_rojo.png')}}" width="50" height="300">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-outline-danger" wire:click="deactivate"
                                data-dismiss="modal">Suspender</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create New Register Modal-->
            <div wire:ignore.self class="modal fade" id="create_modal_item" tabindex="-1" role="dialog"
                aria-labelledby="createModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="createModalGender">Crear Nueva Dependencia</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row mt-4">
                                <label class="col-sm-2 col-form-label">Nombre:</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" maxlength="600" wire:model.defer="nombre">
                                    @error('nombre') <span class="text-danger"
                                        style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-4">



                            </div>
                            <div class="form-group row mt-4">


                                <label class="col-sm-2 col-form-label">ID Padre:</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" maxlength="600" wire:model.defer="idparent"
                                        disabled>
                                    @error('idparent') <span class="text-danger"
                                        style="font-size: 12px;">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn btn-success close-modal" wire:click="save"
                                wire:loading.attr="disabled">Guardar</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                            
                        </div>
                    </div>
                </div>
            </div>


            <ul class="treeview">
                @foreach ($niveles as $key => $item)
                @if ($item['idparent'] != 0)
                @break
                @endif
                <!-- Llamamos de forma recursiva el codigo de las viñetas-->
                @include('menu-item', ['item' => $item])
                @endforeach
            </ul>

        </div>
    </div>
</div>