<x-main-layout title="Home">
    <div class="container mt-5 shadow-lg" style="width: 400px;background: white;padding: 30px;border-radius:10px;">  
        <form  method="POST" action="{{ route('upload') }}"  enctype="multipart/form-data">
                @csrf
                <h2 class="text-center py-3">Upload files</h2>
                <div class="form-floating mb-3">
                    <input type="file" @class(['form-control' , 'is-invalid' => $errors->has('uploaded_file')])  name="uploaded_file" id="uploaded_file" placeholder="Upload files">
                    <label for="uploaded_file">Upload Files</label>
                    @error('uploaded_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" @class(['form-control' , 'is-invalid' => $errors->has('size')]) name="size" id="size" placeholder="size">
                    <label for="size">size</label>
                    @error('size')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text"  @class(['form-control' , 'is-invalid' => $errors->has('title')])  name="title" id="title" placeholder="title">
                    <label for="title">title</label>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" @class(['form-control' , 'is-invalid' => $errors->has('message')])  name="message" id="message" placeholder="message">
                    <label for="message">message</label>
                    @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-lg btn-block w-100 text-white" style="background: #456991">Get A Link</button>
            </form>      
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