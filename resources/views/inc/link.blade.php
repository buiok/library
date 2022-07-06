<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Добавить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if($errors->form_addLink->all())
                <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->form_addLink->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('addLinkMaterial') }}" method="POST">
            @csrf
                <input type="hidden" value="{{ $material->id }}" name="material_id">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Добавьте подпись"
                               id="floatingModalSignature" name="signature">
                        <label for="floatingModalSignature">Подпись</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Добавьте ссылку" id="floatingModalLink" name="url" required>
                        <label for="floatingModalLink">Ссылка</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalToggleEdit" aria-hidden="true" aria-labelledby="exampleModalToggleLabelEdit"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabelEdit">Изменить ссылку</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if($errors->form_editLink->all())
                <div class="alert alert-danger">
                    <ul>
                    @foreach($errors->form_editLink->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('editLinkMaterial') }}" method="POST">
            @csrf
                <input type="hidden" name="material_id" id="material_id">
                <input type="hidden" name="link_id" id="link_id">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Добавьте подпись"
                               id="floatingModalSignatureEdit" name="signature">
                        <label for="floatingModalSignatureEdit">Подпись</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="url" class="form-control" placeholder="Добавьте ссылку" id="floatingModalLinkEdit" name="url" required>
                        <label for="floatingModalLinkEdit">Ссылка</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>