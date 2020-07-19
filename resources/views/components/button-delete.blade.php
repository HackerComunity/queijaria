<form action="{{ $action }}" method='POST'>
    @csrf
    @method("DELETE")
    <button type='submit' class="custom-button-actions">
        <i class='text-danger fas fa-trash-alt'></i>
    </button>
</form>
