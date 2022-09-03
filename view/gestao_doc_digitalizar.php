<?php require 'header.php';?>


<div class="conteiner">
    <div class="row">
		<div class="col-sm-2"><br><br>
			<div class="list-group"style="margin-left:5px;">
					  <a href="../view/gestao_doc_cadastro.php" class="list-group-item list-group-item-action ">
					    Cadastro de Documentos Oficiais
					  </a>
					  <a href="../view/gestao_doc_cadastro_digitalizados.php" class="list-group-item list-group-item-action">Digitalizar Documentos</a>
					  <a href="../view/gestao_listar_documentos.php" class="list-group-item list-group-item-action">Listar Documetos</a>
           	
			</div>
		</div>
		<div class="col-sm-9 float-left  bg-secondary"style="border:1px solid #000;margin-top:48px;">
             <h1 style=""></h1>
             <button type="button" onclick="scanToJpg();">Scan</button>

              <div id="images"></div>
		</div>
	</div>		
</div><!-- Fim conteiner -->

 <script type="text/javascript">
 	
   function scanToJpg() {
   scanner.scan(displayImagesOnPage,
   {
      "output_settings" :
      [
         {
            "type" : "return-base64",
            "format" : "jpg"
         }
      ]
   }
   );
  }
   

     /** Processes the scan result */
function displayImagesOnPage(successful, mesg, response) {
   if(!successful) { // On error
      console.error('Failed: ' + mesg);
      return;
   }

   if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
      console.info('User canceled');
      return;
   }

   var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
   for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
      var scannedImage = scannedImages[i];
      processScannedImage(scannedImage);
   }
}

/** Images scanned so far. */
var imagesScanned = [];

/** Processes a ScannedImage */
function processScannedImage(scannedImage) {
   imagesScanned.push(scannedImage);
   var elementImg = createDomElementFromModel( {
       'name': 'img',
       'attributes': {
           'class': 'scanned',
           'src': scannedImage.src
       }
   });
   document.getElementById('images').appendChild(elementImg);
}

 </script>







<?php require 'footer.php';?>


