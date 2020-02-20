@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            theme    : 'mint',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
