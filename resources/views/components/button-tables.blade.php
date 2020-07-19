<form action='{{ $action }}' method='{{ $method }}'>
    {{ $token }}
    {{ $methodCustom }}
    <button type='submit'>
        <i class='text-{{ $color }} {{ $button_type }}'></i>
    </button>
</form>
