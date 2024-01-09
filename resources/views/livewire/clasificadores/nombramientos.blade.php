<div>

<div wire:ignore.self id="succes_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header bg-success">
      <div class="modal-header">
        <h5 class="modal-title">Aviso</h5>
      </div>
 
      </div>
      <div class="modal-body">
        <p>El Registro Se Añadio Correctamente</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Continuar</button> 

      </div>
    </div>
  </div>
</div>

    <!-- Create New Register Modal-->
    <div wire:ignore.self class="modal fade" id="create_modal_person" tabindex="-1" role="dialog"
        aria-labelledby="createModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="createModalGender">Añadir Nuevo Funcionario</h5>
                </div>
                <div class="modal-body">
                    <div class="card mb-4">
                        <h5 class="card-header">Datos del Funcionario</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="http://sfa.michoacan.gob.mx/coeac/consejo_imagen/luis%20navarro.jpg"
                                    alt="user-avatar" class="d-block rounded" height="100" width="100"
                                    id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Cargar nueva foto</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reiniciar</span>
                                    </button>

                                    <p class="text-muted mb-0">Permitir JPG, GIF or PNG. Max de tamaño de 800K</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nombre(s)</label>
                                        <input class="form-control" type="text" id="firstName" name="firstName" value=""
                                            autofocus />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="lastName" class="form-label">Apellidos</label>
                                        <input class="form-control" type="text" name="lastName" id="lastName"
                                            value="" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email" value=""
                                            placeholder="" />
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Teléfono</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">MX (+52)</span>
                                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                                placeholder="202 555 0111" />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="" />
                                    </div>


                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="card mb-4">
        <h5 class="card-header">Nuevo Movimiento

        </h5>
        <!-- Account -->

        <hr class="my-0" />
        <div class="card-body">
            <form id="formAccountSettings" method="POST" onsubmit="return false">
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Asignar Dependencia</label>
                        <select wire:model="iddependencia" class="select2 form-select">
                            <option value="">SELECCIONA</option>
                            @php
                            $dependencias = \DB::table('cat_organigramas')
                            ->select('id', 'nombre')
                            ->where('idparent', 0)
                            ->where('estatus', 1)
                            ->get();
                            @endphp
                            @foreach ($dependencias as $dependencia)
                            <option value="{{ $dependencia->id }}">{{ $dependencia->nombre }}</option>
                            @endforeach
                        </select>
                        @error('iddependencia')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Asignar Área</label>
                        <div class="search-box">
                            <input type='text' class="form-control" wire:model="search" wire:keyup="searchResult"
                                {{  $iddependencia > 0 ? '' : 'disabled' }}>
                            <ul>
                                @if(!empty($records))
                                @foreach($records as $record)
                                <li wire:click="asignarIdArea({{ $record->id }} , '{{ $record->nombre }}')">
                                    {{ $record->nombre}}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                        @error('idorganigrama')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Funcionario Saliente</label>
                        <input wire:model="nombrefuncionarioSaliente" type="text" class="form-control" placeholder = "ÁREA ACTUALMENTE SIN TITULAR"  disabled />
                    
                        @error('idfuncionarios')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>




                    <div class="mb-3 col-md-6">
                        <label class="form-label">Fecha de salida</label>
                        <input type="datetime-local" class="form-control" wire:model="fecha_baja">

                        @error('fecha_baja')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

 
                  

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Estatus del Funcionario Saliente</label>
                        <select class="select2 form-select" wire:model="estatusfs">
                            <option value="">SELECCIONA</option>
                            <option value="1">ROTACIÓN</option>
                            <option value="2">BAJA</option>
                        </select>
                        @error('estatusfs')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="mb-3 col-md-6">
                        <label class="form-label">Funcionario Entrante</label>
                        <div class="input-group">
                            <div class="col-10 search-box">
                                <input placeholder = {{$nombrefuncionarioE}} type='text' class="form-control" wire:model="searchFE"
                                    wire:keyup="searchResultFuncionario" />
                                <ul>
                                    @if(!empty($funcionariosE))
                                    @foreach($funcionariosE as $record)
                                    <li wire:click="asignarIdFuncionarioE({{ $record->id }} , '{{ $record->nombre.' '.$record->apellidos }}')">
                                        {{ $record->nombre." ".$record->apellidos}}</li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>

                            <button type="button" class="btn btn-outline-primary"><i class="material-icons"
                                    data-bs-toggle="modal" data-bs-target="#create_modal_person">person_add</i></button>
                        </div>
                        @error('idfuncionarioe')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Fecha de entrada</label>
                        <input wire:model="fecha_alta" type="datetime-local" class="form-control"  name="fecha_alta">
                        @error('fecha_alta')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Estatus del Funcionario Entrante</label>
                        <select class="select2 form-select" wire:model="estatusfe">
                            <option value="">SELECCIONA</option>
                            <option value="3">EN ESPERA</option>
                            <option value="4">EN FUNCION</option>
                            <option value="5">CANCELADO</option>
                        </select>
                        @error('estatusfe')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Categoria</label>
                        <input wire:model="categoria" type="text" class="form-control" id="idcategoria" name="categoria"
                            placeholder=""   />
                            @error('categoria')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Sueldo Neto</label>
                        <input wire:model="sueldoneto" type="text" class="form-control" />
                        @error('sueldoneto')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="country">Nivel Academico</label>
                        <select class="select2 form-select" wire:model="nivelacademico">
                            <option value="">SELECCIONA</option>
                            <option value="S/E">SIN ESTUDIOS</option>
                            <option value="Primaria">PRIMARIA</option>
                            <option value="Secundaria">SECUNDARIA</option>
                            <option value="Preparatoria">PREPARATORIA</option>
                            <option value="Licenciatura">LICENCIATURA</option>
                            <option value="Maestria">MAESTRIA</option>
                            <option value="Doctorado">DOCTORADO</option>
                        </select>
                        @error('nivelacademico')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="country">Grado Academico</label>
                        <select class="select2 form-select" wire:model="gradoacademico">
                            <option value="">SELECCIONA</option>
                            <option value=1>1</option>
                            <option value=2>2</option>
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option>
                            <option value=6>6</option>
                            <option value=7>7</option>
                            <option value=8>8</option>
                            <option value=9>9</option>
                            <option value=10>10</option>
                            <option value=11>11</option>
                            <option value=12>12</option>
                        </select>
                        @error('gradoacademico')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Carrera Profesional</label>
                        <input type="text" class="form-control" placeholder="" wire:model="profesion" />
                        @error('profesion')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Experencia en Gobierno</label>
                        <input type="text" class="form-control" placeholder="" wire:model="experencia" />
                        @error('experencia')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Curriculum Vitae</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">INE</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Titulo o Cedula Profesional</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Acuse</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Protesta</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Renuncia</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Formato</label>
                        <div class="input-group mb-2">
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                    </div>



                    <div class="mb-3 col-md-6">
                        <label class="form-label">Observaciones</label>
                        <input type="text" class="form-control" placeholder="" wire:model="observaciones" />
                        @error('observaciones')
                        <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" wire:model="isReceptoria" type="checkbox"
                                {{  $isReceptoria == true ? 'checked' : '' }}>
                                <label class="form-label">¿Es Receptoria?</label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label">Municipio</label>
                        <select wire:model="idmunicipio" class="select2 form-select">
                            <option value="">SELECCIONA</option>
                            @php
                            $areas = \DB::table('cat_municipios')
                                ->select('id', 'nombre')
                                ->get();
                            @endphp
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ strtoupper($area->nombre) }}</option>
                            @endforeach
                        </select>
                       
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2"data-bs-toggle="modal" data-bs-target="#succes_modal"   wire:click="save">Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>


</div>