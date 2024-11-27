@if (Session::has('success'))
    <div id="successMessage" class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div id="errorMessage" class="bg-red-200 border-red-600 p-4 mb-3 rounded-sm shadow-sm">
        {{ Session::get('error') }}
    </div>
@endif

<script>
    // Function to hide message after 20 seconds
    setTimeout(function () {
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000); // 20,000 milliseconds = 20 seconds
</script>
