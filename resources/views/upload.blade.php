
    <div class="container">
        <div class="row">
            <form method="post" enctype="multipart/form-data" action="">
                {{csrf_field()}}
                <input name="file" type="file">
                <input type="submit" value="submit">
            </form>

        </div>
    </div>
