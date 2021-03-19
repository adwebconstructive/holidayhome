@if($errors->any())
<script>
    $(document).ready(() => {
        @foreach($errors->getMessages() as $name => $errors)
        $('input[name="{{$name}}"]').addClass('is-invalid');
        $('<span class="invalid-feedback">{{ $errors[0] }}</span>').insertAfter($('input[name="{{$name}}"]'));
        @endforeach
    });
</script>
@endif