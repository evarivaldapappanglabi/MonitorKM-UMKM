<?php
class MultipleRegresi{

	public $datax1; /* untuk menerima array x1 */
	public $datax2; /* untuk menerima array x2 */
	public $datay; /* untuk menerima array y */
	public $X1; /* untuk menerima total kolom x1 */
	public $X2; /* untuk menerima total kolom x2 */
	public $Y; /* untuk menerima total kolom y */
	public $X1Y; /* untuk menerima total kolom perkalian x1.y */
	public $X2Y; /* untuk menerima total kolom perkalian x2.y */
	public $X1X2; /* untuk menerima total kolom perkalian x1.x2 */
	public $a; /* untuk menerima hasil constanta a */
	public $b1; /* untuk menerima hasil constanta b1 */
	public $b2; /* untuk menerima hasil constanta b2 */
	public $n; /* untuk menerima hasil panjang row data */
	public $Ry12; /* untuk menerima hasil korelasi ganda perhitungan */
	public $ry12; /* untuk menerima hasil korelasi parsial perhitungan */
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


	// Function untuk mendapatkan nilai array data X1. data X2 dan data Y
	public function __construct($datax1=null, $datay=null,$datax2=null){
        if(!is_null($datax1) && !is_null($datay) && !is_null($datax2)){
            $this->datax1 = $datax1;
            $this->datax2 = $datax2;
            $this->datay = $datay;
            $this->compute();
        }
    }

	// Function untuk cek apakah panjang nilai array data X1. data X2 dan data Y sama panjang
	public function compute(){
        if(is_array($this->datax1) && is_array($this->datax1)){
            if(count($this->datax2) == count($this->datax2)){
                $this->n  = count($this->datax1);
                
                $this->prepare_calculation();
                $this->calculateAB();
                $this->calculationKorelasi();
                $this->calculationKoefisienDeterminasi();
                $this->calculationF();
            }
            else{
                throw new Exception('Jumlah data variabel X dan Y harus sama');
            }

        }
        else{
            throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }

	
	// Function untuk membuat tabel pembantu
	public function prepare_calculation(){
        //menghitung total x1 kuadrat
        $this->X1 = array_map(function($n){
            return $n * $n;
        }, $this->datax1);

		//menghitung total x2 kuadrat
		$this->X2 = array_map(function($n){
            return $n * $n;
        }, $this->datax2);

		//menghitung total y kuadrat
		$this->Y = array_map(function($n){
            return $n * $n;
        }, $this->Y);
        
        //menghitung total x1.y
        for($i=0; $i<$this->n; $i++){
            $this->X1Y[$i] = $this->X1[$i] * $this->Y[$i];
        }
		
		//menghitung total x2.y
		for($i=0; $i<$this->n; $i++){
            $this->X2Y[$i] = $this->X2[$i] * $this->Y[$i];
        }

		//menghitung total x1.x2
		for($i=0; $i<$this->n; $i++){
            $this->X1X2[$i] = $this->X1[$i] * $this->X2[$i];
        }
        
    }

	public function calculateAB(){
		$sumx1kuadrat = (array_sum($this->X1) - ((array_sum($this->X1) * array_sum($this->X1)) / $this->n));
		$this->sumx1kuadrat = $sumx1kuadrat;

		$sumx2kuadrat = (array_sum($this->X2) - ((array_sum($this->X2) * array_sum($this->X2)) / $this->n));
		$this->sumx2kuadrat = $sumx2kuadrat;

		$sumykuadrat = (array_sum($this->Y) - ((array_sum($this->Y) * array_sum($this->Y)) / $this->n));
		$this->sumykuadrat = $sumykuadrat;

		$sumx1y = ((array_sum($this->X1Y)) - ((array_sum($this->X1) * array_sum($this->Y)) / $this->n));
		$this->sumx1y = $sumx1y;

		$sumx2y = ((array_sum($this->X2Y)) - ((array_sum($this->X2) * array_sum($this->Y)) / $this->n));
		$this->sumx2y = $sumx2y;
		
		$sumx1x2 = ((array_sum($this->X1X2)) - ((array_sum($this->X1) * array_sum($this->X2))/ $this->n));
		$this->sumx1x2 = $sumx1x2;

		$avgX = (array_sum($this->X2) / $this->n);
		$this->avgX = $avgX;

		$avgXkuadrat = ((array_sum($this->X2) / $this->n) * (array_sum($this->X2) / $this->n));
		$this->avgXkuadrat = $avgXkuadrat;

		$avgY = (array_sum($this->Y) / $this->n);
		$this->avgY = $avgY;
		
		$avgYkuadrat = ((array_sum($this->Y) / $this->n) * (array_sum($this->Y) / $this->n));
		$this->avgYkuadrat = $avgYkuadrat;

		// membuat pembagi untuk mencari A dan B1 dan B2
		$pembagi = (($sumx1kuadrat * $sumx2kuadrat) - ($sumx1x2 * $sumx1x2));
		// (($sumx2kuadrat * $sumx1y) - ($sumx1x2 * $sumx2y));

        // //mendapat nilai konstanta B1
        $b1 = (($sumx2kuadrat * $sumx1y) - ($sumx1x2 * $sumx2y)) / $pembagi;
		$this->b1 = $b1;

		//mendapat nilai konstanta B1
		$b2 = (($sumx1kuadrat * $sumx2y) - ($sumx1x2 * $sumx1y)) / $pembagi;
        $this->b2 = $b2;

		//mendapat nilai konstanta A
		$a = (array_sum($this->Y) / $this-> n) - ($b1) * (array_sum($this->X1) / $this->n) - ($b2) * (array_sum($this->X2) / $this->n);
		$this->a = $a;
    }

	public function calculationKorelasi(){
		$Ry12 = sqrt(($this->b1 * $this->sumx1y) + ($this->b2 * $this->sumx2y)/$this-> sumykuadrat);
		$this->Ry12 = $Ry12;

		$ry12 = ($this->n * array_sum($this->X1Y) - (array_sum($this->X1) * array_sum($this->Y)))/
		sqrt(($this->n * (array_sum($this->X1)) - (array_sum($this->X1) * array_sum($this->X1))) * ($this->n * (array_sum($this->Y)) - (array_sum($this->Y) * array_sum($this->Y))));
		$this->ry12 = $ry12;
		

	}

	public function calculationKoefisienDeterminasi(){
		$KP = ($this->Ry12 * $this->Ry12) * 100 / 100;
		$this->KP = $KP;
	}

	public function calculationF(){
		$Fhitung = ($this->Ry12 * $this->Ry12) * ($this->n - 2 - 1) / 2 * (1 - $this->Ry12 * $this->Ry12);
		$this->Fhitung = $Fhitung;

		// array FtableHelper
		$FtableHelper = [199,19.00,9.55,6.94,5.79,5.14,4.74,
                4.46,4.26,4.10,3.98,3.89,3.81,3.74,
                3.68,3.63,3.59,3.55,3.52,3.49,3.47,
                3.44,3.42,3.40,3.39,3.37,3.35,3.34,
                3.33,3.32,3.30,3.29,3.28,3.28,3.27,
                3.26,3.25,3.24,3.24,3.23,3.23,3.22,
                3.21,3.21,3.20,3.20,3.20,3.19,3.19,
                3.18,3.18,3.18,3.17,3.17,3.16,3.16,
                3.16,3.16,3.15,3.15,3.15,3.15,3.14,
                3.14,3.14,3.14,3.13,3.13,3.13,3.13,
                3.13,3.12,3.12,3.12,3.12,3.12,3.12,
                3.11,3.11,3.11,3.11,3.11,3.11,3.11,
                3.10,3.10,3.10,3.10,3.10,3.10,3.10,
                3.10,3.09,3.09,3.09,3.09,3.09,3.09,
                3.09,3.09,3.09,3.09,3.08,3.08,3.08,
                3.08,3.08,3.08,3.08,3.08,3.08,3.08,
                3.08,3.08,3.08,3.07,3.07,3.07,3.07,
                3.07,3.07,3.07,3.07,3.07,3.07,3.07,
                3.07,3.07,3.07,3.07,3.07,3.06,3.06,
                3.06,3.06,3.06,3.06,3.06,3.06,3.06,
                3.06,3.06,3.06,3.06,3.06,3.06,3.06,
                3.06,3.06,3.06,3.06,3.06,3.06,3.05,
                3.05,3.05,3.05,3.05,3.05,3.05,3.05,
                3.05,3.05,3.05,3.05,3.05,3.05,3.05,
                3.05,3.05,3.05,3.05,3.05,3.05,3.05,
                3.05,3.05,3.05,3.05,3.05,3.05,3.05,
                3.05,3.05,3.04,3.04,3.04,3.04,3.04,
                3.04,3.04,3.04,3.04,3.04,3.04,3.04,
                3.04,3.04,3.04,3.04,3.04,3.04,3.04,
                3.04,3.04,3.04,3.04,3.04,3.04,3.04,
                3.04,3.04,3.04,3.04,3.04,3.04,3.04,
                3.04,3.04,3.04,3.04,3.04,3.04,3.04,3.04];
                
                $penyebut = $FtableHelper[($this->n - 2 - 1)-1];

		$Ftable = $penyebut;
		$this->Ftable = $Ftable;		

		if ($this->Fhitung > $this->Ftable){
			$hasil = true;
			$this->hasil = $hasil;
		}else{
			$hasil = false;
			$this->hasil = $hasil;
		}
	}

}