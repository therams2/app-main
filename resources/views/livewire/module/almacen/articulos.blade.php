<div>


<!-- Suspend Modal -->
<div wire:ignore.self  class="modal fade" id="sleep_modal_person" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suspender</h5>
        
          </button>
      </div>
      <div class="modal-body">
        <p>¿Está Seguro de Suspender este Funcionario?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="suspender" >Suspender</button>
      </div>
    </div>
  </div>
</div>



    <!-- Detalle Modal -->
    <div wire:ignore.self class="modal fade" id="detail_modal_person" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Detalles del Nombramiento</h5>
                  
                </div>
                <div class="modal-body">
                    <div class="col mb-3">
                        <div class="row">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">

                                <img src="{{asset('img/without_image_profile.png')}}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    <div class="container">
                                        <h4><b>{{$nombre}} {{$apellidos}}</b></h4>
                                        <a>{{$email}}</a>
                                        <p>{{$telefono}}</p>
                                        <p>{{$direccion}}</p>
                                    </div> 
                            </div>
                        </div>
                    </div> 

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label  class="form-label">Dependencia</label>
                            <p>{{$nombredependencia}} </p>
                        </div>

                        <div class="col mb-0">
                            <label  class="form-label">Área</label>
                            <p>  {{$nombrearea}}</p>
                        </div>

                    </div>


                    <div class="row g-2">
                        <div class="col mb-0">
                            <label  class="form-label">Categoria</label>
                            <p>{{$categoria}}</p>
                        </div>


                        <div class="col mb-0">
                            <label class="form-label">Estatus</label>
                            <p> {{ $estatusFuncionario[  'nombre'  ][    $estatus   ]   }}</p>
                        </div>
                    </div>


                    <div class="row g-2">
                        <div class="col mb-0">
                            <label   class="form-label">Sueldo Neto</label>
                            <p>{{$sueldoneto}} </p>
                        </div>

                        <div class="col mb-0">
                            <label  class="form-label">Funcionario Quien Propone</label>
                            <p>{{$funcionariop}} </p>
                        </div>

                        
                    </div>


                    
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label  class="form-label">Nivel Academico</label>
                            <p>{{$nivelacademico}}</p>
                        </div>



                        <div class="col mb-0">
                            <label  class="form-label">Grado Academico</label>
                            <p>{{$gradoacademico}} </p>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label  class="form-label">Profesión</label>
                            <p>{{$profesion}} </p>
                        </div>



                        <div class="col mb-0">
                            <label class="form-label">Experencia en Gobierno</label>
                            <p>{{$experencia}} </p>
                        </div>
                    </div>

                    <div class="row g-2">
                    <div class="col mb-0">
                          <label   class="form-label">Fecha de Entrada</label>
                          <p>{{$fechaentrada}}</p>
                      </div>
                        <div class="col mb-0">
                            <label  class="form-label">Observaciones</label>
                            <p>{{$observaciones}} </p>
                        </div>
                        <div class="row g-2">

                        <table style= "text-align: center;  vertical-align: middle;"> 
                            <tbody >
                            <tr>
                                <th scope="col">Curriculum Vitae</th>
                                <th scope="col">INE</th>
                                <th scope="col">Titulo o Cedula Profesional</th>
                                <th scope="col">Acuse</th>
                                <th scope="col">Protesta</th>
                                <th scope="col">Renuncia</th>
                                <th scope="col">Formato</th>
                        

                            </tr>
 
                            <tr>
                                <td scope="col"><a href="https://www.uc3m.es/orientacionyempleo/media/orientacionyempleo/doc/archivo/doc_plantillascv/plantillas-de-cv-para-descargar-gratis.pdf"><img   src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>

                                     <td scope="col"><img src="{{asset('img/pdf_icon.png')}}" 
                                     height="50" width="50" id="uploadedAvatar" /></td>
                            </tr>
                            </tbody>

                            </table>

                       
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">Cerrar</button> 
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
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">

                        <img src="{{asset('img/without_image_profile.png')}}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <form wire:submit.prevent="save">




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
                    <form  >
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nombre(s)</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value=""
                                    autofocus wire:model="nombre" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value=""
                                    wire:model="apellidos" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="" placeholder=""
                                    wire:model="email" />
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Teléfono</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">MX (+52)</span>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        placeholder="202 555 0111" wire:model="telefono" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Dirección</label>
                                <input wire:model="direccion" type="text" class="form-control" id="address"
                                    name="address" placeholder="Calle / Número / Colonia" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Funcionario Quien Propone</label>
                                <input wire:model="funcionariop" type="text" class="form-control" id="funcionariop" />
                            </div>

                        </div>
                        <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2" data-bs-dismiss="modal" >Guardar</button>
                        
                        <button type="button" class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">  Cerrar</button> 

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Edit New Register Modal-->
    <div wire:ignore.self class="modal fade" id="edit_modal_person" tabindex="-1" role="dialog"
        aria-labelledby="createModalGender" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="createModalGender">Añadir Nuevo Funcionario</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{asset('img/without_image_profile.png')}}" alt="user-avatar" class="d-block rounded"
                            height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <form wire:submit.prevent="updateFuncionario">
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
                    <form  >
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nombre(s)</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" value=""
                                    autofocus wire:model="nombre" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value=""
                                    wire:model="apellidos" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="email" value="" placeholder=""
                                    wire:model="email" />
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Teléfono</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">MX (+52)</span>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        placeholder="202 555 0111" wire:model="telefono" />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Dirección</label>
                                <input wire:model="direccion" type="text" class="form-control" id="address"
                                    name="address" placeholder="Calle / Número / Colonia" />
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Funcionario Quien Propone</label>
                                <input wire:model="funcionariop" type="text" class="form-control" id="funcionariop" />
                            </div>

                        </div>
                        <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2" data-bs-dismiss="modal">Guardar</button>
                        
                        <button type="button" class="btn btn-outline-secondary me-2 " data-bs-dismiss="modal">  Cerrar</button> 

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="card mb-4">
        <div class="card-body d-flex">
            <x-jet-input placeholder="Buscar" type="text" wire:model="search" />
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                data-bs-target="#create_modal_person"> Nuevo Funcionario</button>

        </div>

        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <!--Table-->
            <div class="table-responsive">
                <table class="table ">
                    <tbody>
                        <thead>
                            <tr>
                                <th scope="col">Nombre del Funcionario</th>
                                <th scope="col">Dependencia</th>
                                <th scope="col">Área</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Acciones</th>

                            </tr>
                        </thead>
                        @foreach ($funcionarios as $funcionario)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar ">
                                            <img src="{{asset('img/without_image_profile.png')}}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">
                                            {{$funcionario->nombre." ".$funcionario->apellidos}}</span>

                                    </div>
                                </div>

                            </td>
                            <td>{{$funcionario->nombreDependencia  == null ? "Sin asignar ":"$funcionario->nombreDependencia "}}
                            </td>
                            <td>{{$funcionario->nombreArea  == null ? "Sin asignar ":"$funcionario->nombreArea "}}</td>
                            <td>{{$funcionario->telefono}}</td>
                            <td><span class="{{ $estatusFuncionario[  'css'  ][    $funcionario->estatus   ]   }}">
                                    {{ $estatusFuncionario[  'nombre'  ][    $funcionario->estatus   ]   }}
                            <td>
                                @if($funcionario->estatus != 3)
                                <a wire:click="showdetail({{$funcionario->id}})" data-bs-toggle="modal" data-bs-target="#detail_modal_person" class="dropdown-item"><i
                                        class="bx bx-show-alt me-1"></i>Detalles</a>
                                        
                                @endif
                                <a wire:click="showedit({{$funcionario->id}})"  data-bs-toggle="modal" data-bs-target="#edit_modal_person" class="dropdown-item"><i
                                        class="bx bx-edit-alt me-1"></i>Editar</a>
                                        
                                <a wire:click="asignarFuncionarioId({{$funcionario->id}})" data-bs-toggle="modal" data-bs-target="#sleep_modal_person" class="dropdown-item"><i
                                        class="bx bx-loader me-1"></i>Suspender</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Account -->
    </div>