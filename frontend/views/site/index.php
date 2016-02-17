<?php
use yii\helpers\Html; 
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="col-lg-12 white text-center">
        <div class="container">
            <h1>OCFA System</h1>
            <h4>One Code For All System</h4>
            <hr class="star-primary">
            <h2> for the future of indonesian people's identity</h2>
            <a href="#about"> <i class="fa fa-chevron-circle-down fa-3x"></i> </a>
        </div>
    </div>
    <div class="col-lg-12 text-center blue" id="about">
        <div class="container">
        	<h1>Tentang OCFA System</h1>
        	<hr class="star-light">
            <p class="lead">
                 OCFA adalah sistem informasi kependudukan terintegrasi, yang mempermudah pemerintah dalam melakukan manajemen data kependudukan dari tingkat desa sampai nasional. Serta menyediakan layanan API sehingga data kependudukan dapat diakses oleh siapapun dan kapanpun. 
            </p>
        </div>
    </div>
    <div class="col-lg-12 white text-center" id="api">
    	<div class="container">
    		<h1>OCFA System API</h1>
    		<hr class="star-primary">
    		<h4>Registrasi sekarang juga !</h4>
    			<a href="api_doc"><button type="button" style="margin: 3%;" class="btn btn-lg btn-success">Dokumentasi</button></a>
    		
    			<?php 
						if (Yii::$app->user->isGuest) {
							echo "<a href='signup'><button type='button' style='margin: 3%;' class='btn btn-lg btn-primary'>Registrasi</button></a>";
						}
					?>
    		
    	</div>
    </div>
</div>
