<form action="{{ url('api/uploadTrainingPicture') }}" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="image">
    <input type="submit" value="Upload Image" name="submit">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
