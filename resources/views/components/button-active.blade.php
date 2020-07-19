<form action="{{ $action }}" method='POST'>
    @csrf
    @method("PUT")
    <button type='submit' class="custom-button-actions">
        <i class='text-success fas fa-check'></i>
    </button>
</form>
