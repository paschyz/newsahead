<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/components/logo.jpg">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;900&display=swap" rel="stylesheet">

  <script src="javascript/main.js"> </script>

  <script src="sortable.js" defer>    </script>
  <title><?php echo $title; ?></title>

  <script>
  function del() {
    $( "p" ).remove();
  };

  </script>

  <?php
  function dateDifference($date_1 , $date_2 , $differenceFormat = '%y' )
  {
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);
    if($interval->format($differenceFormat)!=0){
      if($interval->format('%y')==1){
        echo $interval->format('%y').' an';
      }else{
        echo $interval->format('%y').' ans';}
      }else if($interval->format('%m')!=0){
        echo $interval->format('%m').' mois';
      }else if($interval->format('%d')!=0){
        if($interval->format('%d')==1){
          echo $interval->format('%d').' jour';
        }else{
          echo $interval->format('%d').' jours';}
        }else if($interval->format('%h')!=0){
          if($interval->format('%h')==1){
            echo $interval->format('%h').' heure';
          }else{
            echo $interval->format('%h').' heures';}
          }else if($interval->format('%i')!=0){
            if($interval->format('%i')==1){
              echo $interval->format('%i').' minute';
            }else{
              echo $interval->format('%i').' minutes';}
            }else if($interval->format('%s')!=0){
              if($interval->format('%s')==1){
                echo $interval->format('%s').' seconde';
              }else{
                echo $interval->format('%s').' secondes';}
              }
            }

            function starts_with_upper($str) {
              $chr = mb_substr ($str, 0, 1, "UTF-8");
              return mb_strtolower($chr, "UTF-8") != $chr;
            }




            $date = new DateTime("now", new DateTimeZone('Europe/Paris') );
            ?>


          </head>
