Selmonal Image Manager
==================

Зургын файл удирдах сан

## Requirements

Assets

- `underscore 1.6.*`
- `jquery v1.11.*`
- `backbone 1.1.*`
- `Bootstrap 3.*`

Packages

- `php >=5.3.0*`
- `illuminate/support 4.1.*`
- `intervention/image 2.0.1`

## Installation

Пакежийг суулгахдаа composer ашиглаж суулгана. `composer.json` файлд дараах засварыг хийнэ.

	"require-dev": {
		"selmonal/imagemanager": "dev-master"
	}

`composer` update хийнэ:

    composer update

Service provider ийг өөрийнхөө төсөлд бүртгүүлнэ. `app/config/app.php` файлыг нээгээд доорх мөрийг `providers` хэсэгт нэмнэ.

    'Selmonal\Imagemanager\ImagemanagerServiceProvider'

ӨС-д images table үүсгэх.

	php artisan migrate --package=selmonal/imagemanager

Хэрэгцээт asset уудыг өөрийн төсөл рүү татаж авах.

	php artisan asset:publish

Тохиргооны файлыг өөрийн төсөл рүү хуулах.

	php artisan config:publish selmonal/imagemanager

Route зааж өгөх. `routes.php` файлд нэмж өгнө.

	Route::resource("images", "Selmonal\Imagemanager\ImagesController", array( "only" => array("index", "store") ));

## Example

	<!DOCTYPE html>
	<html>
		<head>
			<title>SASPlane test</title>
			<link rel="stylesheet" type="text/css" href="/assets/bootstrap/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="/packages/selmonal/imagemanager/imagemanager.css">
		</head>
		<body>


			<input type="text" id="image-input" />

			<img src="" id="my-image">

			<!-- SIM templates-->
			@include("SIM::index")
			<!-- end of SIM templates -->

			<script type="text/javascript" src="/assets/jquery.js"></script>
			<script type="text/javascript" src="/assets/bootstrap/bootstrap.min.js"></script>
			<script src="/assets/underscore.js"></script>
			<script src="/assets/backbone.js"></script>

			<script type="text/javascript" src="/packages/selmonal/imagemanager/ajaxform.js"></script>

			<!-- Хэлний файл mn.js /Монгол/, en.js /Англи/ гэсэн 2 хэлээс сонгож болно. -->
			<script type="text/javascript" src="/packages/selmonal/imagemanager/lang/mn.js"></script>

			<script type="text/javascript" src="/packages/selmonal/imagemanager/imagemanager.js"></script>

			<script type="text/javascript">
				
				$(document).ready(function() {

					$("#image-input").focus(function() {

						Window.imageManager.select({

							selected: function( path ) {
								
								$("#image-input").val(path);

								$("#my-image").attr("src", "assets/images/thumb/" + path);
							}

						});
						
					});

				});

			</script>
		</body>
	</html>

![alt tag](https://raw.github.com/selmonal/imagemanager/master/demo.jpg)
