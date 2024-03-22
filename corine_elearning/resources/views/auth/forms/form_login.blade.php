<form class=" dm-uploader drag-and-drop-zone form-horizontal" enctype="multipart/form-data"
     method="POST" id="formAppareil" name="formAppareil">
    @csrf

    
    <div>
        <h3 class="fw-medium">Nouvel Appareil</h3>
    </div>


    <div id="validation-errors"></div>

    <div class="block block-rounded p-3">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="client_id" id="client_id">
        <input type="hidden" name="saveDate" id="" value="{{ date('d-m-Y') }}">
        <div class="block-header block-header-default">
            <h3 class="block-title"></h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-alt-secondary">
                    <i class="fa fa-fw fa-check"></i> Enregister
                </button>
            </div>
        </div>

        <div class="modal-content" style="border: 4px solid #ffffff">

            <div class="row ">
                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="code">Code de l'appareil : <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"> <i class="far fa-user"></i>
                        </span>
                        <input type="text" class="form-control insolid" id="code" name="code"
                            placeholder="code"><small class="text-gray"></small>

                    </div>
                    @if ($errors->has('code'))
                        <small class="mb-0 text-danger">{{ $errors->first('code') }}</small>
                    @endif
                </div>
                <div class="col-sm-3 mb-3">
                    <label class="form-label" for="nom">Nom de l'appareil : <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"> <i class="far fa-user"></i>
                        </span>
                        <input type="text" class="form-control insolid" id="nom" name="nom"
                            placeholder="nom"><small class="text-gray"></small>

                    </div>
                    @if ($errors->has('nom'))
                        <small class="mb-0 text-danger">{{ $errors->first('nom') }}</small>
                    @endif
                </div>
                <div class="col-sm-3 mb-3"> </div>

                

               


            </div>
            <div class="row">
                

            <div class="col-sm-3 mb-3">
                    <label class="form-label" for="marque">Marque de l'appareil : <span class="text-danger">*</span>
                        <div class="input-group">
                            <span class="input-group-text"> <i class="fa fa-weight"></i> </span>
                            <input type="text" class="form-control insolid" id="marque" name="marque"
                                placeholder="Marque de l'appareil">
                            <small class="text-gray"> </small>
                        </div>
                        
                        @if ($errors->has('marque'))
                            <small class="mb-0 text-danger">{{ $errors->first('marque') }}</small>
                        @endif
                </div>

            <div class="col-sm-3 mb-3">
                    <label class="form-label" for="cathegorie">Cathegorie de l'appareil : <span class="text-danger">*</span>
                        <div class="input-group">
                            <span class="input-group-text"> <i class="fa fa-weight"></i> </span>
                            <input type="text" class="form-control insolid" id="cathegorie" name="cathegorie"
                                placeholder="Catégorie de l'appareil">
                            <small class="text-gray"> </small>
                        </div>
                        
                        @if ($errors->has('cathegorie'))
                            <small class="mb-0 text-danger">{{ $errors->first('cathegorie') }}</small>
                        @endif
                </div>
                
                <div class="col-sm-3 mb-2">
                    <label class="form-label" for="taille">Taille de l'appareil : <span class="text-danger">*</span>
                        <div class="input-group">
                            <span class="input-group-text"> <i class="fa fa"></i> </span>
                            <input type="text" class="form-control insolid" id="taille" name="taille"
                                placeholder="1.80">

                        </div> <small class="text-gray">Definisser la taille en M </small>
                        @if ($errors->has('taille'))
                            <small class="mb-0 text-danger">{{ $errors->first('taille') }}</small>
                        @endif
                </div>


           

        </div>
        <!-- END Advanced -->

        <!-- Submit -->
        <div class="row">
            <div class="col-10"> </div>
            <div class="col-1">
                <button id="displayNotif" type="submit" class="btn btn-primary" id="btn-save"
                    style="width: 120px">Enregistrer</button>
            </div>
        </div>
        <!-- END Submit -->
    </div>
    </div>
</form>




</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<script type="text/javascript">

</script>
