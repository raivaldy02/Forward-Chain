<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>

  <body>
  Pilih gejala yang anda rasakan : <br>
  <form action="" method="POST">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value=1 name="gejala[]" id="flexCheckDefault" autocomplete='off' >
      <label class="form-check-label" for="flexCheckDefault">
      Muntah
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value=2 name="gejala[]" id="flexCheckDefault" autocomplete='off' >
      <label class="form-check-label" for="flexCheckDefault">
      Sakit Kepala
    </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value=3 name="gejala[]" id="flexCheckDefault" autocomplete='off' >
      <label class="form-check-label" for="flexCheckDefault">
      Gatal - gatal
    </label>
    </div>

    <button type="submit" name='submit' class="btn btn-secondary">Submit Hasil</button>

  </form>
  





<?php 
  $KamusPenyakit = [
    'penyakit' => ['Demam Berdarah',
              'Malaria',
              'Chikungunya',
              'Kaki Gajah',
              'Demam Penyakit Kuning',
              'Flu biasa',
              'Tidak Terdefinisi'],
              
    'rules' => [[1,2,3],
                [1,2],
                [1,3],
                [2,3],
                [2],
                [1]],
                
    'gejala'=> ['pilihan1',
              'pilihan2',
              'pilihan3']
            ];  

  if (!empty(isset($_POST['submit']))) {
    $gejala = $_POST['gejala'];
    
    $fact = $gejala;
    $getrules = getRules();
    $hasil = hasil($getrules,$fact);


    $keys = array_keys($hasil);
    $values = array_values($hasil);

    echo '
    <table class="table">
    <thead>
    <tr>
     ';
    
    echo '<th scope="col">No</th>';

    foreach($keys as $key) {
    echo '<th scope="col">'.$key.'</th>';
    }
    echo '</thead> <tbody>';

    $i = 0; $j = 0;

    while ($j < count($values[0])) { 
      echo '<tr> <th scope="row">'.($j+1).'</th>';

      for ($i = 0;$i < count($values);$i++) {
        echo '<td>'.$values[$i][$j].'</td>';
      }
      echo '</tr>';
      $j++;
    }
    echo '</tbody> </table>';

    $hasil_penyakit = [];

    for($a = 0;$a < count($hasil['Persentase']);$a++) {

      if ($hasil['Persentase'][$a] == max($hasil['Persentase'])) {
        $hasil_penyakit[$a] = $hasil['Nama Penyakit'][$a];
      }
      
    }


    $hasil_penyakit = implode(' ',$hasil_penyakit);

    echo '<br>';
    echo 'Hasil Penyakit Anda Adalah   </body>'.$hasil_penyakit;

  }

    

    function getRules() {
      global $KamusPenyakit;
      $str_rules = "";
      foreach($KamusPenyakit['rules'] as $kolom ) {
      $str_rules .=  json_encode($kolom);
      }
      
      $arr_rules = array_filter(preg_split('/[^ \w,]+/',$str_rules));
      $arr_rules = array_values($arr_rules);

      
      return $arr_rules;
    }


    function Hasil($getrules,$fact) {
      $rulesterpilih1 = [
        'Nama Penyakit' => [],
        'Persentase' => [],
        'Jumlah Gejala' => []
      ];
      $i = 0;
      foreach($getrules as $rules) {
        $jumlah = 0;
        
        for ($j = 0;$j < count($fact);$j++) {
          if (str_contains($getrules[$i],strval($fact[$j]))) {
            $jumlah += 1;
          }
        }
        
        $jumlah_gejalaRules = count(explode(',',$getrules[$i]));
        $persentase = $jumlah/$jumlah_gejalaRules * 100;
        
        $rulesterpilih1['Nama Penyakit'][$i] = 'P'.strval($i);
        $rulesterpilih1['Persentase'][$i] = $persentase;
        $rulesterpilih1['Jumlah Gejala'][$i] = $jumlah_gejalaRules;

        
        $i++;
  
      }
      return $rulesterpilih1;
    }
    

?>

