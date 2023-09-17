<x-form.form-outline>
    <x-form.input type="file" name="uploaded_file" id="uploaded_file" placeholder="Upload files" :value="$file->uploaded_file" />
    <x-error-message name="uploaded_file" />
</x-form.form-outline>

<x-form.form-outline>
    <x-form.input type="text" name="size" id="size" placeholder="size" :value="$file->size" />
</x-form.form-outline>

<x-form.form-outline>
    <x-form.input type="text" name="title" id="title" placeholder="title" :value="$file->title" />
</x-form.form-outline>
<x-form.form-outline>
    <x-form.input type="text" name="message" id="message" placeholder="message" :value="$file->message" />
</x-form.form-outline>

<button type="submit" class="btn btn-lg btn-block w-100 text-white" style="background: #456991">{{ $button_label }}</button>
