<?php

// Abstract class TaxiMeter
abstract class TaxiMeter {
    private $flagDown;
    private $incrementRate;
    private $distanceIncrement;
    private $waitingIncrement;
    private $distanceTravel;

    // Constructor
    public function __construct($flagDown, $incrementRate, $distanceIncrement, $waitingIncrement, $distanceTravel) {
        $this->flagDown = $flagDown;
        $this->incrementRate = $incrementRate;
        $this->distanceIncrement = $distanceIncrement;
        $this->waitingIncrement = $waitingIncrement;
        $this->distanceTravel = $distanceTravel;
    }

    // Getters
    public function getFlagDown() {
        return $this->flagDown;
    }

    public function getIncrementRate() {
        return $this->incrementRate;
    }

    public function getDistanceIncrement() {
        return $this->distanceIncrement;
    }

    public function getWaitingIncrement() {
        return $this->waitingIncrement;
    }

    public function getDistanceTravel() {
        return $this->distanceTravel;
    }

    // Abstract methods
    abstract public function showSummaryTaxiDetails();
    abstract public function computeTaxiBilling();
}

// NonAirconTaxi class
class NonAirconTaxi extends TaxiMeter {
    private $totalAmount;
    private $amountOnWait;
    private $amountOnDistanceTravelled;
    private $timeWaited;

    // Constructor
    public function __construct($flagDown, $incrementRate, $distanceIncrement, $waitingIncrement, $distanceTravel, $timeWaited) {
        parent::__construct($flagDown, $incrementRate, $distanceIncrement, $waitingIncrement, $distanceTravel);
        $this->timeWaited = $timeWaited;
        $this->computeTaxiBilling();
    }

    // Getters
    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function getAmountOnWait() {
        return $this->amountOnWait;
    }

    public function getAmountOnDistanceTravelled() {
        return $this->amountOnDistanceTravelled;
    }

    public function getTimeWaited() {
        return $this->timeWaited;
    }

    // Compute billing
    public function computeTaxiBilling() {
        $this->amountOnDistanceTravelled = ($this->getIncrementRate() * $this->getDistanceTravel()) / $this->getDistanceIncrement();
        $this->amountOnWait = $this->getIncrementRate() * ($this->getTimeWaited() / $this->getWaitingIncrement());
        $this->totalAmount = $this->getAmountOnWait() + $this->getAmountOnDistanceTravelled() + $this->getFlagDown();
    }

    // Show summary with Bootstrap
    public function showSummaryTaxiDetails() {
        echo '<div class="card mb-4 shadow-sm border-warning">';
        echo '<div class="card-header bg-warning text-white text-center"><h4>TAXI METER - Non-Aircon</h4></div>';
        echo '<div class="card-body">';
        echo '<div class="mb-3">';
        echo '<p class="lead">For every ' . $this->getDistanceIncrement() . ' meters <span class="badge bg-primary">₱ ' . $this->getIncrementRate() . '.00</span></p>';
        echo '<p class="lead">For every ' . $this->getWaitingIncrement() . ' minutes waiting <span class="badge bg-primary">₱ ' . $this->getIncrementRate() . '.00</span></p>';
        echo '</div>';
        echo '<hr>';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<p><strong>Flag Down:</strong> ₱ ' . $this->getFlagDown() . '.00</p>';
        echo '<p><strong>Distance Travelled:</strong> ' . number_format($this->getDistanceTravel()) . ' meters</p>';
        echo '<p><strong>Waited Time:</strong> ' . $this->getTimeWaited() . ' minutes</p>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<p><strong>Amount for Distance:</strong> ₱ ' . number_format($this->getAmountOnDistanceTravelled(), 2) . '</p>';
        echo '<p><strong>Amount for Waiting:</strong> ₱ ' . number_format($this->getAmountOnWait(), 2) . '</p>';
        echo '<p class="text-danger fw-bold">Total Amount: ₱ ' . number_format($this->getTotalAmount(), 2) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

// AirconTaxi class
class AirconTaxi extends TaxiMeter {
    private $totalAmount;
    private $amountOnWait;
    private $amountOnDistanceTravelled;
    private $timeWaited;

    // Constructor
    public function __construct($flagDown, $incrementRate, $distanceIncrement, $waitingIncrement, $distanceTravel, $timeWaited) {
        parent::__construct($flagDown, $incrementRate, $distanceIncrement, $waitingIncrement, $distanceTravel);
        $this->timeWaited = $timeWaited;
        $this->computeTaxiBilling();
    }

    // Getters
    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function getAmountOnWait() {
        return $this->amountOnWait;
    }

    public function getAmountOnDistanceTravelled() {
        return $this->amountOnDistanceTravelled;
    }

    public function getTimeWaited() {
        return $this->timeWaited;
    }

    // Compute billing
    public function computeTaxiBilling() {
        $this->amountOnDistanceTravelled = ($this->getIncrementRate() * $this->getDistanceTravel()) / $this->getDistanceIncrement();
        $this->amountOnWait = $this->getIncrementRate() * ($this->getTimeWaited() / $this->getWaitingIncrement());
        $this->totalAmount = $this->getAmountOnWait() + $this->getAmountOnDistanceTravelled() + $this->getFlagDown();
    }

    // Show summary with Bootstrap
    public function showSummaryTaxiDetails() {
        echo '<div class="card mb-4 shadow-sm border-info">';
        echo '<div class="card-header bg-info text-white text-center"><h4>TAXI METER - Aircon</h4></div>';
        echo '<div class="card-body">';
        echo '<div class="mb-3">';
        echo '<p class="lead">For every ' . $this->getDistanceIncrement() . ' meters <span class="badge bg-primary">₱ ' . $this->getIncrementRate() . '.00</span></p>';
        echo '<p class="lead">For every ' . $this->getWaitingIncrement() . ' minutes waiting <span class="badge bg-primary">₱ ' . $this->getIncrementRate() . '.00</span></p>';
        echo '</div>';
        echo '<hr>';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<p><strong>Flag Down:</strong> ₱ ' . $this->getFlagDown() . '.00</p>';
        echo '<p><strong>Distance Travelled:</strong> ' . number_format($this->getDistanceTravel()) . ' meters</p>';
        echo '<p><strong>Waited Time:</strong> ' . $this->getTimeWaited() . ' minutes</p>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<p><strong>Amount for Distance:</strong> ₱ ' . number_format($this->getAmountOnDistanceTravelled(), 2) . '</p>';
        echo '<p><strong>Amount for Waiting:</strong> ₱ ' . number_format($this->getAmountOnWait(), 2) . '</p>';
        echo '<p class="text-danger fw-bold">Total Amount: ₱ ' . number_format($this->getTotalAmount(), 2) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Meter System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Taxi Meter Calculator</h1>
        
        <div class="row">
            <div class="col-md-12">
                <?php
                // Create NonAirconTaxi object
                $nonAirconTaxi = new NonAirconTaxi(30, 1, 50, 1.5, 1000, 20);
                $nonAirconTaxi->showSummaryTaxiDetails();
                
                // Create AirconTaxi object
                $airconTaxi = new AirconTaxi(40, 2, 40, 1, 2000, 30);
                $airconTaxi->showSummaryTaxiDetails();
                ?>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-muted">© <?php echo date('Y'); ?> Taxi Meter System</p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>