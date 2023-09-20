<x-main-layout title="already subscribed">
@push('styles')
<style>
.website-color-btn{
    color: white;
    background-color:#456991;
}
.website-color-btn:hover{
    border-color: #456991;
    background-color:white;
    color: #456991;
}
</style>

@endpush

    <div class="bg-white rounded p-4 mt-5">
        <h1 style="color: #456991">You are already Subscribed</h1>
        <a href="{{ route('index')}}" class="btn website-color-btn mt-3" style="">Back to home</a>

    </div>

</x-main-layout>    