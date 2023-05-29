@if (Session::has('msg-error'))
            <script>
                function error() {
                    var error = "{!! Session::get('msg-error') !!}"
                    return swal("Ops,Ouve um erro!", error, "error");
                }

                error()
                setTimeout(function() {
                    // o teu código mouse hover aqui
                    location.reload();
                }, 3000);
            </script>
        @endif
        @if (Session::has('msg-success'))
            <script>
                function success() {
                    var success = "{!! Session::get('msg-success') !!}"
                    return swal("Tudo ok!", success, "success");
                }
                success();
                setTimeout(function() {
                    // o teu código mouse hover aqui
                    location.reload();
                }, 3000)
            </script>
        @endif
