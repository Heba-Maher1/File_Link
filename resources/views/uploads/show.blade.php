<x-main-layout title="Show">
    <div class="container mt-5 shadow-lg" style="width: 400px; background: white; padding: 30px; border-radius: 10px;">
            <div class="text-center">
                <img src="{{ asset('assets/done.png') }}" width="150" height="150" class="mb-4" alt="">
                <h3 class="mb-4">You're Done!</h3>
                <p class="text-secondary mb-4">Copy your download link</p>
                <div id="textToCopy" class="text-secondary py-3 px-3 border mb-4">{{ $link }}</div>
                <a id="copyBtn" onclick="copyText()" class="btn btn-lg btn-block w-100 text-white mb-2" style="background: #456991">Copy Link</a>
                <div id="copyNotification" class="text-success" style="display: none;">Text copied!</div>
            </div>
    </div>

    <script>
       document.getElementById("copyBtn").addEventListener("click", copyText);

        function copyText() {
        const textToCopy = document.getElementById("textToCopy").innerText;

        const tempTextarea = document.createElement("textarea");
        tempTextarea.value = textToCopy;
        document.body.appendChild(tempTextarea);
        tempTextarea.select();

        try {
            const successful = document.execCommand("copy");
            if (successful) {           
            const copyNotification = document.getElementById("copyNotification");
            copyNotification.style.display = "block";
            setTimeout(() => {
                copyNotification.style.display = "none";
            }, 3000);
            }
        } catch (err) {
            console.error("Oops, unable to copy:", err);
        }
        document.body.removeChild(tempTextarea);
        }

</script>    
</x-main-layout>
