{{-- Componente de sucesso --}}
@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Pronto!', "{{ session('success') }}", 'success');
        })
    </script>
@endif


{{-- Componente de errors --}}
@if ($errors->any())
    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Error!', "{!! $message !!}", 'error');
        });
    </script>
@endif
