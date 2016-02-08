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
                                'icon' => 'question-sign',
                                'url' => '#',
                            ],
                            [
                                'label' => 'Data Statistik',
                                'icon' => 'question-sign',
                                'items' => [
                                    ['label' => 'Parameter Tahun', 'icon'=>'info-sign', 'url'=>'#'],
                                    ['label' => 'Parameter Lokasi', 'icon'=>'phone', 'url'=>'#'],
                                ],
                            ],
                            [
                                'label' => 'Data Kartu Keluarga',
                                'icon' => 'question-sign',
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
                                <span class="glyphicon glyphicon-link"></span>
                            </a>SideNav Heading <small>SideNav::widget</small>
                        </h1>
                    </div>
                    <p>    You can control the side navigation heading by setting the parameter <code>heading</code></p><ul>
        <li>You can set this to false to not display the heading. This is the default.</li>
        <li>You can provide a plain text or a HTML Formatted string as the heading. This value is not HTML encoded.</li>
        </ul><p></p>                        <div class="bs-example">
                    <p class="lead">View this <a href="/sidenav-demo/profile/default">complete demo</a> that shows a complete usage of the Side Navigation menu with configurable options.</p>          </div>
                <pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><span class="com">// No Heading</span></li><li class="L1"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">]);</span></li><li class="L2"><span class="pln">    </span></li><li class="L3"><span class="com">// HTML Heading</span></li><li class="L4"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'&lt;i class="glyphicon glyphicon-cog"&gt;&lt;/i&gt; Operations'</span><span class="pun">]);</span></li></ol></pre>
                </div>
            </div>
        </div>
    </div>
</div>
