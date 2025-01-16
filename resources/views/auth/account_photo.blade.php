<form action="{{ route('userPhotoChange', $data->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <label class="account-file">
        <input type="file" name="photo" required>
        <span class="account-file-btn">Выберите файл</span>
        <span class="account-file-text">Максимум 10мб</span>
    </label>
    <div>
        <button class="account-file-btn-sub" type="submit">Выполнить</button>
    </div>
</form>

<script>
    $('.account-file input[type=file]').on('change', function(){
        let file = this.files[0];
        $(this).closest('.account-file').find('.account-file-text').html(file.name);
    });
</script>
