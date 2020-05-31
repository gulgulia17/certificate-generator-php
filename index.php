<?php
if (isset($_POST['certificate'])) {
    function Certificate()
    {
        $font = __DIR__ . '/BRUSHSCI.TTF';
        $filpath = "issued/" . md5(time()) . ".jpg";
        $image = imagecreatefromjpeg("certificate.jpg");
        $color = imagecolorallocate($image, 19, 21, 22);
        $name = $_POST['name'];
        imagettftext($image, 40, 0, 380, 420, $color, $font, $name);
        $date = date('d-m-Y');
        imagettftext($image, 20, 0, 450, 600, $color, $font, $date);
        imagejpeg($image, $filpath);
        imagedestroy($image);
        return $filpath;
    }
    function DownloadCertificate($filename)
    {
        $filepath = $filename;
        $filename = explode('/', $filename)[1];
        header("Cache-Control: public");
        header("Content-Description: FIle Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/zip");
        header("Content-Transfer-Emcoding: binary");

        readfile($filepath);
        exit;
    }

    DownloadCertificate(Certificate());
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        GENERATE CERTIFICATE
                    </div>
                    <div class="card-body">
                        <form method="post" target="_blank">
                            <input type="hidden" name="certificate">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary w-100">GENERATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>