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
            <div class="col-lg-12 api-doc">
                <div class="col-lg-3 side">
                    <?php
                       echo SideNav::widget([
                            'type' => SideNav::TYPE_DEFAULT,
                            'heading' => '',
                            'items' => [
                                [
                                    'label' => 'Intoduction',
                                    'icon' => 'intro',
                                    'url' => '#intro',
                                ],
                                [
                                    'label' => 'Data Penduduk',
                                    'icon' => 'user',
                                    'url' => '#penduduk',
                                ],
                                [
                                    'label' => 'Data Statistik',
                                    'icon' => 'stats',
                                    'items' => [
                                        ['label' => 'Parameter Tahun', 'icon'=>'calendar', 'url'=>'#statistik-penduduk'],
                                        ['label' => 'Parameter Lokasi', 'icon'=>'map-marker', 'url'=>'#statistik-penduduk'],
                                    ],
                                ],
                                [
                                    'label' => 'Data Kartu Keluarga',
                                    'icon' => 'list-alt',
                                    'items' => [
                                        ['label' => 'Pencarian Nomor KK', 'icon'=>'search', 'url'=>'#kartu-keluarga'],
                                        ['label' => 'Pencarian NIK', 'icon'=>'search', 'url'=>'#kartu-keluarga'],
                                    ],
                                ],
                            ],
                        ]);
                    ?>
                </div>
                <div class="col-lg-9 col-lg-offset-3 api-doc-content">
                    <div class="bs-section detail">
                        <div class="page-header bs-header">
                            <h1 id="intro" class="text-warning">
                                <a class="kv-anchor" title="" href="#intro" data-toggle="tooltip" data-original-title="Permalink">
                                    <span class="glyphicon glyphicon-intro"></span>
                                </a> Introduction
                            </h1>
                        </div>
                        <ul>
                            <li>
                                <h3>Request</h3>
                                <p>Format xml merupakan response default dari server. Anda perlu menambahkan header untuk mendapatkan format lain. Format yang didukung adalah:</p>
                                <p>XML</p>
                                <pre class="prettyprint linenums prettyprinted">Accept: application/xml; q=0.9, */*; q=0.8</pre>
                                <p>JSON</p>
                                <pre class="prettyprint linenums prettyprinted">Accept: application/json; q=0.9, */*; q=0.8</pre>
                                <p>HTML</p>
                                <pre class="prettyprint linenums prettyprinted">Accept: text/html; q=0.9, */*; q=0.8</pre>
                            </li>
                        </ul>
                    </div>
                    <div class="bs-section detail">
                        <div class="page-header bs-header">
                            <h1 id="penduduk" class="text-warning">
                                <a class="kv-anchor" title="" href="#penduduk" data-toggle="tooltip" data-original-title="Permalink">
                                    <span class="glyphicon glyphicon-user"></span>
                                </a> Data penduduk
                            </h1>
                        </div>
                        <ul>
                            <li>
                                <h3>Request URI</h3>
                                <pre class="prettyprint linenums prettyprinted"><span class="btn btn-primary">GET</span> http://localhost/ocfa_yii/api/v1/penduduk?access-token=access_token&nik=nik&field=fields</pre>
                                <!-- <pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><span class="com">// No Heading</span></li><li class="L1"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">]);</span></li><li class="L2"><span class="pln">    </span></li><li class="L3"><span class="com">// HTML Heading</span></li><li class="L4"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'&lt;i class="glyphicon glyphicon-cog"&gt;&lt;/i&gt; Operations'</span><span class="pun">]);</span></li></ol></pre> -->
                            </li>
                            <li>
                                <h3>Parameter</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="15%">Access Token</th>
                                            <td width="85%">Token Akses Anda</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">NIK</th>
                                            <td width="85%">Nomor Induk Kependudukan</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">Field</th>
                                            <td width="85%">Attribut pencarian dan setiap atribut dipisahkan dengan tanda '-'. Atribut yang diperbolehkan antara lain: nama, jenis_kelamin, tanggal_lahir, tempat_lahir, golongan_darah, kewarganegaraan, foto, agama, alamat, status_perkawinan, pekerjaan, pendidikan_terakhir</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="col-md-2">access-token</div>
                                <div class="col-md-10">Token akses anda</div>
                                <div class="col-md-2">NIK</div>
                                <div class="col-md-10">Nomor Induk Kependudukan</div>
                                <div class="col-md-2">Field</div>
                                <div class="col-md-10">Attribut pencarian dan setiap atribut dipisahkan dengan tanda '-'. Atribut yang diperbolehkan antara lain: nama, jenis_kelamin, tanggal_lahir, tempat_lahir, golongan_darah, kewarganegaraan, foto, agama, alamat, status_perkawinan, pekerjaan, pendidikan_terakhir</div> -->
                            </li>
                            <li>
                                <h3>Response</h3>
                                <pre class="prettyprint linenums prettyprinted">
{
  "name": "success",
  "status": "200",
  "message": "found",
  "nik_responsible": "3520082506930001",
  "data": {
    "nama": "Jaafar Hisyamudin Umar",
    "jenis_kelamin": "Laki-laki",
    "tanggal_lahir": "07-10-1994",
    "tempat_lahir": "Ponorogo",
    "golongan_darah": "o",
    "kewarganegaraan": "WNI",
    "agama": "Islam",
    "alamat": "Ds Jetis",
    "status_perkawinan": "Belum Menikah",
    "pekerjaan": "Mahasiswa",
    "pendidikan_terakhir": "D 2"
  }
}
                                </pre>
                            </li>
                        </ul>
                    </div>
                    <div class="bs-section detail">
                        <div class="page-header bs-header">
                            <h1 id="statistik-penduduk" class="text-warning">
                                <a class="kv-anchor" title="" href="#statistik-penduduk" data-toggle="tooltip" data-original-title="Permalink">
                                    <span class="glyphicon glyphicon-stats"></span>
                                </a> Statistik Penduduk
                            </h1>
                        </div>
                        <ul>
                            <li>
                                <h3>Request URI</h3>
                                <pre class="prettyprint linenums prettyprinted"><span class="btn btn-primary">GET</span> http://localhost/ocfa_yii/api/v1/statistik?access-token=access_token&type=type&tahun=0000&mulai_tahun=0000&sampai_tahun=0000</pre>
                                <!-- <pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><span class="com">// No Heading</span></li><li class="L1"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">]);</span></li><li class="L2"><span class="pln">    </span></li><li class="L3"><span class="com">// HTML Heading</span></li><li class="L4"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'&lt;i class="glyphicon glyphicon-cog"&gt;&lt;/i&gt; Operations'</span><span class="pun">]);</span></li></ol></pre> -->
                            </li>
                            <li>
                                <h3>Parameter</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="15%">Access Token</th>
                                            <td width="85%">Token Akses Anda</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">type</th>
                                            <td width="85%">tipe tabulasi data statistik yang ditampilkan. Yaitu: tahun dan lokasi</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">tahun</th>
                                            <td width="85%">Statistik pada tahun yang spesifik</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">mulai_tahun</th>
                                            <td width="85%">Statistik dimulai pada tahun</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">sampai_tahun</th>
                                            <td width="85%">Statistik sampai pada tahun</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="col-md-2">access-token</div>
                                <div class="col-md-10">Token akses anda</div>
                                <div class="col-md-2">NIK</div>
                                <div class="col-md-10">Nomor Induk Kependudukan</div>
                                <div class="col-md-2">Field</div>
                                <div class="col-md-10">Attribut pencarian dan setiap atribut dipisahkan dengan tanda '-'. Atribut yang diperbolehkan antara lain: nama, jenis_kelamin, tanggal_lahir, tempat_lahir, golongan_darah, kewarganegaraan, foto, agama, alamat, status_perkawinan, pekerjaan, pendidikan_terakhir</div> -->
                            </li>
                            <li>
                                <h3>Response</h3>
                                <pre class="prettyprint linenums prettyprinted">
{
  "name": "success",
  "status": "200",
  "message": "found",
  "nik_responsible": "3520082506930001",
  "data": [
    {
      "tahun": "2012",
      "jumlah_laki": "3",
      "jumlah_perempuan": "1",
      "total": "4"
    },
    {
      "tahun": "2013",
      "jumlah_laki": "3",
      "jumlah_perempuan": "1",
      "total": "4"
    },
    {
      "tahun": "2014",
      "jumlah_laki": "3",
      "jumlah_perempuan": "1",
      "total": "4"
    },
    {
      "tahun": "2015",
      "jumlah_laki": "3",
      "jumlah_perempuan": "0",
      "total": "3"
    },
    {
      "tahun": "2016",
      "jumlah_laki": "2",
      "jumlah_perempuan": "0",
      "total": "2"
    },
    {
      "tahun": "2017",
      "jumlah_laki": "2",
      "jumlah_perempuan": "0",
      "total": "2"
    }
  ]
}
                                </pre>
                            </li>
                        </ul>
                    </div>
                    <div class="bs-section detail">
                        <div class="page-header bs-header">
                            <h1 id="kartu-keluarga" class="text-warning">
                                <a class="kv-anchor" title="" href="#kartu-keluarga" data-toggle="tooltip" data-original-title="Permalink">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                </a> Kartu Keluarga
                            </h1>
                        </div>
                        <ul>
                            <li>
                                <h3>Request URI</h3>
                                <pre class="prettyprint linenums prettyprinted"><span class="btn btn-primary">GET</span> http://localhost/ocfa_yii/api/v1/kartukeluarga?access-token=access_token&nik=nik&no_kk=nomor_kk</pre>
                                <!-- <pre class="prettyprint linenums prettyprinted"><ol class="linenums"><li class="L0"><span class="com">// No Heading</span></li><li class="L1"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="kwd">false</span><span class="pun">]);</span></li><li class="L2"><span class="pln">    </span></li><li class="L3"><span class="com">// HTML Heading</span></li><li class="L4"><span class="pln">echo </span><span class="typ">SideNav</span><span class="pun">::</span><span class="pln">widget</span><span class="pun">([</span><span class="str">'items'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> $items</span><span class="pun">,</span><span class="pln"> </span><span class="str">'heading'</span><span class="pln"> </span><span class="pun">=&gt;</span><span class="pln"> </span><span class="str">'&lt;i class="glyphicon glyphicon-cog"&gt;&lt;/i&gt; Operations'</span><span class="pun">]);</span></li></ol></pre> -->
                            </li>
                            <li>
                                <h3>Parameter</h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="15%">Access Token</th>
                                            <td width="85%">Token Akses Anda</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">nik</th>
                                            <td width="85%">Nomor Induk Kependudukan</td>
                                        </tr>
                                        <tr>
                                            <th width="15%">no_kk</th>
                                            <td width="85%">Nomor Kartu Keluarga</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="col-md-2">access-token</div>
                                <div class="col-md-10">Token akses anda</div>
                                <div class="col-md-2">NIK</div>
                                <div class="col-md-10">Nomor Induk Kependudukan</div>
                                <div class="col-md-2">Field</div>
                                <div class="col-md-10">Attribut pencarian dan setiap atribut dipisahkan dengan tanda '-'. Atribut yang diperbolehkan antara lain: nama, jenis_kelamin, tanggal_lahir, tempat_lahir, golongan_darah, kewarganegaraan, foto, agama, alamat, status_perkawinan, pekerjaan, pendidikan_terakhir</div> -->
                            </li>
                            <li>
                                <h3>Response</h3>
                                <pre class="prettyprint linenums prettyprinted">
{
  "name": "success",
  "status": "200",
  "message": "found",
  "nik_responsible": "3520082506930001",
  "data": [
    {
      "no_kk": "3502100202160001",
      "kepala_keluarga": "3502100710940002",
      "tanggal_terbit": "02-02-2016",
      "tanggal_pembaruan": "02-02-2016",
      "detail": [
        {
          "status_keluarga": "kepala keluarga",
          "nik": "3502100710940002",
          "nama": "Jaafar Hisyamudin Umar",
          "jenis_kelamin": "Laki-laki",
          "tanggal_lahir": "10-07-1994"
        },
        {
          "status_keluarga": "anak",
          "nik": "3502190905950003",
          "nama": "Aziz Muin",
          "jenis_kelamin": "Laki-laki",
          "tanggal_lahir": "05-09-1995"
        }
      ]
    }
  ]
}
                                </pre>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
