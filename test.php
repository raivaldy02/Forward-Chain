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
$keys = array_keys($KamusPenyakit);
$values  = array_values($KamusPenyakit);
$values1 = array_values(array_keys($KamusPenyakit));
//echo $values[0][1];    
//print_r($KamusPenyakit);
$j = 0;
for($i = 0;$i < count($values);$i++) {
    echo $values[$i][$j].' pemisah '.$i.'<br>';
    // echo implode($values[$i]).'<br> '.$i;
  // // echo '<tr> <th scope="row">'.($i+1).'</th>';
  // // echo '<td>'.$value[0][1].'</td>';
  // // $i+=1;
  // // echo '<td>'.$value[$i].'</td>';
  // // $i+=1;
  // // echo '<td>'.$value[$i][$j].'</td> </tr>';
  // // $j+=1;
  // // $i = 0;
  }
?>