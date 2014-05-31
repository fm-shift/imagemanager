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

    'Way\Generators\GeneratorsServiceProvider'

ӨС-д images table үүсгэх.

	php artisan migrate --package=selmonal/imagemanager

Хэрэгцээт asset уудыг өөрийн төсөл рүү татаж авах.

	php artisan asset:publish --package=selmonal/imagemanager

Тохиргооны файл үүсгэх. `app/config` хавтатс `sim.php` тохиргооны файл үүсгэнэ. Дараах тохируулгуудыг хийж өгнө.

	return array(
	
		/*
		|--------------------------------------------------------------------------
		| Image manager base path
		|--------------------------------------------------------------------------
		|
		| Зургуудын хадгалагдах хавтас, директор байрлана. Laravel ийн
		| public хавтаснаас эхлэсэн зам байна.
		|
		*/

		"basePath" => "/assets/photos/",

		/*
		|--------------------------------------------------------------------------
		| Image sizes
		|--------------------------------------------------------------------------
		|
		| Зургын хадгалагдах хэмжээний төрөлүүд байна. Зургын төрөл бүрээр 
		| basepath хавтас дотор дэд хавтас үүсгэн зургууд заасан хэмжээний 
		| дагуу хадгалагдана.
		|
		*/

		"sizes" => array(

			"thumb" => array(
				"width"  => 300,	
				"height" => 200,			
			),
			"original" => array(
				"width"  => 600,
				"height" => false,
				"ratio"  => true,
			)
		),

	);

Route зааж өгөх

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
