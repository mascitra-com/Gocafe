@extends('_layout.homepage.index')
@section('page_title', 'Kirim Saran')
@section('content')
    <div class="ui one column centered grid">
        <div class="column center aligned"><h1>Email Us</h1></div>
    </div>
    <div class="ui hidden divider"></div>
    <div class="ui container">
        <div class="ui grid">
            <div class="ten wide column">
                <form class="ui form" action="mailto:idea@kulinerae.com" enctype="text/plain" method="GET" id="idea-box">
                    <div class="field">
                        <label>Nama</label>
                        <input type="text" name="name" placeholder="Nama Lengkap">
                    </div>
                    <div class="field">
                        <label>E-mail</label>
                        <input type="text" name="email" placeholder="Alamat E-mail">
                    </div>
                    <div class="field">
                        <label>Handphone / Telepon</label>
                        <input type="text" name="text" placeholder="Nomor Yang Dapat di Hubungi">
                    </div>
                    <div class="field">
                        <label>Subyek</label>
                        <input type="text" name="subject" placeholder="Hal Apa Yang Ingin Anda Sampaikan">
                    </div>
                    <div class="field">
                        <label for="idea">Informasi yang Ingin Anda Dapatkan Lebih Lanjut</label>
                        <textarea id="idea" name="message"></textarea>
                    </div>
                    <button class="ui brown button" type="submit">Kirim</button>
                    <input type="hidden" name="body" />
                </form>
            </div>
            <div class="six wide column">

            </div>
        </div>
    </div>
    <div class="ui hidden divider"></div>
@endsection
@section('javascripts')
    <script>
        var form = document.getElementById('idea-box');
        form.addEventListener('submit',contact,false);
        function contact(e) {
            // Prevent Default Form Submission
            e.preventDefault();

            var target = e.target || e.srcElement;
            var i = 0;
            var message = '';

            // Loop Through All Input Fields
            for(i = 0; i < target.length; ++i) {
                // Check to make sure it's a value. Don't need to include Buttons
                if(target[i].type != 'text' && target[i].type != 'textarea') {
                    // Skip to next input since this one doesn't match our rules
                    continue;
                }

                // Add Input Name and value followed by a line break
                message += target[i].name + ': ' + target[i].value + "\r\n";
            }
            // Modify the hidden body input field that is required for the mailto: scheme
            target.elements["body"].value = message;

            // Submit the form since we previously stopped it. May cause recursive loop in some browsers? Should research this.
            this.submit();
        }
    </script>
@endsection