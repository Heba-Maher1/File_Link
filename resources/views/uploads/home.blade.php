<x-main-layout title="Home">
    <div class="mt-5 shadow-lg" style="width: 400px;background: white;padding: 30px;border-radius:10px;">

        <h2 class="text-center py-3">Upload files</h2>

        <x-alert name="success" class="alert alert-success my-3" />

        <form id="fileUploadForm" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
            @csrf
            @includeIf('uploads._form', ['button_label' => 'Get A Link'])
        </form>
        
        <div class="text-center mt-3">
            <p><a href="{{ route('emailForm') }}" id="showEmailTransferForm"
                    class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Or Send
                    Email Transfer</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadedFile = document.getElementById('uploaded_file');
            const size = document.getElementById('size');
            const title = document.getElementById('title');

            uploadedFile.addEventListener('change', function() {
                const file = uploadedFile.files[0];

                title.value = file.name;
                size.value = file.size;
            });
        });
    </script>
</x-main-layout>
