<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50,
        /* 'keys_it' => [
            'name' => 'nome'
        ] */
    ],
];


    $filterHotel = $hotels;
    if(isset($_GET['parkFilter'])){
        $hotelPark = [];

        foreach($hotels as $hotel){
            if($hotel['parking'] == $_GET['parkFilter']){
                $hotelPark[] = $hotel;
            }
        }

        $filterHotel = $hotelPark;
    }

    
    if (isset($_GET['voteFilter'])) {
        $hotelVote = [];
    
        foreach ($filterHotel as $hotel) {
            if ($hotel['vote'] >= $_GET['voteFilter']) {
                $hotelVote[] = $hotel;
            }
        }
    
        $filterHotel = $hotelVote;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Hotel list</title>
</head>

<body>

    <?php
    require_once './partials/header.php'
    ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <form action="index.php" method="GET" class="d-flex">
                        <select class="form-select" name="parkFilter">
                            <option value="">Parcheggio</option>
                            <option value="1">Sì</option>
                            <option value="0">No</option>
                        </select>
                        <select class="form-select ms-2" name="voteFilter">
                            <option value="">Voto</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" class="btn btn-success ms-2">Cerca</button>
                    </form>
                </div>
            </div>

            <div class="table-container mt-3">
                <table class="table table-striped">
                    <tr>
                        <?php 
                            $flag = true;

                            foreach($hotels as $hotel){
                                if($flag === true){
                                    foreach($hotel as $key => $value){
                                        /* FIXME: La traduzione è statica */
                                        switch($key){
                                            case 'name':
                                                $key = 'Nome';
                                                break;
                                            case 'description':
                                                $key = 'Descrizione';
                                                break;
                                            case 'parking':
                                                $key = 'Parcheggio';
                                                break;
                                            case 'vote':
                                                $key = 'Voto';
                                                break;
                                            case 'distance_to_center':
                                                $key = 'Distanza dal centro';
                                                break;
                                            default: 
                                                break;
                                        }
                                        echo "<th>{$key}</th>";
                                    }
                                }
                                $flag = false;
                            }
                        ?>
<!--                         <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Parcheggio</th>
                        <th>Voto</th>
                        <th>Distanza dal centro</th> -->
                    </tr>
                    <?php
                    foreach ($filterHotel as $hotel) {
                        echo "<tr>";
                        foreach ($hotel as $key => $value) {
                            if ($key === 'parking') {
                                echo $value ? '<td>Si</td>' : '<td>No</td>';
                            } elseif ($key == 'distance_to_center') {
                                echo "<td>{$value} Km</td>";
                            } else {
                                echo "<td>{$value}</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    ?>

                </table>
            </div>
        </div>


    </main>


    <?php
    require_once './partials/footer.php'
    ?>

</body>

</html>