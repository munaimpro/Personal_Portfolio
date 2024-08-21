@include('admin.components.signin.signin_header')
@include('admin.components.signin.signin_form')
@include('admin.components.signin.signin_footer')
<!-- resources/views/upload.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Multiple File Upload</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <input type="file" id="files" name="files[]" multiple>
        <button type="button" onclick="uploadFiles()">Upload</button>
        <div id="message"></div>
        <div id="filesName"></div>
    </div>

    <script>
        function uploadFiles() {
            let files = document.getElementById('files').files;
            let formData = new FormData();

            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            axios.post('{{ url('Admin/addPortfolioInfo') }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                document.getElementById('message').innerText = response.data.message;
                document.getElementById('filesName').innerText = response.data.files;
            })
            .catch(error => {
                console.error(error);
            });
        }
    </script>
</body>
</html>
