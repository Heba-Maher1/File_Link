<x-main-layout title="Download">
    <div class="container mt-5 shadow-lg" style="width: 400px; background: white; padding: 30px; border-radius: 10px;">
        <div class="text-center">
            <i class="fa-regular fa-circle-down mb-2" style="font-size: 150px;color: gainsboro;"></i>
            <h5 class=" mb-4">Ready when you are!</h5>
            
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom mb-2">
            <p class="text-secondary  ">{{ $file->name }}</p>
            <form action="{{route('destroy' , $file->id )}}" method="POST">
                @method('delete')
                @csrf
                <button type="submit" class="btn border-0"><i class="fa-solid fa-trash text-danger"></i></button>
            </form>
        </div>
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4">
            <p class="text-secondary ">{{ $file->name }} <br> <span style="font-size: 15px">{{ $file->size }} KB</span></p>
            <div id="search" style="cursor: pointer;">
                <i class="fa-solid fa-magnifying-glass" style="color: #456991"></i>
            </div>
        </div>
        <a href="{{ route('download', $file->shared_link) }}" class="btn btn-lg btn-block w-100 text-white mb-2" style="background: #456991">Download</a>
    </div>   

    <div id="detailContainer" class=" position-absolute bg-white d-none" style="height: 100vh;width:50%;top:0;right:0">
        <div class="nav border-bottom p-3">
            <i id="close" class="fa-regular fa-circle-xmark" style="color:gainsboro;font-size:30px;cursor: pointer;"></i>
        </div>
        <div class="container body p-5">
            <h1 class="pb-4" >You tranfer details</h1>
            <table >
                <tr class="py-3">
                    <th style="padding-right: 400px;padding-bottom:20px">Title</th>
                    <th style="padding-bottom:20px">file</th>
                </tr>
                @foreach ($files as $fileItem)
                    <tr class="border-bottom py-3">
                        <td style="padding-bottom:20px">{{ $fileItem->name }}</td>
                        <td style="padding-bottom:20px">{{ $fileItem->name }}<br>{{ $fileItem->size }} KB</td>
                    </tr>      
                @endforeach        
            </table>
        </div>
    </div>

    <script>
        const detailContainer = document.getElementById('detailContainer');
        const close = document.getElementById('close');
        const search = document.getElementById('search');
    
        search.addEventListener('click', function() {
            detailContainer.classList.remove('d-none');
        });
    
        close.addEventListener('click', function() {
            detailContainer.classList.add('d-none');
        });
    </script>
</x-main-layout>