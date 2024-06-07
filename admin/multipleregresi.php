<?php
class MultipleRegresi{

    public $datax1;
    public $datax2;
    public $datay;
    public $X1;
    public $X2;
    public $Y;
    public $X1Y;
    public $X2Y;
    public $X1X2;
    public $a;
    public $b1;
    public $b2;
    public $n;
    public $Ry12;
    public $ry12;
    public $sumx1kuadrat;
    public $sumx2kuadrat;
    public $sumykuadrat;
    public $sumx1y;
    public $sumx2y;
    public $sumx1x2;
    public $avgX;
    public $avgXkuadrat;
    public $avgY;
    public $avgYkuadrat;
    public $KP;
    public $Fhitung;
    public $Ftable;
    public $hasil;

    public function __construct($datax1 = null, $datay = null, $datax2 = null) {
        if (!is_null($datax1) && !is_null($datay) && !is_null($datax2)) {
            $this->datax1 = $datax1;
            $this->datax2 = $datax2;
            $this->datay = $datay;
            $this->compute();
        }
    }

    public function compute() {
        if (is_array($this->datax1) && is_array($this->datax2) && is_array($this->datay)) {
            if (count($this->datax1) == count($this->datay) && count($this->datax1) == count($this->datax2)) {
                $this->n = count($this->datax1);
                if ($this->n > 0) {
                    $this->prepare_calculation();
                    $this->calculateAB();
                    $this->calculationKorelasi();
                    $this->calculationKoefisienDeterminasi();
                    $this->calculationF();
                } else {
                    $this->hasil = false;
                }
            } else {
                throw new Exception('Jumlah data variabel X dan Y harus sama');
            }
        } else {
            throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }

    public function prepare_calculation() {
        $this->X1 = array_map(function($n) {
            return $n * $n;
        }, $this->datax1);

        $this->X2 = array_map(function($n) {
            return $n * $n;
        }, $this->datax2);

        $this->Y = array_map(function($n) {
            return $n * $n;
        }, $this->datay);

        $this->X1Y = [];
        $this->X2Y = [];
        $this->X1X2 = [];
        for ($i = 0; $i < $this->n; $i++) {
            $this->X1Y[$i] = $this->datax1[$i] * $this->datay[$i];
            $this->X2Y[$i] = $this->datax2[$i] * $this->datay[$i];
            $this->X1X2[$i] = $this->datax1[$i] * $this->datax2[$i];
        }
    }

    public function calculateAB() {
        $this->sumx1kuadrat = array_sum($this->X1);
        $this->sumx2kuadrat = array_sum($this->X2);
        $this->sumykuadrat = array_sum($this->Y);
        $this->sumx1y = array_sum($this->X1Y);
        $this->sumx2y = array_sum($this->X2Y);
        $this->sumx1x2 = array_sum($this->X1X2);

        $pembagi = (($this->sumx1kuadrat * $this->sumx2kuadrat) - ($this->sumx1x2 * $this->sumx1x2));
        if ($pembagi == 0) {
            $pembagi = 1;
        }

        $this->b1 = (($this->sumx2kuadrat * $this->sumx1y) - ($this->sumx1x2 * $this->sumx2y)) / $pembagi;
        $this->b2 = (($this->sumx1kuadrat * $this->sumx2y) - ($this->sumx1x2 * $this->sumx1y)) / $pembagi;
        $this->a = ($this->sumykuadrat / $this->n) - ($this->b1 * array_sum($this->datax1) / $this->n) - ($this->b2 * array_sum($this->datax2) / $this->n);
    }

    public function calculationKorelasi() {
		if ($this->sumykuadrat == 0) {
			$this->Ry12 = 0; // or any default value you prefer
		} else {
			$this->Ry12 = sqrt(($this->b1 * $this->sumx1y) + ($this->b2 * $this->sumx2y)) / $this->sumykuadrat;
		}

        $pembagi = sqrt(($this->n * array_sum($this->X1) - (array_sum($this->X1) * array_sum($this->X1))) * ($this->n * array_sum($this->Y) - (array_sum($this->Y) * array_sum($this->Y))));
        if ($pembagi == 0) {
            $pembagi = 1;
        }
        $this->ry12 = ($this->n * array_sum($this->X1Y) - (array_sum($this->X1) * array_sum($this->Y))) / $pembagi;
    }

    public function calculationKoefisienDeterminasi() {
        $this->KP = ($this->Ry12 * $this->Ry12) * 100 / 100;
    }

    public function calculationF() {
        $this->Fhitung = (($this->Ry12 * $this->Ry12) * ($this->n - 2 - 1)) / (2 * (1 - $this->Ry12 * $this->Ry12));

        $FtableHelper = [199, 19.00, 9.55, 6.94, 5.79, 5.14, 4.74, 4.46, 4.26, 4.10, 3.98, 3.89, 3.81, 3.74,
                3.68, 3.63, 3.59, 3.55, 3.52, 3.49, 3.47, 3.44, 3.42, 3.40, 3.39, 3.37, 3.35, 3.34,
                3.33, 3.32, 3.30, 3.29, 3.28, 3.28, 3.27, 3.26, 3.25, 3.24, 3.24, 3.23, 3.23, 3.22,
                3.21, 3.21, 3.20, 3.20, 3.20, 3.19, 3.19, 3.18, 3.18, 3.18, 3.17, 3.17, 3.16, 3.16,
                3.16, 3.16, 3.15, 3.15, 3.15, 3.15, 3.14, 3.14, 3.14, 3.14, 3.13, 3.13, 3.13, 3.13,
                3.13, 3.12, 3.12, 3.12, 3.12, 3.12, 3.12, 3.11, 3.11, 3.11, 3.11, 3.11, 3.11, 3.11,
                3.10, 3.10, 3.10, 3.10, 3.10, 3.10, 3.10, 3.10, 3.09, 3.09, 3.09, 3.09, 3.09, 3.09,
                3.09, 3.09, 3.09, 3.09, 3.08, 3.08, 3.08, 3.08, 3.08, 3.08, 3.08, 3.08, 3.08, 3.08,
                3.08, 3.08, 3.08, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07, 3.07,
                3.07, 3.07, 3.07, 3.07, 3.07, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06,
                3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.06, 3.05,
                3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05,
                3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05, 3.05,
                3.05, 3.05, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04,
                3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04,
                3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04, 3.04];
        
        $dataIndex = max(0, min($this->n - 4, count($FtableHelper) - 1)); // Ensure we don't go out of bounds
        $this->Ftable = $FtableHelper[$dataIndex];

        $this->hasil = $this->Fhitung > $this->Ftable;
    }
}
