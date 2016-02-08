<?php
use yii\helpers\Html; 
use yii\bootstrap\ActiveForm;
use kartik\sidenav\SideNav;
use kartik\icons\Icon;

/* @var $this yii\web\View */

$this->title = 'OCFA System - API';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-api_doc" style="background: white; min-height: 768px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>API Documentation</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php
                   echo SideNav::widget([
                        'type' => SideNav::TYPE_DEFAULT,
                        'heading' => '',
                        'items' => [
                            [
                                'label' => 'Pendaftaran',
                                'icon' => 'sign-in',
                                'url' => '#sidenav-heading',
                            ],
                            [
                                'label' => 'Data Penduduk',
                                'icon' => 'user',
                                'url' => '#',
                            ],
                            [
                                'label' => 'Data Statistik',
                                'icon' => 'stats',
                                'items' => [
                                    ['label' => 'Parameter Tahun', 'icon'=>'info-sign', 'url'=>'#'],
                                    ['label' => 'Parameter Lokasi', 'icon'=>'phone', 'url'=>'#'],
                                ],
                            ],
                            [
                                'label' => 'Data Kartu Keluarga',
                                'icon' => 'credit-card',
                                'items' => [
                                    ['label' => 'Pencarian Nomor KK', 'icon'=>'info-sign', 'url'=>'#'],
                                    ['label' => 'Pencarian NIK', 'icon'=>'phone', 'url'=>'#'],
                                ],
                            ],
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-9">
                <div class="bs-section">
                    <div class="page-header bs-header">
                        <h1 id="sidenav-heading" class="text-warning">
                            <a class="kv-anchor" title="" href="#sidenav-heading" data-toggle="tooltip" data-original-title="Permalink">
                                <span class="glyphicon glyphicon-user"></span>
                            </a> Data penduduk
                        </h1>
                    </div>
                    <ul>
                        <li>
                            <h3>Request URI</h3>
                            <pre class="prettyprint linenums prettyprinted">[GET] http://localhost/ocfa_yii/api/v1/penduduk?access-token=<access_token>&nik=<nik>&field=<fields></pre>
                            <!-- <pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><span class="com">// No Heading</span></li><li class="L1"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">]);</span></li><li class="L2"><span class="pln">    </span></li><li class="L3"><span class="com">// HTML Heading</span></li><li class="L4"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'&lt;i class="glyphicon glyphicon-cog"&gt;&lt;/i&gt; Operations'</span><span class="pun">]);</span></li></ol></pre> -->
                        </li>
                        <li>
                            <h3>Parameter</h3>
                            <div class="col-md-2">access-token</div>
                            <div class="col-md-10">Token akses anda</div>
                            <div class="col-md-2">NIK</div>
                            <div class="col-md-10">Nomor Induk Kependudukan</div>
                            <div class="col-md-2">Field</div>
                            <div class="col-md-10">Attribut pencarian dan setiap atribut dipisahkan dengan tanda '-'. Atribut yang diperbolehkan antara lain: nama, jenis_kelamin, tanggal_lahir, tempat_lahir, golongan_darah, kewarganegaraan, foto, agama, alamat, status_perkawinan, pekerjaan, pendidikan_terakhir</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
