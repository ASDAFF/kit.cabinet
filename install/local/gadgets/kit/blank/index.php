<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');

if($arParams['G_BLANK_INIT_JQUERY'] == 'Y')
{
	Asset::getInstance()->addJs($arGadget['PATH_SITEROOT'].'/jquery.1.11.1.min.js');
}

Asset::getInstance()->addJs($arGadget['PATH_SITEROOT'].'/script.js');

$idUser = intval($USER->GetID());

if(Loader::includeModule('kit.cabinet') && $idUser > 0)
{
	?>


	<div class="blank_excel_in_wrapper">
		<div id="blank_excel_in" class="blank_excel_in blank_excel">
			<div class="blank_excel_in_text blank_excel_text">
				<div class="blank_excel_in_img blank_excel_img"></div>
				<?=Loc::getMessage('GD_KIT_CABINET_BLANK_EXCEL_IN')?>
			</div>
		</div>
		<div id="excel_in_form" class="js" style="display:none;">
			<form method="post" action="" enctype="multipart/form-data" novalidate class="box">
				<div class="blank_excel_in_form">
					<div class="box__input">
						<div class="error_blank_excel_in"></div>
						<input type="file" name="files[]" id="file" class="box__file"/>
						<label for="file"><strong><?=Loc::getMessage('GD_KIT_CABINET_BLANK_CHOOSE_FILE')?></strong><span class="box__dragndrop"> <?=Loc::getMessage('GD_KIT_CABINET_BLANK_MOVE')?></span>.</label>
						<button type="button" class="box__button"><?=Loc::getMessage('GD_KIT_CABINET_BLANK_SEND')?></button>
					</div>
					<div class="box__uploading">Uploading&hellip;</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-sm-6 sm-padding-left-no">
		<div id="blank_excel_out" class="blank_excel_out blank_excel" data-path-to-blank="<?=$arParams['G_BLANK_PATH_TO_BLANK']?>">
			<div class="blank_excel_out_text blank_excel_text">
				<div class="blank_excel_out_img blank_excel_img"></div>
				<?=Loc::getMessage('GD_KIT_CABINET_BLANK_EXCEL_OUT')?>
			</div>
		</div>
	</div>
	<script>
		;( function ( document, window, index )
		{
			// feature detection for drag&drop upload
			var isAdvancedUpload = function()
			{
				var div = document.createElement( 'div' );
				return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
			}();


			// applying the effect for every form
			var forms = document.querySelectorAll( '.box' );

			Array.prototype.forEach.call( forms, function( form )
			{
				var input		 = form.querySelector( 'input[type="file"]' ),
					label		 = form.querySelector( 'label' ),
					errorMsg	 = form.querySelector( '.box__error span' ),
					restart		 = form.querySelectorAll( '.box__restart' ),
					droppedFiles = false,
					showFiles	 = function( files )
					{
						label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
					},
					triggerFormSubmit = function()
					{
						var event = document.createEvent( 'HTMLEvents' );
						event.initEvent( 'submit', true, false );
						form.dispatchEvent( event );
					};

				// letting the server side to know we are going to make an Ajax request
				var ajaxFlag = document.createElement( 'input' );
				ajaxFlag.setAttribute( 'type', 'hidden' );
				ajaxFlag.setAttribute( 'name', 'ajax' );
				ajaxFlag.setAttribute( 'value', 1 );
				form.appendChild( ajaxFlag );

				// automatically submit the form on file select
				input.addEventListener( 'change', function( e )
				{
					showFiles( e.target.files );


				});

				// drag&drop files if the feature is available
				if( isAdvancedUpload )
				{
					form.classList.add( 'has-advanced-upload' ); // letting the CSS part to know drag&drop is supported by the browser

					[ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( function( event )
					{
						form.addEventListener( event, function( e )
						{
							// preventing the unwanted behaviours
							e.preventDefault();
							e.stopPropagation();
						});
					});
					[ 'dragover', 'dragenter' ].forEach( function( event )
					{
						form.addEventListener( event, function()
						{
							form.classList.add( 'is-dragover' );
						});
					});
					[ 'dragleave', 'dragend', 'drop' ].forEach( function( event )
					{
						form.addEventListener( event, function()
						{
							form.classList.remove( 'is-dragover' );
						});
					});
					form.addEventListener( 'drop', function( e )
					{
						droppedFiles = e.dataTransfer.files;
						showFiles( droppedFiles );

					});
				}

				$('.box__button').on('click',(function(e) {
					var ajaxData = new FormData( form );
					if( droppedFiles )
					{
						for (var i = 0; i < droppedFiles.length; i++)
						{
							ajaxData.append('file', droppedFiles[i]);
						}
					}

					var xhr = new XMLHttpRequest();
					xhr.open('POST', '/include/ajax/blank_excel_in.php');
					xhr.onload = function ()
					{
						if (xhr.status === 200)
						{
							var data = xhr.responseText;
							if(data != '')
							{
								$('.error_blank_excel_in').html(data);
							}
							else
							{
								location.href = '<?=$arParams['G_BLANK_PATH_TO_BLANK']?>';
							}
						}
						else
						{
							console.log('blarrghhhhh...');
						}
					};
					xhr.send(ajaxData);
					return false;
				}));
			});
		}( document, window, 0 ));
	</script>
	<?
}
?>
